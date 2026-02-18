@extends('admin.layout')

@section('title', 'Debt #' . $debt->id)

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.debts.index') }}" class="text-sm font-medium text-[#718096] hover:text-[#2D3748]">← Debts</a>
        <div class="flex gap-2">
            <a href="{{ route('admin.debts.edit', $debt->id) }}" class="text-sm font-medium text-[#1A3D66] hover:underline">Edit</a>
            <form method="POST" action="{{ route('admin.debts.destroy', $debt->id) }}" class="inline" onsubmit="return confirm('Delete this debt?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm font-medium text-red-600 hover:underline">Delete</button>
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
