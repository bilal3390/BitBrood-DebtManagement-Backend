@extends('admin.layout')

@section('title', 'Debts / Transactions')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#2D3748]">Debts / Transactions</h1>
        <a href="{{ route('admin.debts.create') }}" class="rounded-xl bg-[#1A3D66] hover:bg-[#153354] text-white font-semibold py-2.5 px-4 text-sm flex items-center gap-2">
            Add debt
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        </a>
    </div>
    <form class="mb-4 flex gap-2 flex-wrap" method="GET">
        <input type="text" name="user_phone_e164" value="{{ request('user_phone_e164') }}" placeholder="User phone" class="rounded-xl border border-[#E2E8F0] bg-white px-4 py-2.5 text-sm text-[#2D3748] placeholder-[#718096] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:border-transparent">
        <input type="text" name="customer_phone_e164" value="{{ request('customer_phone_e164') }}" placeholder="Customer phone" class="rounded-xl border border-[#E2E8F0] bg-white px-4 py-2.5 text-sm text-[#2D3748] placeholder-[#718096] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:border-transparent">
        <button type="submit" class="rounded-xl bg-white border border-[#E2E8F0] text-[#2D3748] font-medium px-4 py-2.5 text-sm hover:bg-[#F8F8F8]">Filter</button>
    </form>
    <div class="bg-white rounded-2xl border border-[#E2E8F0] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#E2E8F0]">
                <thead class="bg-[#F8F8F8]">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">User</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Customer</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-[#718096] uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E2E8F0]">
                    @forelse ($debts as $debt)
                        <tr class="hover:bg-[#F8F8F8]">
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ $debt->id }}</td>
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ $debt->type }}</td>
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ number_format($debt->total_amount, 2) }}</td>
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ $debt->date }}</td>
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ $debt->user_phone_e164 }}</td>
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ $debt->customer_phone_e164 }}</td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex gap-2 justify-end">
                                    <a href="{{ route('admin.debts.show', $debt->id) }}" class="text-sm font-medium text-[#1A3D66] hover:underline">View</a>
                                    <a href="{{ route('admin.debts.edit', $debt->id) }}" class="text-sm font-medium text-[#718096] hover:text-[#2D3748]">Edit</a>
                                    <form method="POST" action="{{ route('admin.debts.destroy', $debt->id) }}" class="inline" onsubmit="return confirm('Delete this debt?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-medium text-red-600 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-[#718096]">No debts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($debts->hasPages())
            <div class="px-4 py-3 border-t border-[#E2E8F0]">
                {{ $debts->links() }}
            </div>
        @endif
    </div>
@endsection
