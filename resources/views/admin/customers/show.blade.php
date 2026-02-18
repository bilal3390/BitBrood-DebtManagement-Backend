@extends('admin.layout')

@section('title', 'Customer — ' . $customer->customer_name)

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.customers.index') }}" class="text-sm font-medium text-[#718096] hover:text-[#2D3748]">← Customers</a>
        <div class="flex gap-2">
            <a href="{{ route('admin.customers.edit', $customer->customer_phone_e164) }}" class="text-sm font-medium text-[#1A3D66] hover:underline">Edit</a>
            <form method="POST" action="{{ route('admin.customers.destroy', $customer->customer_phone_e164) }}" class="inline" onsubmit="return confirm('Delete this customer?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm font-medium text-red-600 hover:underline">Delete</button>
            </form>
        </div>
    </div>
    <h1 class="text-2xl font-bold text-[#2D3748] mb-6">Customer details</h1>
    <div class="bg-white rounded-2xl border border-[#E2E8F0] overflow-hidden">
        <dl class="divide-y divide-[#E2E8F0]">
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">Phone</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ $customer->customer_phone_e164 }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">Name</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ $customer->customer_name }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">User phone</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ $customer->user_phone_e164 }}</dd>
            </div>
        </dl>
    </div>
@endsection
