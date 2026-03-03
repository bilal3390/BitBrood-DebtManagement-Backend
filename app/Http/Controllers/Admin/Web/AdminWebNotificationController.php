<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\DeviceToken;
use App\Models\User;
use App\Services\ExpoNotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminWebNotificationController extends Controller
{
    protected ExpoNotificationService $expo;

    public function __construct(ExpoNotificationService $expo)
    {
        $this->expo = $expo;
    }

    public function index(Request $request): View
    {
        $query = User::query()->orderBy('name');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($qry) use ($q) {
                $qry->where('name', 'like', "%{$q}%")
                    ->orWhere('user_phone_e164', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        if ($request->filled('time_from')) {
            $query->whereTime('created_at', '>=', $request->time_from);
        }
        if ($request->filled('time_to')) {
            $query->whereTime('created_at', '<=', $request->time_to);
        }

        // Use pagination for large user lists
        $users = $query->paginate(50);

        return view('admin.notifications.index', compact('users'));
    }

    public function send(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:5000',
            'user_phones' => 'nullable|array',
            'user_phones.*' => 'string|exists:users,user_phone_e164',
            'send_to_all' => 'nullable|boolean',
        ]);

        $sendToAll = $request->boolean('send_to_all');
        $userPhones = $sendToAll
            ? User::pluck('user_phone_e164')->toArray()
            : array_filter($request->input('user_phones', []));

        if (empty($userPhones)) {
            return redirect()->route('admin.notifications.index')
                ->with('error', 'Please select at least one user or enable "Send to all users".');
        }

        // Get Expo push tokens
        $tokens = DeviceToken::whereIn('user_phone_e164', $userPhones)
            ->pluck('token')
            ->unique()
            ->toArray();

        if (empty($tokens)) {
            return redirect()->route('admin.notifications.index')
                ->with('error', 'No device tokens found. Users must have the app installed and grant notification permissions.');
        }

        // Send in batches to avoid timeouts
        $sent = 0;
        $failed = 0;
        $errors = [];

        foreach (array_chunk($tokens, 500) as $batch) {
            $messages = array_map(fn($token) => [
                'to' => $token,
                'title' => $request->title,
                'body' => $request->body,
            ], $batch);

            $response = $this->expo->sendMessages($messages);

            foreach ($response['data'] ?? [] as $res) {
                if (($res['status'] ?? '') === 'ok') {
                    $sent++;
                } else {
                    $failed++;
                    $errors[] = $res['message'] ?? json_encode($res);
                }
            }
        }

        $message = "Notification sent to {$sent} device(s).";
        if ($failed > 0) {
            $message .= " {$failed} device(s) failed.";
            if (!empty($errors)) {
                Log::error('Expo Notification Errors', $errors);
            }
        }

        return redirect()->route('admin.notifications.index')->with('success', $message);
    }
}