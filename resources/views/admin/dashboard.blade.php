@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Dashboard</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.users.index') }}" class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600">
            <p class="text-sm text-gray-500 dark:text-gray-400">Users</p>
            <p class="text-3xl font-semibold mt-1">{{ $usersCount }}</p>
        </a>
        <a href="{{ route('admin.customers.index') }}" class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600">
            <p class="text-sm text-gray-500 dark:text-gray-400">Customers</p>
            <p class="text-3xl font-semibold mt-1">{{ $customersCount }}</p>
        </a>
        <a href="{{ route('admin.debts.index') }}" class="bg-white dark:bg-gray-800 rounded-xl shadow p-6 border border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600">
            <p class="text-sm text-gray-500 dark:text-gray-400">Debts / Transactions</p>
            <p class="text-3xl font-semibold mt-1">{{ $debtsCount }}</p>
        </a>
    </div>

    <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Danger zone</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Permanently delete all users, customers, and debts. Useful for resetting test data.</p>
        <button type="button" onclick="document.getElementById('delete-all-modal').showModal()" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
            Delete all data
        </button>
    </div>

    <dialog id="delete-all-modal" class="rounded-xl shadow-lg p-0 w-full max-w-md border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800" @if($errors->has('password')) open @endif>
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Delete all data</h3>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">This will permanently delete all users, customers, and debts. This action cannot be undone. Enter your password to confirm.</p>
            <form method="POST" action="{{ route('admin.data.delete-all') }}">
                @csrf
                <label for="delete-all-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Your password</label>
                <input type="password" name="password" id="delete-all-password" required autocomplete="current-password" class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent @error('password') border-red-500 @enderror" placeholder="Enter your admin password">
                @error('password')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                <div class="mt-4 flex gap-3 justify-end">
                    <button type="button" onclick="document.getElementById('delete-all-modal').close()" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Delete all data
                    </button>
                </div>
            </form>
        </div>
    </dialog>

@endsection
