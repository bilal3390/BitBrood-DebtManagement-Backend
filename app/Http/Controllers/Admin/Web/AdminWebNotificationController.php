<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FcmNotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminWebNotificationController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query()->orderBy('name');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($qry) use ($q) {
                $qry->where('name', 'like', '%' . $q . '%')
                    ->orWhere('user_phone_e164', 'like', '%' . $q . '%')
                    ->orWhere('email', 'like', '%' . $q . '%');
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

        $users = $query->get();

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
            ? User::pluck('user_phone_e164')->all()
            : array_filter($request->input('user_phones', []));

        if (empty($userPhones)) {
            return redirect()->route('admin.notifications.index')
                ->with('error', 'Please select at least one user or use "Send to all users".');
        }

        $fcm = new FcmNotificationService();
        $tokens = $fcm->getTokensForUsers($userPhones);

        if ($tokens->isEmpty()) {
            return redirect()->route('admin.notifications.index')
                ->with('error', 'No device tokens found for the selected users. Users must have the app installed and grant notification permission to receive push notifications.');
        }

        $result = $fcm->sendToTokens(
            $tokens,
            $request->input('title'),
            $request->input('body')
        );

        if ($result['failed'] > 0 && $result['sent'] === 0) {
            return redirect()->route('admin.notifications.index')
                ->with('error', 'Failed to send notifications. ' . (implode(' ', $result['errors'] ?: ['Check FCM configuration (FCM_SERVER_KEY in .env).'])));
        }

        $message = "Notification sent to {$result['sent']} device(s).";
        if ($result['failed'] > 0) {
            $message .= " {$result['failed']} device(s) failed.";
        }

        return redirect()->route('admin.notifications.index')->with('success', $message);
    }
}
