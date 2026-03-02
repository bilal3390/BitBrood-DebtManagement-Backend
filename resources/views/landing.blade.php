<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Debt Manager — Track what you owe</title>
    <meta name="description" content="Track what you owe and who owes you. Debt Manager helps you manage debts and stay on top of your finances.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|instrument-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        body { font-family: 'DM Sans', 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
        .gradient-mesh { background: linear-gradient(135deg, #0f172a 0%, #1e293b 40%, #1a3d66 70%, #0f172a 100%); }
        .hero-glow { box-shadow: 0 0 80px -20px rgba(26, 61, 102, 0.5); }
        .card-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.15); }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen antialiased">
    <div class="relative overflow-hidden">
        {{-- Header --}}
        <header class="sticky top-0 z-20 border-b border-slate-200/80 bg-white/80 backdrop-blur-md">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <a href="{{ url('/') }}" class="flex items-center gap-2 font-semibold text-lg text-slate-800 hover:text-slate-600 transition-colors">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#1A3D66] text-white text-sm font-bold">D</span>
                        Debt Manager
                    </a>
                    <nav class="flex items-center gap-2">
                        <a href="{{ url('/admin/login') }}" class="inline-flex items-center gap-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-medium py-2.5 px-4 text-sm transition-colors">
                            Admin
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </nav>
                </div>
            </div>
        </header>

        {{-- Hero --}}
        <main class="relative">
            <div class="gradient-mesh absolute inset-0 -z-10 min-h-[70vh] lg:min-h-[85vh]"></div>
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 sm:pt-20 lg:pt-28 pb-20 lg:pb-32">
                <div class="text-center max-w-3xl mx-auto">
                    <p class="text-slate-300 text-sm font-semibold uppercase tracking-[0.2em] mb-4">
                        Welcome to Debt Manager
                    </p>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white mb-5 leading-tight">
                        Know who owes you.<br>
                        <span class="text-slate-300">Track what you owe.</span>
                    </h1>
                    <p class="text-lg sm:text-xl text-slate-300/90 leading-relaxed mb-10">
                        Simple, private, and always in sync. Take control of your money with the app that keeps every IOU in one place.
                    </p>

                    <a
                        href="https://play.google.com/store/apps/details?id=com.bitbrood.debtmanagement"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="hero-glow inline-flex items-center gap-3 px-6 py-4 rounded-2xl bg-white hover:bg-slate-50 text-slate-900 font-semibold transition-all shadow-lg hover:shadow-xl"
                    >
                        <svg class="w-10 h-10 text-slate-700" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 01-.61-.92V2.734a1 1 0 01.609-.92zm10.89 10.893l2.302 2.302-10.937 6.333 8.635-8.635zm3.199-3.198l2.807 1.626a1 1 0 010 1.73l-2.808 1.626L15.206 12l2.492-2.491zM5.864 2.658L16.802 8.99l-2.302 2.302-8.636-8.634z"/>
                        </svg>
                        <span class="text-left">
                            <span class="block text-xs text-slate-500 uppercase tracking-wide">Get it on</span>
                            <span class="block text-lg font-bold">Google Play</span>
                        </span>
                    </a>

                    <p class="mt-6 text-sm text-slate-400">
                        Android app — coming soon. Link is for demo only.
                    </p>
                </div>
            </div>
        </main>

        {{-- Feature cards --}}
        <section class="relative -mt-8 lg:-mt-16 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
            <div class="grid sm:grid-cols-3 gap-6 lg:gap-8">
                <div class="card-hover bg-white rounded-2xl border border-slate-200 p-8 shadow-lg">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center mb-5">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <h3 class="font-semibold text-slate-800 text-lg mb-2">Track debts</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Record who owes you and what you owe, with amounts, dates, and notes. Borrowed vs gave — always clear.</p>
                </div>
                <div class="card-hover bg-white rounded-2xl border border-slate-200 p-8 shadow-lg">
                    <div class="w-14 h-14 rounded-2xl bg-[#1A3D66]/10 text-[#1A3D66] flex items-center justify-center mb-5">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <h3 class="font-semibold text-slate-800 text-lg mb-2">Stay in sync</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Your data is backed up and synced across devices. Access your finances wherever you go.</p>
                </div>
                <div class="card-hover bg-white rounded-2xl border border-slate-200 p-8 shadow-lg">
                    <div class="w-14 h-14 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center mb-5">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <h3 class="font-semibold text-slate-800 text-lg mb-2">Simple & private</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">No clutter. Your information stays yours. We keep it simple so you stay in control.</p>
                </div>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="border-t border-slate-200 bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <span class="text-slate-500 text-sm font-medium">Debt Manager</span>
                    <a href="{{ url('/admin/login') }}" class="text-slate-500 hover:text-slate-800 text-sm font-medium transition-colors">Admin login</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
