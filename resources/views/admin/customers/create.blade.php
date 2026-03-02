@extends('admin.layout')

@section('title', 'Add customer')
@section('breadcrumb', 'Add customer')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.customers.index') }}" class="text-sm font-medium text-[#718096] hover:text-[#2D3748]">← Customers</a>
    </div>
    <h1 class="text-2xl font-bold text-[#2D3748] mb-6">Add customer</h1>
    <form method="POST" action="{{ route('admin.customers.store') }}" class="bg-white rounded-2xl border border-[#E2E8F0] p-6 max-w-lg space-y-4">
        @csrf
        <div>
            <label for="user_phone_e164" class="block text-sm font-semibold text-[#2D3748] mb-1">User (owner) *</label>
            <select name="user_phone_e164" id="user_phone_e164" required class="w-full rounded-xl border border-[#E2E8F0] bg-white px-4 py-3 text-[#2D3748] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:border-transparent">
                <option value="">Select user</option>
                @foreach ($users as $u)
                    <option value="{{ $u->user_phone_e164 }}" @selected(old('user_phone_e164') == $u->user_phone_e164)>{{ $u->name }} ({{ $u->user_phone_e164 }})</option>
                @endforeach
            </select>
            @error('user_phone_e164')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="customer_phone_e164" class="block text-sm font-semibold text-[#2D3748] mb-1">Customer phone (E.164) *</label>
            <input type="text" name="customer_phone_e164" id="customer_phone_e164" value="{{ old('customer_phone_e164') }}" required placeholder="e.g. +1234567890" class="w-full rounded-xl border border-[#E2E8F0] bg-white px-4 py-3 text-[#2D3748] placeholder-[#718096] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:border-transparent">
            @error('customer_phone_e164')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="customer_name" class="block text-sm font-semibold text-[#2D3748] mb-1">Customer name *</label>
            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required placeholder="Enter name" class="w-full rounded-xl border border-[#E2E8F0] bg-white px-4 py-3 text-[#2D3748] placeholder-[#718096] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:border-transparent">
            @error('customer_name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex gap-2 pt-2">
            <button type="submit" class="rounded-xl bg-[#1A3D66] hover:bg-[#153354] text-white font-semibold py-2.5 px-4 flex items-center gap-2">
                Create
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
            <a href="{{ route('admin.customers.index') }}" class="rounded-xl border border-[#E2E8F0] py-2.5 px-4 text-sm font-medium text-[#2D3748] hover:bg-[#F8F8F8]">Cancel</a>
        </div>
    </form>
@endsection
