@extends('admin.layout')

@section('title', 'Edit customer — ' . $customer->customer_name)

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.customers.show', $customer->customer_phone_e164) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">← Customer</a>
    </div>
    <h1 class="text-2xl font-semibold mb-6">Edit customer</h1>
    <form method="POST" action="{{ route('admin.customers.update', $customer->customer_phone_e164) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 p-6 max-w-lg space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="customer_name" class="block text-sm font-medium mb-1">Customer name *</label>
            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $customer->customer_name) }}" required class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
            @error('customer_name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <p class="text-sm text-gray-500">Phone: {{ $customer->customer_phone_e164 }} (read-only)</p>
        <div class="flex gap-2">
            <button type="submit" class="rounded-lg bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-medium py-2 px-4 hover:opacity-90">Update</button>
            <a href="{{ route('admin.customers.show', $customer->customer_phone_e164) }}" class="rounded-lg border border-gray-300 dark:border-gray-600 py-2 px-4 text-sm">Cancel</a>
        </div>
    </form>
@endsection
