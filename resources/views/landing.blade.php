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
        <section id="features" class="relative -mt-8 lg:-mt-16 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
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
        <footer class="border-t border-slate-200 bg-slate-900 text-slate-300">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8">
                    {{-- Brand & about --}}
                    <div class="lg:col-span-4">
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 font-semibold text-lg text-white hover:text-slate-200 transition-colors mb-4">
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#1A3D66] text-white text-sm font-bold">D</span>
                            Debt Manager
                        </a>
                        <p class="text-slate-400 text-sm leading-relaxed max-w-xs">
                            Track what you owe and who owes you. Simple, private, and always in sync. Take control of your finances.
                        </p>
                        <div class="mt-6 flex items-center gap-3">
                            <a href="https://play.google.com/store/apps/details?id=com.bitbrood.debtmanagement" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-lg bg-slate-700/50 hover:bg-slate-600/50 px-3 py-2 text-sm font-medium text-white transition-colors">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 01-.61-.92V2.734a1 1 0 01.609-.92zm10.89 10.893l2.302 2.302-10.937 6.333 8.635-8.635zm3.199-3.198l2.807 1.626a1 1 0 010 1.73l-2.808 1.626L15.206 12l2.492-2.491zM5.864 2.658L16.802 8.99l-2.302 2.302-8.636-8.634z"/></svg>
                                Google Play
                            </a>
                        </div>
                    </div>
                    {{-- Quick links --}}
                    <div class="lg:col-span-2">
                        <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-4">Product</h4>
                        <ul class="space-y-2.5">
                            <li><a href="{{ url('/') }}#features" class="text-slate-400 hover:text-white text-sm transition-colors">Features</a></li>
                            <li><a href="https://play.google.com/store/apps/details?id=com.bitbrood.debtmanagement" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-white text-sm transition-colors">Download</a></li>
                            <li><a href="{{ url('/') }}#contact" class="text-slate-400 hover:text-white text-sm transition-colors">Contact</a></li>
                        </ul>
                    </div>
                    {{-- Contact form --}}
                    <div class="lg:col-span-6" id="contact">
                        <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-4">Contact us</h4>
                        @if(session('contact_sent'))
                            <div class="rounded-xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-sm px-4 py-3 mb-4">
                                Thanks! We'll get back to you soon.
                            </div>
                        @endif
                        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-3">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <input type="text" name="name" placeholder="Your name" required
                                    class="w-full rounded-lg border border-slate-600 bg-slate-800/50 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-[#1A3D66] focus:ring-1 focus:ring-[#1A3D66] outline-none transition-colors">
                                <input type="email" name="email" placeholder="Your email" required
                                    class="w-full rounded-lg border border-slate-600 bg-slate-800/50 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-[#1A3D66] focus:ring-1 focus:ring-[#1A3D66] outline-none transition-colors">
                            </div>
                            <textarea name="message" rows="3" placeholder="Your message" required
                                class="w-full rounded-lg border border-slate-600 bg-slate-800/50 px-4 py-2.5 text-sm text-white placeholder-slate-500 focus:border-[#1A3D66] focus:ring-1 focus:ring-[#1A3D66] outline-none transition-colors resize-none"></textarea>
                            <button type="submit" class="rounded-lg bg-[#1A3D66] hover:bg-[#153055] text-white font-medium text-sm px-5 py-2.5 transition-colors">
                                Send message
                            </button>
                        </form>
                    </div>
                </div>
                {{-- Social & copyright --}}
                <div class="mt-12 pt-8 border-t border-slate-700/80 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-4">
                        <a href="#" class="text-slate-500 hover:text-white transition-colors" aria-label="Twitter">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="#" class="text-slate-500 hover:text-white transition-colors" aria-label="Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="text-slate-500 hover:text-white transition-colors" aria-label="LinkedIn">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="#" class="text-slate-500 hover:text-white transition-colors" aria-label="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    </div>
                    <p class="text-slate-500 text-sm">© {{ date('Y') }} Debt Manager. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
