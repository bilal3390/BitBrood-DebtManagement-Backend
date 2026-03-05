@extends('admin.layout')

@section('title', 'Edit admin')
@section('breadcrumb', 'Edit admin')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.admins.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800">← Sub-admins</a>
    </div>

    <div class="mb-6">
        <h1 class="text-xl font-bold text-slate-800">Edit admin</h1>
        <p class="text-sm text-slate-500 mt-0.5">Update name, email, role, or password.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm max-w-xl">
        <form action="{{ route('admin.admins.update', $admin) }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}" required
                    class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66] @error('name') border-red-500 @enderror"
                    placeholder="Full name">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" required
                    class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66] @error('email') border-red-500 @enderror"
                    placeholder="admin@example.com">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                <select name="role" id="role" required
                    class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66] @error('role') border-red-500 @enderror">
                    <option value="sub_admin" @selected(old('role', $admin->role) === 'sub_admin')>Sub-admin</option>
                    <option value="super_admin" @selected(old('role', $admin->role) === 'super_admin')>Super admin</option>
                </select>
                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="border-t border-slate-200 pt-5">
                <p class="text-sm font-medium text-slate-700 mb-2">Change password (optional)</p>
                <div class="space-y-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1">New password</label>
                        <input type="password" name="password" id="password"
                            class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66] @error('password') border-red-500 @enderror"
                            placeholder="Leave blank to keep current">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Confirm new password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66]"
                            placeholder="Confirm new password">
                    </div>
                </div>
            </div>

            <div class="pt-2 flex flex-wrap gap-3">
                <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-[#1A3D66] hover:bg-[#153354] text-white font-medium px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/40">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Save changes</span>
                </button>
                <a href="{{ route('admin.admins.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-medium px-4 py-2.5 text-sm">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
