@extends('admin.layout')

@section('title', 'Add customer')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.customers.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">← Customers</a>
    </div>
    <h1 class="text-2xl font-semibold mb-6">Add customer</h1>
    <form method="POST" action="{{ route('admin.customers.store') }}" class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 p-6 max-w-lg space-y-4">
        @csrf
        <div>
            <label for="user_phone_e164" class="block text-sm font-medium mb-1">User (owner) *</label>
            <select name="user_phone_e164" id="user_phone_e164" required class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
                <option value="">Select user</option>
                @foreach ($users as $u)
                    <option value="{{ $u->user_phone_e164 }}" @selected(old('user_phone_e164') == $u->user_phone_e164)>{{ $u->name }} ({{ $u->user_phone_e164 }})</option>
                @endforeach
            </select>
            @error('user_phone_e164')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="customer_phone_e164" class="block text-sm font-medium mb-1">Customer phone (E.164) *</label>
            <input type="text" name="customer_phone_e164" id="customer_phone_e164" value="{{ old('customer_phone_e164') }}" required class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
            @error('customer_phone_e164')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="customer_name" class="block text-sm font-medium mb-1">Customer name *</label>
            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
            @error('customer_name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex gap-2">
            <button type="submit" class="rounded-lg bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-medium py-2 px-4 hover:opacity-90">Create</button>
            <a href="{{ route('admin.customers.index') }}" class="rounded-lg border border-gray-300 dark:border-gray-600 py-2 px-4 text-sm">Cancel</a>
        </div>
    </form>
@endsection
