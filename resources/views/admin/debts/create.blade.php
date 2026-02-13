@extends('admin.layout')

@section('title', 'Add debt')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.debts.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">← Debts</a>
    </div>
    <h1 class="text-2xl font-semibold mb-6">Add debt / transaction</h1>
    <form method="POST" action="{{ route('admin.debts.store') }}" class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 p-6 max-w-lg space-y-4">
        @csrf
        <div>
            <label for="user_phone_e164" class="block text-sm font-medium mb-1">User (owner) *</label>
            <select name="user_phone_e164" id="user_phone_e164" required class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
                <option value="">Select user</option>
                @foreach ($users as $u)
                    <option value="{{ $u->user_phone_e164 }}" @selected(old('user_phone_e164') == $u->user_phone_e164)>{{ $u->name }} ({{ $u->user_phone_e164 }})</option>
                @endforeach
            </select>
            @error('user_phone_e164')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="customer_phone_e164" class="block text-sm font-medium mb-1">Customer *</label>
            <select name="customer_phone_e164" id="customer_phone_e164" required class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
                <option value="">Select customer</option>
                @foreach ($customers as $c)
                    <option value="{{ $c->customer_phone_e164 }}" data-user="{{ $c->user_phone_e164 }}" @selected(old('customer_phone_e164') == $c->customer_phone_e164)>{{ $c->customer_name }} ({{ $c->customer_phone_e164 }})</option>
                @endforeach
            </select>
            @error('customer_phone_e164')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="type" class="block text-sm font-medium mb-1">Type *</label>
            <select name="type" id="type" required class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
                <option value="borrowed" @selected(old('type') == 'borrowed')>Borrowed</option>
                <option value="gave" @selected(old('type') == 'gave')>Gave</option>
            </select>
            @error('type')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="total_amount" class="block text-sm font-medium mb-1">Amount *</label>
            <input type="number" name="total_amount" id="total_amount" value="{{ old('total_amount') }}" step="0.01" min="0" required class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
            @error('total_amount')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="date" class="block text-sm font-medium mb-1">Date *</label>
            <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" required class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
            @error('date')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="due_date" class="block text-sm font-medium mb-1">Due date</label>
            <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
            @error('due_date')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="source" class="block text-sm font-medium mb-1">Source</label>
            <select name="source" id="source" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
                <option value="">—</option>
                <option value="Cash" @selected(old('source') == 'Cash')>Cash</option>
                <option value="Cheque" @selected(old('source') == 'Cheque')>Cheque</option>
                <option value="Other" @selected(old('source') == 'Other')>Other</option>
            </select>
        </div>
        <div>
            <label for="note" class="block text-sm font-medium mb-1">Note</label>
            <input type="text" name="note" id="note" value="{{ old('note') }}" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
            @error('note')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex gap-2">
            <button type="submit" class="rounded-lg bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-medium py-2 px-4 hover:opacity-90">Create</button>
            <a href="{{ route('admin.debts.index') }}" class="rounded-lg border border-gray-300 dark:border-gray-600 py-2 px-4 text-sm">Cancel</a>
        </div>
    </form>
@endsection
