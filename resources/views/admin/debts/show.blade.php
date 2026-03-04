@extends('admin.layout')

@section('title', 'Debt #' . $debt->id)
@section('breadcrumb', 'Transaction #' . $debt->id)

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <a href="{{ route('admin.debts.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 hover:text-slate-900">
            ← Debts & Credits
        </a>
        <span class="text-xs font-medium text-slate-400 uppercase tracking-wide">Read-only</span>
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
                <dd class="text-sm font-medium text-[#2D3748]">
                    <span class="inline-block rounded-lg bg-slate-100 text-slate-400 px-2 py-1 text-xs font-medium select-none">
                        Hidden
                    </span>
                </dd>
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
