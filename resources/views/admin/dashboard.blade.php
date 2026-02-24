@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-xl sm:text-2xl font-bold text-[#2D3748] mb-4 sm:mb-6">Dashboard</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        <a href="{{ route('admin.users.index') }}" class="bg-white rounded-xl sm:rounded-2xl border border-[#E2E8F0] p-4 sm:p-6 hover:border-[#1A3D66]/30 hover:shadow-sm transition-all">
            <p class="text-sm font-medium text-[#718096]">Users</p>
            <p class="text-2xl sm:text-3xl font-bold text-[#2D3748] mt-1">{{ $usersCount }}</p>
        </a>
        <a href="{{ route('admin.customers.index') }}" class="bg-white rounded-xl sm:rounded-2xl border border-[#E2E8F0] p-4 sm:p-6 hover:border-[#1A3D66]/30 hover:shadow-sm transition-all">
            <p class="text-sm font-medium text-[#718096]">Customers</p>
            <p class="text-2xl sm:text-3xl font-bold text-[#2D3748] mt-1">{{ $customersCount }}</p>
        </a>
        <a href="{{ route('admin.debts.index') }}" class="bg-white rounded-xl sm:rounded-2xl border border-[#E2E8F0] p-4 sm:p-6 hover:border-[#1A3D66]/30 hover:shadow-sm transition-all sm:col-span-2 lg:col-span-1">
            <p class="text-sm font-medium text-[#718096]">Debts / Transactions</p>
            <p class="text-2xl sm:text-3xl font-bold text-[#2D3748] mt-1">{{ $debtsCount }}</p>
        </a>
    </div>

    <div class="mt-12 pt-8 border-t border-[#E2E8F0]">
        <h2 class="text-lg font-semibold text-[#2D3748] mb-2">Danger zone</h2>
        <p class="text-sm text-[#718096] mb-4">Permanently delete all users, customers, and debts. Useful for resetting test data.</p>
        <button type="button" onclick="document.getElementById('delete-all-modal').showModal()" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-[#F8F8F8]">
            Delete all data
        </button>
    </div>

    <dialog id="delete-all-modal" class="rounded-2xl shadow-lg p-0 w-full max-w-md border border-[#E2E8F0] bg-white" @if($errors->has('password')) open @endif>
        <div class="p-6">
            <h3 class="text-lg font-semibold text-[#2D3748] mb-2">Delete all data</h3>
            <p class="text-sm text-[#718096] mb-4">This will permanently delete all users, customers, and debts. This action cannot be undone. Enter your password to confirm.</p>
            <form method="POST" action="{{ route('admin.data.delete-all') }}">
                @csrf
                <label for="delete-all-password" class="block text-sm font-semibold text-[#2D3748] mb-1">Your password</label>
                <input type="password" name="password" id="delete-all-password" required autocomplete="current-password" placeholder="Enter your admin password" class="block w-full rounded-xl border border-[#E2E8F0] bg-white text-[#2D3748] px-4 py-3 text-sm placeholder-[#718096] focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div class="mt-4 flex gap-3 justify-end">
                    <button type="button" onclick="document.getElementById('delete-all-modal').close()" class="px-4 py-2 text-sm font-medium text-[#718096] bg-[#F8F8F8] hover:bg-[#E2E8F0] rounded-xl border border-[#E2E8F0]">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-white">
                        Delete all data
                    </button>
                </div>
            </form>
        </div>
    </dialog>
@endsection
