@extends('admin.layout')

@section('title', 'Users')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#2D3748]">Users</h1>
    </div>
    <div class="bg-white rounded-2xl border border-[#E2E8F0] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#E2E8F0]">
                <thead class="bg-[#F8F8F8]">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Phone</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Currency</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-[#718096] uppercase tracking-wider">Verified</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-[#718096] uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E2E8F0]">
                    @forelse ($users as $user)
                        <tr class="hover:bg-[#F8F8F8]">
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ $user->user_phone_e164 }}</td>
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ $user->email ?? '—' }}</td>
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ $user->currency }}</td>
                            <td class="px-4 py-3 text-sm text-[#2D3748]">{{ $user->phone_verified_at ? 'Yes' : 'No' }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.users.show', $user->user_phone_e164) }}" class="text-sm font-medium text-[#1A3D66] hover:underline">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-[#718096]">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($users->hasPages())
            <div class="px-4 py-3 border-t border-[#E2E8F0]">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
