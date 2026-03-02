@extends('admin.layout')

@section('title', 'Users')
@section('breadcrumb', 'Users')

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Users</h1>
            <p class="text-sm text-slate-500 mt-0.5">View, edit, delete users and their finance.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Phone</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider hidden sm:table-cell">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider hidden md:table-cell">Currency</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Verified</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($users as $user)
                        <tr class="hover:bg-slate-50/50">
                            <td class="px-4 py-3 text-sm text-slate-800 break-all">{{ $user->user_phone_e164 }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-slate-800">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600 break-all hidden sm:table-cell">{{ $user->email ?? '—' }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600 hidden md:table-cell">{{ $user->currency }}</td>
                            <td class="px-4 py-3">
                                @if($user->phone_verified_at)
                                    <span class="inline-flex items-center rounded-full bg-emerald-100 px-2 py-0.5 text-xs font-medium text-emerald-800">Yes</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-2 py-0.5 text-xs font-medium text-slate-600">No</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.show', $user->user_phone_e164) }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">View</a>
                                    <a href="{{ route('admin.users.finance', $user->user_phone_e164) }}" class="text-sm font-medium text-[#1A3D66] hover:underline">Finance</a>
                                    <a href="{{ route('admin.users.edit', $user->user_phone_e164) }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Edit</a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user->user_phone_e164) }}" class="inline" onsubmit="return confirm('Delete this user and all their data?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-medium text-red-600 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-slate-500">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($users->hasPages())
            <div class="px-4 py-3 border-t border-slate-200 bg-slate-50/50">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
