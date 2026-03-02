@extends('admin.layout')

@section('title', 'Customers')
@section('breadcrumb', 'Customers')

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Customers</h1>
            <p class="text-sm text-slate-500 mt-0.5">View, edit, and delete customers.</p>
        </div>
        <a href="{{ route('admin.customers.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-[#1A3D66] hover:bg-[#153354] text-white font-medium py-2.5 px-4 text-sm shrink-0">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add customer
        </a>
    </div>

    <form class="mb-4 flex flex-col sm:flex-row gap-2" method="GET">
        <input type="text" name="user_phone_e164" value="{{ request('user_phone_e164') }}" placeholder="Filter by user phone" class="flex-1 min-w-0 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66]">
        <button type="submit" class="rounded-xl bg-white border border-slate-200 text-slate-700 font-medium px-4 py-2.5 text-sm hover:bg-slate-50">Filter</button>
    </form>

    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Phone</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">User</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($customers as $customer)
                        <tr class="hover:bg-slate-50/50">
                            <td class="px-4 py-3 text-sm text-slate-800 break-all">{{ $customer->customer_phone_e164 }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-slate-800">{{ $customer->customer_name }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600 break-all">{{ $customer->user_phone_e164 }} @if($customer->user)({{ $customer->user->name }})@endif</td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.customers.show', $customer->customer_phone_e164) }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">View</a>
                                    <a href="{{ route('admin.customers.edit', $customer->customer_phone_e164) }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Edit</a>
                                    <form method="POST" action="{{ route('admin.customers.destroy', $customer->customer_phone_e164) }}" class="inline" onsubmit="return confirm('Delete this customer?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-medium text-red-600 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-slate-500">No customers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($customers->hasPages())
            <div class="px-4 py-3 border-t border-slate-200 bg-slate-50/50">
                {{ $customers->links() }}
            </div>
        @endif
    </div>
@endsection
