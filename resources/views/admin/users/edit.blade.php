@extends('admin.layout')

@section('title', 'Edit user — ' . $user->name)
@section('breadcrumb', 'Edit user')

@section('content')
    <div class="mb-6 flex flex-wrap items-center gap-3">
        <a href="{{ route('admin.users.show', $user->user_phone_e164) }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 hover:text-slate-900">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to user
        </a>
    </div>
    <div class="max-w-xl">
        <h1 class="text-xl font-bold text-slate-800 mb-6">Edit user</h1>
        <form method="POST" action="{{ route('admin.users.update', $user->user_phone_e164) }}" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required placeholder="Full name" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66]">
                @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="user@example.com" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66]">
                @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="currency" class="block text-sm font-semibold text-slate-700 mb-1">Currency *</label>
                <input type="text" name="currency" id="currency" value="{{ old('currency', $user->currency) }}" required placeholder="e.g. USD" maxlength="10" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66]">
                @error('currency')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <p class="text-sm text-slate-500">Phone: <code class="bg-slate-100 px-1 rounded">{{ $user->user_phone_e164 }}</code> (read-only)</p>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-[#1A3D66] hover:bg-[#153354] text-white font-semibold py-2.5 px-5 inline-flex items-center gap-2">
                    Save changes
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </button>
                <a href="{{ route('admin.users.show', $user->user_phone_e164) }}" class="rounded-xl border border-slate-200 py-2.5 px-5 text-sm font-medium text-slate-700 hover:bg-slate-50">Cancel</a>
            </div>
        </form>
    </div>
@endsection
