@extends('admin.layout')

@section('title', 'Debts / Transactions')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#2D3748]">Debts / Transactions</h1>
        <p class="text-sm text-[#718096] mt-1">Amounts are hidden for privacy. View, edit, and delete are disabled.</p>
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
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E2E8F0]">
                    @forelse ($debts as $debt)
                        <tr class="hover:bg-[#F8F8F8]">
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ $debt->id }}</td>
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ $debt->type }}</td>
                            <td class="px-4 py-3 text-sm text-[#718096] select-none" style="filter: blur(6px); user-select: none;">{{ number_format($debt->total_amount, 2) }}</td>
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ $debt->date }}</td>
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ $debt->user_phone_e164 }}</td>
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ $debt->customer_phone_e164 }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-[#718096]">No debts found.</td>
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
