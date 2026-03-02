@extends('admin.layout')

@section('title', 'Edit customer — ' . $customer->customer_name)
@section('breadcrumb', 'Edit customer')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.customers.show', $customer->customer_phone_e164) }}" class="text-sm font-medium text-[#718096] hover:text-[#2D3748]">← Customer</a>
    </div>
    <h1 class="text-2xl font-bold text-[#2D3748] mb-6">Edit customer</h1>
    <form method="POST" action="{{ route('admin.customers.update', $customer->customer_phone_e164) }}" class="bg-white rounded-2xl border border-[#E2E8F0] p-6 max-w-lg space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="customer_name" class="block text-sm font-semibold text-[#2D3748] mb-1">Customer name *</label>
            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $customer->customer_name) }}" required placeholder="Enter name" class="w-full rounded-xl border border-[#E2E8F0] bg-white px-4 py-3 text-[#2D3748] placeholder-[#718096] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:border-transparent">
            @error('customer_name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <p class="text-sm text-[#718096]">Phone: {{ $customer->customer_phone_e164 }} (read-only)</p>
        <div class="flex gap-2 pt-2">
            <button type="submit" class="rounded-xl bg-[#1A3D66] hover:bg-[#153354] text-white font-semibold py-2.5 px-4 flex items-center gap-2">Update</button>
            <a href="{{ route('admin.customers.show', $customer->customer_phone_e164) }}" class="rounded-xl border border-[#E2E8F0] py-2.5 px-4 text-sm font-medium text-[#2D3748] hover:bg-[#F8F8F8]">Cancel</a>
        </div>
    </form>
@endsection
