@extends('admin.layout')

@section('title', 'Users')

@section('content')
    <div class="mb-4 sm:mb-6">
        <h1 class="text-xl sm:text-2xl font-bold text-[#2D3748]">Users</h1>
    </div>
    <div class="bg-white rounded-xl sm:rounded-2xl border border-[#E2E8F0] overflow-hidden -mx-4 sm:mx-0">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#E2E8F0]">
                <thead class="bg-[#F8F8F8]">
                    <tr>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Phone</th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Name</th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Email</th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Currency</th>
                        <th class="px-2 sm:px-4 py-2 sm:py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Verified</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E2E8F0]">
                    @forelse ($users as $user)
                        <tr class="hover:bg-[#F8F8F8]">
                            <td class="px-2 sm:px-4 py-2 sm:py-3 text-sm text-[#2D3748] break-all">{{ $user->user_phone_e164 }}</td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3 text-sm text-[#2D3748]">{{ $user->name }}</td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3 text-sm text-[#2D3748] break-all">{{ $user->email ?? '—' }}</td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3 text-sm text-[#2D3748]">{{ $user->currency }}</td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3 text-sm text-[#2D3748]">{{ $user->phone_verified_at ? 'Yes' : 'No' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-[#718096]">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($users->hasPages())
            <div class="px-2 sm:px-4 py-3 border-t border-[#E2E8F0] overflow-x-auto">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
