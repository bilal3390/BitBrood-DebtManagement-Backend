@extends('admin.layout')

@section('title', 'Customer — ' . $customer->customer_name)
@section('breadcrumb', 'Customer details')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 hover:text-slate-900">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Customers
        </a>
        <span class="text-xs font-medium text-slate-400 uppercase tracking-wide">Read-only</span>
    </div>
    <h1 class="text-xl font-bold text-slate-800 mb-6">Customer details</h1>
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm max-w-2xl">
        <dl class="divide-y divide-slate-200">
            <div class="px-5 py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                <dt class="text-sm text-slate-500">Phone</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $customer->customer_phone_e164 }}</dd>
            </div>
            <div class="px-5 py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                <dt class="text-sm text-slate-500">Name</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $customer->customer_name }}</dd>
            </div>
            <div class="px-5 py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                <dt class="text-sm text-slate-500">User</dt>
                <dd class="text-sm font-medium text-slate-800">
                    @if($customer->user)
                        <a href="{{ route('admin.users.show', $customer->user_phone_e164) }}" class="text-[#1A3D66] hover:underline">{{ $customer->user->name }}</a>
                        <span class="text-slate-500">({{ $customer->user_phone_e164 }})</span>
                    @else
                        {{ $customer->user_phone_e164 }}
                    @endif
                </dd>
            </div>
        </dl>
    </div>
@endsection
