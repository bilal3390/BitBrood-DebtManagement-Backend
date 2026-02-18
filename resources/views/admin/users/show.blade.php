@extends('admin.layout')

@section('title', 'User — ' . $user->name)

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-[#718096] hover:text-[#2D3748]">← Users</a>
    </div>
    <h1 class="text-2xl font-bold text-[#2D3748] mb-6">User details</h1>
    <div class="bg-white rounded-2xl border border-[#E2E8F0] overflow-hidden">
        <dl class="divide-y divide-[#E2E8F0]">
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">Phone</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ $user->user_phone_e164 }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">Name</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ $user->name }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">Email</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ $user->email ?? '—' }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">Currency</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ $user->currency }}</dd>
            </div>
            <div class="px-4 py-3 flex justify-between gap-4">
                <dt class="text-sm text-[#718096]">Phone verified</dt>
                <dd class="text-sm font-medium text-[#2D3748]">{{ $user->phone_verified_at ? $user->phone_verified_at->format('Y-m-d H:i') : 'No' }}</dd>
            </div>
        </dl>
    </div>
@endsection
