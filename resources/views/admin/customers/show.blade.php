@extends('admin.layout')

@section('title', 'Customer — ' . $customer->customer_name)

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.customers.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">← Customers</a>
        <div class="flex gap-2">
            <a href="{{ route('admin.customers.edit', $customer->customer_phone_e164) }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Edit</a>
            <form method="POST" action="{{ route('admin.customers.destroy', $customer->customer_phone_e164) }}" class="inline" onsubmit="return confirm('Delete this customer?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:underline">Delete</button>
            </form>
        </div>
    </div>
    <h1 class="text-2xl font-semibold mb-6">Customer details</h1>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
        <dl class="divide-y divide-gray-200 dark:divide-gray-700">
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">Phone</dt>
                <dd class="text-sm font-medium">{{ $customer->customer_phone_e164 }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">Name</dt>
                <dd class="text-sm font-medium">{{ $customer->customer_name }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">User phone</dt>
                <dd class="text-sm font-medium">{{ $customer->user_phone_e164 }}</dd>
            </div>
        </dl>
    </div>
@endsection
