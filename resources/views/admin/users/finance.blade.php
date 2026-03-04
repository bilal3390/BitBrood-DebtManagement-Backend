@extends('admin.layout')

@section('title', 'Finance — ' . $user->name)
@section('breadcrumb', 'User finance')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <a href="{{ route('admin.users.show', $user->user_phone_e164) }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 hover:text-slate-900">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to {{ $user->name }}
        </a>
    </div>

    <div class="mb-8">
        <h1 class="text-xl font-bold text-slate-800 mb-1">Finance</h1>
        <p class="text-sm text-slate-500">Debts & credits for <strong>{{ $user->name }}</strong> ({{ $user->user_phone_e164 }}) — amounts are hidden for privacy.</p>
    </div>

    @php
        $totalBorrowed = $debts->where('type', 'borrowed')->sum('total_amount');
        $totalGave = $debts->where('type', 'gave')->sum('total_amount');
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500 mb-1">Borrowed (they owe)</p>
            <p class="text-2xl font-bold text-emerald-600">
                <span class="inline-block rounded-lg bg-slate-100 text-slate-400 px-3 py-1 text-sm font-semibold select-none">
                    Hidden
                </span>
            </p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <p class="text-sm font-medium text-slate-500 mb-1">Gave (they lent)</p>
            <p class="text-2xl font-bold text-amber-600">
                <span class="inline-block rounded-lg bg-slate-100 text-slate-400 px-3 py-1 text-sm font-semibold select-none">
                    Hidden
                </span>
            </p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="px-4 py-3 border-b border-slate-200 flex items-center justify-between">
            <h2 class="font-semibold text-slate-800">Transactions</h2>
            <span class="text-sm text-slate-500">{{ $debts->count() }} total</span>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Customer</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Note</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($debts as $debt)
                        <tr class="hover:bg-slate-50/50">
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $debt->type === 'borrowed' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ $debt->type === 'borrowed' ? 'Borrowed' : 'Gave' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm font-semibold text-slate-800">
                                <span class="inline-block rounded-lg bg-slate-100 text-slate-400 px-2 py-1 text-xs font-medium select-none">
                                    Hidden
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $debt->date }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $debt->customer?->customer_name ?? $debt->customer_phone_e164 }}</td>
                            <td class="px-4 py-3 text-sm text-slate-500 max-w-[12rem] truncate">{{ $debt->note ?? '—' }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.debts.show', $debt->id) }}" class="inline-flex p-2 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-[#1A3D66] transition-colors" title="View">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-slate-500">No transactions yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
