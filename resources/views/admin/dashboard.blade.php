@extends('admin.layout')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
    <h1 class="text-xl font-bold text-slate-800 mb-6">Dashboard</h1>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
        <a href="{{ route('admin.users.index') }}" class="group bg-white rounded-2xl border border-slate-200 p-6 hover:border-[#1A3D66]/40 hover:shadow-md transition-all">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#1A3D66]/10 text-[#1A3D66] group-hover:bg-[#1A3D66]/15 transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Users</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $usersCount }}</p>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.customers.index') }}" class="group bg-white rounded-2xl border border-slate-200 p-6 hover:border-[#1A3D66]/40 hover:shadow-md transition-all">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#1A3D66]/10 text-[#1A3D66] group-hover:bg-[#1A3D66]/15 transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Customers</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $customersCount }}</p>
                </div>
            </div>
        </a>
        <a href="{{ route('admin.debts.index') }}" class="group bg-white rounded-2xl border border-slate-200 p-6 hover:border-[#1A3D66]/40 hover:shadow-md transition-all">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#1A3D66]/10 text-[#1A3D66] group-hover:bg-[#1A3D66]/15 transition-colors">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Debts & Credits</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $debtsCount }}</p>
                </div>
            </div>
        </a>
    </div>

    <div class="mt-12 pt-8 border-t border-slate-200">
        <h2 class="text-lg font-semibold text-slate-800 mb-2">Danger zone</h2>
        <p class="text-sm text-slate-500 mb-4">Permanently delete all users, customers, and debts. Useful for resetting test data.</p>
        <button type="button" onclick="document.getElementById('delete-all-modal').showModal()" class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-white">
            Delete all data
        </button>
    </div>

    <dialog id="delete-all-modal" class="rounded-2xl shadow-xl p-0 w-full max-w-md border border-slate-200 bg-white" @if($errors->has('password')) open @endif>
        <div class="p-6">
            <h3 class="text-lg font-semibold text-slate-800 mb-2">Delete all data</h3>
            <p class="text-sm text-slate-500 mb-4">This will permanently delete all users, customers, and debts. This action cannot be undone. Enter your password to confirm.</p>
            <form method="POST" action="{{ route('admin.data.delete-all') }}">
                @csrf
                <label for="delete-all-password" class="block text-sm font-semibold text-slate-700 mb-1">Your password</label>
                <input type="password" name="password" id="delete-all-password" required autocomplete="current-password" placeholder="Enter your admin password" class="block w-full rounded-xl border border-slate-200 bg-white text-slate-800 px-4 py-3 text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div class="mt-4 flex gap-3 justify-end">
                    <button type="button" onclick="document.getElementById('delete-all-modal').close()" class="px-4 py-2.5 text-sm font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Delete all data
                    </button>
                </div>
            </form>
        </div>
    </dialog>
@endsection
