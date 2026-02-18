<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Debt Manager — Track what you owe</title>
    <meta name="description" content="Track what you owe and who owes you. Debt Manager helps you manage debts and stay on top of your finances.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="bg-[#F8F8F8] text-[#2D3748] min-h-screen antialiased">
    <div class="relative">
        {{-- Header --}}
        <header class="bg-white border-b border-[#E2E8F0] sticky top-0 z-10">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <a href="{{ url('/') }}" class="font-semibold text-lg text-[#2D3748]">
                        Debt Manager
                    </a>
                    <nav class="flex items-center gap-6">
                        <a href="{{ url('/admin/login') }}" class="text-[#718096] hover:text-[#2D3748] text-sm font-medium transition-colors">
                            Admin
                        </a>
                    </nav>
                </div>
            </div>
        </header>

        {{-- Hero --}}
        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 lg:py-32">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-[#718096] text-sm font-medium uppercase tracking-widest mb-4">
                    Welcome to Debt Manager
                </p>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-[#2D3748] mb-4">
                    Know who owes you.<br>
                    <span class="text-[#718096]">Track what you owe.</span>
                </h1>
                <p class="text-lg sm:text-xl text-[#718096] leading-relaxed mb-10">
                    Let us set up your preferences. Simple, private, and always in sync.
                </p>

                {{-- Google Play (fake link) --}}
                <a
                    href="https://play.google.com/store/apps/details?id=com.bitbrood.debtmanagement"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-3 px-6 py-4 rounded-xl bg-[#1A3D66] hover:bg-[#153354] text-white font-semibold transition-colors border border-transparent"
                >
                    <svg class="w-10 h-10" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 01-.61-.92V2.734a1 1 0 01.609-.92zm10.89 10.893l2.302 2.302-10.937 6.333 8.635-8.635zm3.199-3.198l2.807 1.626a1 1 0 010 1.73l-2.808 1.626L15.206 12l2.492-2.491zM5.864 2.658L16.802 8.99l-2.302 2.302-8.636-8.634z"/>
                    </svg>
                    <span class="text-left">
                        <span class="block text-xs text-white/80 uppercase tracking-wide">Get it on</span>
                        <span class="block text-lg font-bold">Google Play</span>
                    </span>
                </a>

                <p class="mt-6 text-sm text-[#718096]">
                    Android app — coming soon. Link is for demo only.
                </p>
            </div>

            {{-- Feature cards --}}
            <div class="mt-24 grid sm:grid-cols-3 gap-8 text-center">
                <div class="p-6 rounded-2xl bg-white border border-[#E2E8F0] shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-[#1A3D66]/10 text-[#1A3D66] flex items-center justify-center mx-auto mb-4 font-bold text-xl">1</div>
                    <h3 class="font-semibold text-[#2D3748] mb-2">Track debts</h3>
                    <p class="text-[#718096] text-sm">Record who owes you and what you owe, with amounts and notes.</p>
                </div>
                <div class="p-6 rounded-2xl bg-white border border-[#E2E8F0] shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-[#1A3D66]/10 text-[#1A3D66] flex items-center justify-center mx-auto mb-4 font-bold text-xl">2</div>
                    <h3 class="font-semibold text-[#2D3748] mb-2">Stay in sync</h3>
                    <p class="text-[#718096] text-sm">Your data is backed up and synced across devices.</p>
                </div>
                <div class="p-6 rounded-2xl bg-white border border-[#E2E8F0] shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-[#1A3D66]/10 text-[#1A3D66] flex items-center justify-center mx-auto mb-4 font-bold text-xl">3</div>
                    <h3 class="font-semibold text-[#2D3748] mb-2">Simple & private</h3>
                    <p class="text-[#718096] text-sm">No clutter. Your information stays yours.</p>
                </div>
            </div>
        </main>

        {{-- Footer --}}
        <footer class="bg-white border-t border-[#E2E8F0] mt-24">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <span class="text-[#718096] text-sm font-medium">Debt Manager</span>
                    <a href="{{ url('/admin/login') }}" class="text-[#718096] hover:text-[#2D3748] text-sm font-medium">Admin login</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
