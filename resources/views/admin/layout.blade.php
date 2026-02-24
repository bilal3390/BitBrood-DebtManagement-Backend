<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
        /* Prevent body scroll when mobile menu is open */
        body.menu-open { overflow: hidden; }
    </style>
</head>
<body class="min-h-screen bg-[#F8F8F8] text-[#2D3748]">
    <header class="bg-white border-b border-[#E2E8F0] sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14">
                {{-- Brand (links to dashboard, no separate Dashboard link) --}}
                <a href="{{ route('admin.dashboard') }}" class="font-semibold text-[#2D3748] text-lg truncate pr-2">Debt Manager Admin</a>

                {{-- Desktop nav --}}
                <nav class="hidden md:flex items-center gap-5">
                    <a href="{{ route('admin.users.index') }}" class="text-[#718096] hover:text-[#2D3748] font-medium text-sm">Users</a>
                    <a href="{{ route('admin.customers.index') }}" class="text-[#718096] hover:text-[#2D3748] font-medium text-sm">Customers</a>
                    <a href="{{ route('admin.debts.index') }}" class="text-[#718096] hover:text-[#2D3748] font-medium text-sm">Debts</a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline ml-2">
                        @csrf
                        <button type="submit" class="text-sm text-[#718096] hover:text-[#2D3748] font-medium">Logout</button>
                    </form>
                </nav>

                {{-- Mobile: burger + logout --}}
                <div class="flex md:hidden items-center gap-2">
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-[#718096] hover:text-[#2D3748] font-medium py-2 px-3">Logout</button>
                    </form>
                    <button type="button" id="burger-btn" class="p-2 rounded-lg text-[#2D3748] hover:bg-[#F8F8F8] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:ring-offset-2" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu">
                        <svg id="burger-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg id="burger-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile menu (burger dropdown) --}}
        <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 right-0 bg-white border-b border-[#E2E8F0] shadow-lg" aria-hidden="true">
            <nav class="px-4 py-3 flex flex-col gap-0">
                <a href="{{ route('admin.users.index') }}" class="py-3 px-3 rounded-lg text-[#718096] font-medium hover:bg-[#F8F8F8] hover:text-[#2D3748]">Users</a>
                <a href="{{ route('admin.customers.index') }}" class="py-3 px-3 rounded-lg text-[#718096] font-medium hover:bg-[#F8F8F8] hover:text-[#2D3748]">Customers</a>
                <a href="{{ route('admin.debts.index') }}" class="py-3 px-3 rounded-lg text-[#718096] font-medium hover:bg-[#F8F8F8] hover:text-[#2D3748]">Debts</a>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 min-h-[calc(100vh-3.5rem)]">
        @if (session('success'))
            <div class="mb-4 rounded-xl bg-green-50 text-green-800 border border-green-200 px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 rounded-xl bg-red-50 text-red-800 border border-red-200 px-4 py-3 text-sm">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>

    <script>
        (function () {
            var btn = document.getElementById('burger-btn');
            var menu = document.getElementById('mobile-menu');
            var openIcon = document.getElementById('burger-open');
            var closeIcon = document.getElementById('burger-close');
            if (!btn || !menu) return;

            function openMenu() {
                menu.classList.remove('hidden');
                menu.setAttribute('aria-hidden', 'false');
                openIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                btn.setAttribute('aria-expanded', 'true');
                btn.setAttribute('aria-label', 'Close menu');
                document.body.classList.add('menu-open');
            }
            function closeMenu() {
                menu.classList.add('hidden');
                menu.setAttribute('aria-hidden', 'true');
                openIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
                btn.setAttribute('aria-label', 'Open menu');
                document.body.classList.remove('menu-open');
            }

            btn.addEventListener('click', function () {
                if (menu.classList.contains('hidden')) openMenu();
                else closeMenu();
            });
            menu.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', closeMenu);
            });
        })();
    </script>
</body>
</html>
