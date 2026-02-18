@extends('admin.layout')

@section('title', 'Edit debt #' . $debt->id)

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.debts.show', $debt->id) }}" class="text-sm font-medium text-[#718096] hover:text-[#2D3748]">← Debt</a>
    </div>
    <h1 class="text-2xl font-bold text-[#2D3748] mb-6">Edit debt #{{ $debt->id }}</h1>
    <form method="POST" action="{{ route('admin.debts.update', $debt->id) }}" class="bg-white rounded-2xl border border-[#E2E8F0] p-6 max-w-lg space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="type" class="block text-sm font-semibold text-[#2D3748] mb-1">Type *</label>
            <select name="type" id="type" required class="w-full rounded-xl border border-[#E2E8F0] bg-white px-4 py-3 text-[#2D3748] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:border-transparent">
                <option value="borrowed" @selected(old('type', $debt->type) == 'borrowed')>Borrowed</option>
                <option value="gave" @selected(old('type', $debt->type) == 'gave')>Gave</option>
            </select>
            @error('type')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="total_amount" class="block text-sm font-semibold text-[#2D3748] mb-1">Amount *</label>
            <input type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', $debt->total_amount) }}" step="0.01" min="0" required class="w-full rounded-xl border border-[#E2E8F0] bg-white px-4 py-3 text-[#2D3748] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:border-transparent">
            @error('total_amount')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="date" class="block text-sm font-semibold text-[#2D3748] mb-1">Date *</label>
            <input type="date" name="date" id="date" value="{{ old('date', $debt->date) }}" required class="w-full rounded-xl border border-[#E2E8F0] bg-white px-4 py-3 text-[#2D3748] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:border-transparent">
            @error('date')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="due_date" class="block text-sm font-semibold text-[#2D3748] mb-1">Due date</label>
            <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $debt->due_date) }}" class="w-full rounded-xl border border-[#E2E8F0] bg-white px-4 py-3 text-[#2D3748] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:border-transparent">
            @error('due_date')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="source" class="block text-sm font-semibold text-[#2D3748] mb-1">Source</label>
            <select name="source" id="source" class="w-full rounded-xl border border-[#E2E8F0] bg-white px-4 py-3 text-[#2D3748] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:border-transparent">
                <option value="">—</option>
                <option value="Cash" @selected(old('source', $debt->source) == 'Cash')>Cash</option>
                <option value="Cheque" @selected(old('source', $debt->source) == 'Cheque')>Cheque</option>
                <option value="Other" @selected(old('source', $debt->source) == 'Other')>Other</option>
            </select>
        </div>
        <div>
            <label for="note" class="block text-sm font-semibold text-[#2D3748] mb-1">Note</label>
            <input type="text" name="note" id="note" value="{{ old('note', $debt->note) }}" placeholder="Optional note" class="w-full rounded-xl border border-[#E2E8F0] bg-white px-4 py-3 text-[#2D3748] placeholder-[#718096] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:border-transparent">
            @error('note')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex gap-2 pt-2">
            <button type="submit" class="rounded-xl bg-[#1A3D66] hover:bg-[#153354] text-white font-semibold py-2.5 px-4 flex items-center gap-2">Update</button>
            <a href="{{ route('admin.debts.show', $debt->id) }}" class="rounded-xl border border-[#E2E8F0] py-2.5 px-4 text-sm font-medium text-[#2D3748] hover:bg-[#F8F8F8]">Cancel</a>
        </div>
    </form>
@endsection
