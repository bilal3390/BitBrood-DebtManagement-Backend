@extends('admin.layout')

@section('title', 'Profile')
@section('breadcrumb', 'Profile')

@section('content')
    <div class="mb-6">
        <h1 class="text-xl font-bold text-slate-800">My profile</h1>
        <p class="text-sm text-slate-500 mt-0.5">View and manage your admin account.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm max-w-xl overflow-hidden">
        <div class="p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-slate-500 mb-0.5">Name</label>
                <p class="text-slate-800 font-medium">{{ $admin->name }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-500 mb-0.5">Email</label>
                <p class="text-slate-800 font-medium">{{ $admin->email }}</p>
            </div>
            <div class="pt-2 flex flex-wrap gap-3">
                <a href="{{ route('admin.profile.edit') }}" class="inline-flex items-center gap-2 rounded-xl bg-[#1A3D66] hover:bg-[#153354] text-white font-medium px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/40 focus:ring-offset-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Edit profile</span>
                </a>
            </div>
        </div>
    </div>
@endsection
