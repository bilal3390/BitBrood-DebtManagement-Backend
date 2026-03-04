@extends('admin.layout')

@section('title', 'Debt #' . $debt->id)
@section('breadcrumb', 'Transaction #' . $debt->id)

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <a href="{{ route('admin.debts.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 hover:text-slate-900">
            ← Debts & Credits
        </a>
        <div class="flex items-center gap-1">
            <a
                href="{{ route('admin.debts.edit', $debt->id) }}"
                class="p-2 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-800 transition-colors"
                title="Edit"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </a>
            <form
                method="POST"
                action="{{ route('admin.debts.destroy', $debt->id) }}"
                class="inline"
                onsubmit="return confirm('Delete this debt?');"
            >
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    class="p-2 rounded-lg text-slate-500 hover:bg-red-50 hover:text-red-600 transition-colors"
                    title="Delete"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
    <h1 class="text-2xl font-bold text-[#2D3748] mb-6">Debt #{{ $debt->id }}</h1>
    <div class="bg-white rounded-2xl border border-[#E2E8F0] overflow-hidden">
        <dl class="divide-y divide-[#E2E8F0]">
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">Type</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ $debt->type }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">Amount</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ number_format($debt->total_amount, 2) }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">Date</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ $debt->date }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">Due date</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ $debt->due_date ?? '—' }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">Source</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ $debt->source ?? '—' }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">Note</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ $debt->note ?? '—' }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">User phone</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ $debt->user_phone_e164 }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">Customer phone</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ $debt->customer_phone_e164 }}</dd>
            </div>
        </dl>
    </div>
@endsection
