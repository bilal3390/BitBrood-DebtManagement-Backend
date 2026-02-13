@extends('admin.layout')

@section('title', 'Debt #' . $debt->id)

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.debts.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">← Debts</a>
        <div class="flex gap-2">
            <a href="{{ route('admin.debts.edit', $debt->id) }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Edit</a>
            <form method="POST" action="{{ route('admin.debts.destroy', $debt->id) }}" class="inline" onsubmit="return confirm('Delete this debt?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:underline">Delete</button>
            </form>
        </div>
    </div>
    <h1 class="text-2xl font-semibold mb-6">Debt #{{ $debt->id }}</h1>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
        <dl class="divide-y divide-gray-200 dark:divide-gray-700">
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">Type</dt>
                <dd class="text-sm font-medium">{{ $debt->type }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">Amount</dt>
                <dd class="text-sm font-medium">{{ number_format($debt->total_amount, 2) }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">Date</dt>
                <dd class="text-sm font-medium">{{ $debt->date }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">Due date</dt>
                <dd class="text-sm font-medium">{{ $debt->due_date ?? '—' }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">Source</dt>
                <dd class="text-sm font-medium">{{ $debt->source ?? '—' }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">Note</dt>
                <dd class="text-sm font-medium">{{ $debt->note ?? '—' }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">User phone</dt>
                <dd class="text-sm font-medium">{{ $debt->user_phone_e164 }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-gray-500 dark:text-gray-400">Customer phone</dt>
                <dd class="text-sm font-medium">{{ $debt->customer_phone_e164 }}</dd>
            </div>
        </dl>
    </div>
@endsection
