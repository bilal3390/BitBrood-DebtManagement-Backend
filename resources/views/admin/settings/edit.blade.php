@extends('admin.layout')

@section('title', 'Settings')
@section('breadcrumb', 'Settings')

@section('content')
    <div class="mb-6">
        <h1 class="text-xl font-bold text-slate-800">App settings</h1>
        <p class="text-sm text-slate-500 mt-0.5">Manage public app settings like the download link shown on the landing page.</p>
    </div>

    @if (session('status'))
        <div class="mb-4 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-200 px-4 py-3 text-sm flex items-center gap-2">
            <svg class="h-5 w-5 shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm max-w-xl">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="download_link" class="block text-sm font-medium text-slate-700 mb-1">
                    Download link (EAS build / app URL)
                </label>
                <input
                    type="url"
                    name="download_link"
                    id="download_link"
                    class="block w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30 focus:border-[#1A3D66] @error('download_link') border-red-500 focus:ring-red-500/40 focus:border-red-500 @enderror"
                    value="{{ old('download_link', $downloadLink ?? '') }}"
                    required
                    placeholder="https://example.com/app-download"
                >
                @error('download_link')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-slate-500">
                    This link will be used for the “Download now” button on the public landing page.
                </p>
            </div>

            <div class="pt-2">
                <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-[#1A3D66] hover:bg-[#153354] text-white font-medium px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/40 focus:ring-offset-2 focus:ring-offset-white">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Save changes</span>
                </button>
            </div>
        </form>
    </div>
@endsection

