@extends('admin.layout')

@section('title', 'Debts / Transactions')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Debts / Transactions</h1>
        <a href="{{ route('admin.debts.create') }}" class="rounded-lg bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-medium py-2 px-4 text-sm hover:opacity-90">Add debt</a>
    </div>
    <form class="mb-4 flex gap-2 flex-wrap" method="GET">
        <input type="text" name="user_phone_e164" value="{{ request('user_phone_e164') }}" placeholder="User phone" class="rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-3 py-1.5 text-sm">
        <input type="text" name="customer_phone_e164" value="{{ request('customer_phone_e164') }}" placeholder="Customer phone" class="rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 px-3 py-1.5 text-sm">
        <button type="submit" class="rounded-lg bg-gray-200 dark:bg-gray-700 px-3 py-1.5 text-sm">Filter</button>
    </form>
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden border border-gray-200 dark:border-gray-700">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">User</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Customer</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($debts as $debt)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30">
                            <td class="px-4 py-3 text-sm">{{ $debt->id }}</td>
                            <td class="px-4 py-3 text-sm">{{ $debt->type }}</td>
                            <td class="px-4 py-3 text-sm">{{ number_format($debt->total_amount, 2) }}</td>
                            <td class="px-4 py-3 text-sm">{{ $debt->date }}</td>
                            <td class="px-4 py-3 text-sm">{{ $debt->user_phone_e164 }}</td>
                            <td class="px-4 py-3 text-sm">{{ $debt->customer_phone_e164 }}</td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex gap-2 justify-end">
                                    <a href="{{ route('admin.debts.show', $debt->id) }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View</a>
                                    <a href="{{ route('admin.debts.edit', $debt->id) }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('admin.debts.destroy', $debt->id) }}" class="inline" onsubmit="return confirm('Delete this debt?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">No debts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($debts->hasPages())
            <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
                {{ $debts->links() }}
            </div>
        @endif
    </div>
@endsection
