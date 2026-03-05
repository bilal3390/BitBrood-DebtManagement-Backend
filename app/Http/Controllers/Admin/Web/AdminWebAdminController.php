<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AdminWebAdminController extends Controller
{
    public function index(): View
    {
        $admins = Admin::orderBy('role')->orderBy('name')->get();

        return view('admin.admins.index', ['admins' => $admins]);
    }

    public function create(): View
    {
        return view('admin.admins.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'in:super_admin,sub_admin'],
        ]);

        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully.');
    }

    public function edit(Admin $admin): View
    {
        return view('admin.admins.edit', ['admin' => $admin]);
    }

    public function update(Request $request, Admin $admin): RedirectResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:admins,email,' . $admin->id],
            'role' => ['required', 'in:super_admin,sub_admin'],
        ];

        if ($request->filled('password')) {
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        $validated = $request->validate($rules);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        $admin->role = $validated['role'];
        if (! empty($validated['password'] ?? null)) {
            $admin->password = Hash::make($validated['password']);
        }
        $admin->save();

        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully.');
    }

    public function destroy(Admin $admin): RedirectResponse
    {
        if ($admin->isSuperAdmin() && Admin::where('role', Admin::ROLE_SUPER_ADMIN)->count() <= 1) {
            return redirect()->route('admin.admins.index')->with('error', 'Cannot remove the last super admin.');
        }

        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'Admin removed.');
    }
}
