@extends('admin.layout')

@section('title', 'Debts & Credits')
@section('breadcrumb', 'Debts & Credits')

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Debts & Credits</h1>
            <p class="text-sm text-slate-500 mt-0.5">View, edit, and delete transactions.</p>
        </div>
        <a href="{{ route('admin.debts.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-[#1A3D66] hover:bg-[#153354] text-white font-medium py-2.5 px-4 text-sm shrink-0">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add transaction
        </a>
    </div>

    <form class="mb-4 flex flex-col sm:flex-row gap-2 sm:flex-wrap" method="GET">
        <input type="text" name="user_phone_e164" value="{{ request('user_phone_e164') }}" placeholder="User phone" class="flex-1 min-w-0 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66]">
        <input type="text" name="customer_phone_e164" value="{{ request('customer_phone_e164') }}" placeholder="Customer phone" class="flex-1 min-w-0 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66]">
        <button type="submit" class="rounded-xl bg-white border border-slate-200 text-slate-700 font-medium px-4 py-2.5 text-sm hover:bg-slate-50">Filter</button>
    </form>

    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">User</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Customer</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($debts as $debt)
                        <tr class="hover:bg-slate-50/50">
                            <td class="px-4 py-3 text-sm text-slate-800">{{ $debt->id }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $debt->type === 'borrowed' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ $debt->type === 'borrowed' ? 'Borrowed' : 'Gave' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm font-semibold text-slate-800">{{ number_format($debt->total_amount, 2) }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $debt->date }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600 break-all">
                                @if($debt->user)
                                    <a href="{{ route('admin.users.show', $debt->user_phone_e164) }}" class="text-[#1A3D66] hover:underline">{{ $debt->user->name }}</a>
                                @else
                                    {{ $debt->user_phone_e164 }}
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600 break-all">{{ $debt->customer_phone_e164 }}@if($debt->customer) ({{ $debt->customer->customer_name }})@endif</td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.debts.show', $debt->id) }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">View</a>
                                    <a href="{{ route('admin.debts.edit', $debt->id) }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Edit</a>
                                    <form method="POST" action="{{ route('admin.debts.destroy', $debt->id) }}" class="inline" onsubmit="return confirm('Delete this transaction?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-medium text-red-600 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-10 text-center text-slate-500">No transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($debts->hasPages())
            <div class="px-4 py-3 border-t border-slate-200 bg-slate-50/50">
                {{ $debts->links() }}
            </div>
        @endif
    </div>
@endsection
