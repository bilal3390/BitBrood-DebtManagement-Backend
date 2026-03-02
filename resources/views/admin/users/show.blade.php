@extends('admin.layout')

@section('title', 'User — ' . $user->name)
@section('breadcrumb', 'User details')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 hover:text-slate-900">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Users
        </a>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.users.finance', $user->user_phone_e164) }}" class="inline-flex items-center gap-2 rounded-xl bg-[#1A3D66] hover:bg-[#153354] text-white font-medium py-2.5 px-4 text-sm">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                View finance
            </a>
            <a href="{{ route('admin.users.edit', $user->user_phone_e164) }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-medium py-2.5 px-4 text-sm">
                Edit
            </a>
            <form method="POST" action="{{ route('admin.users.destroy', $user->user_phone_e164) }}" class="inline" onsubmit="return confirm('Delete this user and all their data? This cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-white hover:bg-red-50 text-red-600 font-medium py-2.5 px-4 text-sm">
                    Delete
                </button>
            </form>
        </div>
    </div>

    <h1 class="text-xl font-bold text-slate-800 mb-6">User details</h1>
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm max-w-2xl">
        <dl class="divide-y divide-slate-200">
            <div class="px-5 py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                <dt class="text-sm text-slate-500">Phone</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $user->user_phone_e164 }}</dd>
            </div>
            <div class="px-5 py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                <dt class="text-sm text-slate-500">Name</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $user->name }}</dd>
            </div>
            <div class="px-5 py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                <dt class="text-sm text-slate-500">Email</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $user->email ?? '—' }}</dd>
            </div>
            <div class="px-5 py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                <dt class="text-sm text-slate-500">Currency</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $user->currency }}</dd>
            </div>
            <div class="px-5 py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                <dt class="text-sm text-slate-500">Phone verified</dt>
                <dd class="text-sm font-medium text-slate-800">{{ $user->phone_verified_at ? $user->phone_verified_at->format('M j, Y H:i') : 'No' }}</dd>
            </div>
        </dl>
    </div>
@endsection
