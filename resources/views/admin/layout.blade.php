<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|instrument-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        body { font-family: 'DM Sans', 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
        body.menu-open { overflow: hidden; }
        .sidebar-link.active { background: rgba(26, 61, 102, 0.1); color: #1A3D66; border-left-color: #1A3D66; }
        .sidebar-link:hover:not(.active) { background: rgba(26, 61, 102, 0.06); color: #1A3D66; }
        @media (min-width: 1024px) {
            .sidebar-collapsed .sidebar-nav span { display: none; }
            .sidebar-collapsed .sidebar-brand span { display: none; }
            .sidebar-collapsed { width: 4.5rem; }
            .sidebar-collapsed + .main-wrap { margin-left: 4.5rem; }
        }
    </style>
</head>
<body class="min-h-screen bg-slate-50/80 text-slate-800">
    {{-- Sidebar (desktop) --}}
    <aside id="sidebar" class="fixed left-0 top-0 z-40 h-full w-64 border-r border-slate-200/80 bg-white shadow-sm transition-[width] duration-200 ease-out lg:translate-x-0 -translate-x-full lg:block" aria-label="Admin navigation">
        <div class="flex h-full flex-col">
            <div class="flex h-14 shrink-0 items-center gap-2 border-b border-slate-200/80 px-4">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-brand flex items-center gap-3 overflow-hidden">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#1A3D66] text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="truncate font-semibold text-slate-800">Kredly</span>
                </a>
            </div>
            <nav class="sidebar-nav flex-1 overflow-y-auto px-3 py-4 space-y-0.5">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 rounded-lg border-l-2 border-transparent px-3 py-2.5 text-sm font-medium text-slate-600 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="h-5 w-5 shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="sidebar-link flex items-center gap-3 rounded-lg border-l-2 border-transparent px-3 py-2.5 text-sm font-medium text-slate-600 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <svg class="h-5 w-5 shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span>Users</span>
                </a>
                <a href="{{ route('admin.customers.index') }}" class="sidebar-link flex items-center gap-3 rounded-lg border-l-2 border-transparent px-3 py-2.5 text-sm font-medium text-slate-600 {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                    <svg class="h-5 w-5 shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span>Customers</span>
                </a>
                <a href="{{ route('admin.debts.index') }}" class="sidebar-link flex items-center gap-3 rounded-lg border-l-2 border-transparent px-3 py-2.5 text-sm font-medium text-slate-600 {{ request()->routeIs('admin.debts.*') ? 'active' : '' }}">
                    <svg class="h-5 w-5 shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Debts & Credits</span>
                </a>
                <a href="{{ route('admin.notifications.index') }}" class="sidebar-link flex items-center gap-3 rounded-lg border-l-2 border-transparent px-3 py-2.5 text-sm font-medium text-slate-600 {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}">
                    <svg class="h-5 w-5 shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    <span>Send notifications</span>
                </a>
                <a href="{{ route('admin.profile.show') }}" class="sidebar-link flex items-center gap-3 rounded-lg border-l-2 border-transparent px-3 py-2.5 text-sm font-medium text-slate-600 {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                    <svg class="h-5 w-5 shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>Profile</span>
                </a>
                @if(auth()->guard('admin')->user()?->isSuperAdmin())
                <a href="{{ route('admin.admins.index') }}" class="sidebar-link flex items-center gap-3 rounded-lg border-l-2 border-transparent px-3 py-2.5 text-sm font-medium text-slate-600 {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                    <svg class="h-5 w-5 shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span>Sub-admins</span>
                </a>
                @endif
                <a href="{{ route('admin.settings.edit') }}" class="sidebar-link flex items-center gap-3 rounded-lg border-l-2 border-transparent px-3 py-2.5 text-sm font-medium text-slate-600 {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <svg class="h-5 w-5 shrink-0 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.89 3.31.876 2.42 2.42a1.724 1.724 0 001.065 2.572c1.757.426 1.757 2.924 0 3.35a1.724 1.724 0 00-1.065 2.572c.89 1.543-.877 3.31-2.42 2.42a1.724 1.724 0 00-2.573 1.065c-.426 1.757-2.924 1.757-3.35 0a1.724 1.724 0 00-2.572-1.065c-1.544.89-3.31-.877-2.42-2.42a1.724 1.724 0 00-1.066-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.572c-.89-1.544.876-3.31 2.42-2.42.996.575 2.255.25 2.572-1.066z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Settings</span>
                </a>
            </nav>
            <div class="border-t border-slate-200/80 p-3">
                <form method="POST" action="{{ route('admin.logout') }}" id="admin-logout-form" class="block">
                    @csrf
                    <button type="submit" class="sidebar-link flex w-full items-center gap-3 rounded-lg border-l-2 border-transparent px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-red-50 hover:text-red-700">
                        <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Mobile sidebar overlay --}}
    <div id="sidebar-overlay" class="fixed inset-0 z-30 bg-slate-900/20 backdrop-blur-sm lg:hidden hidden" aria-hidden="true"></div>

    <div class="main-wrap lg:ml-64 min-h-screen flex flex-col">
        {{-- Top navbar --}}
        <header class="sticky top-0 z-20 flex h-14 shrink-0 items-center gap-4 border-b border-slate-200/80 bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/80 px-4 sm:px-6">
            <button type="button" id="sidebar-toggle" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-[#1A3D66]/30" aria-label="Toggle menu">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div class="flex-1 min-w-0">
                <h1 class="text-sm font-semibold text-slate-800 truncate lg:text-base">@yield('breadcrumb', 'Admin')</h1>
            </div>
            <div class="hidden md:flex items-center gap-2 text-sm text-slate-500">
                @if(auth()->guard('admin')->user()?->isSuperAdmin())
                    <span class="rounded-full bg-[#1A3D66]/10 px-2.5 py-0.5 text-xs font-medium text-[#1A3D66]">Super admin</span>
                @else
                    <span class="rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-medium text-slate-600">Sub-admin</span>
                @endif
            </div>
        </header>

        {{-- Main content --}}
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            @if (session('success'))
                <div class="mb-4 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-200 px-4 py-3 text-sm flex items-center gap-2">
                    <svg class="h-5 w-5 shrink-0 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 rounded-xl bg-red-50 text-red-800 border border-red-200 px-4 py-3 text-sm flex items-center gap-2">
                    <svg class="h-5 w-5 shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    <script>
        (function () {
            var sidebar = document.getElementById('sidebar');
            var overlay = document.getElementById('sidebar-overlay');
            var toggle = document.getElementById('sidebar-toggle');
            if (!sidebar || !overlay) return;

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('menu-open');
            }
            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('menu-open');
            }

            if (toggle) {
                toggle.addEventListener('click', function () {
                    if (sidebar.classList.contains('-translate-x-full')) openSidebar();
                    else closeSidebar();
                });
            }
            overlay.addEventListener('click', closeSidebar);
            sidebar.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () { if (window.innerWidth < 1024) closeSidebar(); });
            });

            // Logout: POST then replace history so back button cannot return to admin
            var logoutForm = document.getElementById('admin-logout-form');
            if (logoutForm) {
                logoutForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    var form = this;
                    var action = form.getAttribute('action');
                    var token = form.querySelector('input[name="_token"]');
                    var body = new FormData(form);
                    fetch(action, { method: 'POST', body: body, headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                        .then(function () { window.location.replace('/'); })
                        .catch(function () { window.location.replace('/'); });
                });
            }
        })();
    </script>
</body>
</html>
