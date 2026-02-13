@extends('admin.layout')

@section('title', 'User — ' . $user->name)

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">← Users</a>
    </div>
    <h1 class="text-2xl font-semibold mb-6">User details</h1>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
        <dl class="divide-y divide-gray-200 dark:divide-gray-700">
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">Phone</dt>
                <dd class="text-sm font-medium">{{ $user->user_phone_e164 }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">Name</dt>
                <dd class="text-sm font-medium">{{ $user->name }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">Email</dt>
                <dd class="text-sm font-medium">{{ $user->email ?? '—' }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">Currency</dt>
                <dd class="text-sm font-medium">{{ $user->currency }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">Phone verified</dt>
                <dd class="text-sm font-medium">{{ $user->phone_verified_at ? $user->phone_verified_at->format('Y-m-d H:i') : 'No' }}</dd>
            </div>
        </dl>
    </div>
@endsection
