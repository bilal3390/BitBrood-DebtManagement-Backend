<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
class AdminWebUserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(string $user_phone_e164): View|RedirectResponse
    {
        $user = User::where('user_phone_e164', $user_phone_e164)->first();

        if (! $user) {
            return redirect()->route('admin.users.index')->with('error', 'User not found.');
        }

        return view('admin.users.show', compact('user'));
    }

    public function edit(string $user_phone_e164): View|RedirectResponse
    {
        $user = User::where('user_phone_e164', $user_phone_e164)->first();

        if (! $user) {
            return redirect()->route('admin.users.index')->with('error', 'User not found.');
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, string $user_phone_e164): RedirectResponse
    {
        $user = User::where('user_phone_e164', $user_phone_e164)->first();

        if (! $user) {
            return redirect()->route('admin.users.index')->with('error', 'User not found.');
        }

        $user->update($request->validated());

        return redirect()->route('admin.users.show', $user->user_phone_e164)->with('success', 'User updated successfully.');
    }

    public function destroy(string $user_phone_e164): RedirectResponse
    {
        $user = User::where('user_phone_e164', $user_phone_e164)->first();

        if (! $user) {
            return redirect()->route('admin.users.index')->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function finance(string $user_phone_e164): View|RedirectResponse
    {
        $user = User::with(['debts' => fn ($q) => $q->with('customer')->orderBy('date', 'desc')])
            ->where('user_phone_e164', $user_phone_e164)
            ->first();

        if (! $user) {
            return redirect()->route('admin.users.index')->with('error', 'User not found.');
        }

        $debts = $user->debts;

        return view('admin.users.finance', compact('user', 'debts'));
    }
}
