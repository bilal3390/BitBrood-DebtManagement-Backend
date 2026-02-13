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
@endsection
