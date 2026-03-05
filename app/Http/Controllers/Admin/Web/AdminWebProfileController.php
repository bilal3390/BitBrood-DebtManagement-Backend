<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AdminWebProfileController extends Controller
{
    public function show(): View
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile.show', ['admin' => $admin]);
    }

    public function edit(): View
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile.edit', ['admin' => $admin]);
    }

    public function update(Request $request): RedirectResponse
    {
        $admin = Auth::guard('admin')->user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email,' . $admin->id],
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        $validated = $request->validate($rules);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        if (! empty($validated['password'] ?? null)) {
            $admin->password = Hash::make($validated['password']);
        }
        $admin->save();

        return redirect()->route('admin.profile.show')->with('success', 'Profile updated successfully.');
    }
}
