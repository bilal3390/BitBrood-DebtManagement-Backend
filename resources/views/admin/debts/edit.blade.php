@extends('admin.layout')

@section('title', 'Edit debt #' . $debt->id)

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.debts.show', $debt->id) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">← Debt</a>
    </div>
    <h1 class="text-2xl font-semibold mb-6">Edit debt #{{ $debt->id }}</h1>
    <form method="POST" action="{{ route('admin.debts.update', $debt->id) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 p-6 max-w-lg space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="type" class="block text-sm font-medium mb-1">Type *</label>
            <select name="type" id="type" required class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
                <option value="borrowed" @selected(old('type', $debt->type) == 'borrowed')>Borrowed</option>
                <option value="gave" @selected(old('type', $debt->type) == 'gave')>Gave</option>
            </select>
            @error('type')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="total_amount" class="block text-sm font-medium mb-1">Amount *</label>
            <input type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', $debt->total_amount) }}" step="0.01" min="0" required class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
            @error('total_amount')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="date" class="block text-sm font-medium mb-1">Date *</label>
            <input type="date" name="date" id="date" value="{{ old('date', $debt->date) }}" required class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
            @error('date')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="due_date" class="block text-sm font-medium mb-1">Due date</label>
            <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $debt->due_date) }}" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
            @error('due_date')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="source" class="block text-sm font-medium mb-1">Source</label>
            <select name="source" id="source" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
                <option value="">—</option>
                <option value="Cash" @selected(old('source', $debt->source) == 'Cash')>Cash</option>
                <option value="Cheque" @selected(old('source', $debt->source) == 'Cheque')>Cheque</option>
                <option value="Other" @selected(old('source', $debt->source) == 'Other')>Other</option>
            </select>
        </div>
        <div>
            <label for="note" class="block text-sm font-medium mb-1">Note</label>
            <input type="text" name="note" id="note" value="{{ old('note', $debt->note) }}" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
            @error('note')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex gap-2">
            <button type="submit" class="rounded-lg bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-medium py-2 px-4 hover:opacity-90">Update</button>
            <a href="{{ route('admin.debts.show', $debt->id) }}" class="rounded-lg border border-gray-300 dark:border-gray-600 py-2 px-4 text-sm">Cancel</a>
        </div>
    </form>
@endsection
