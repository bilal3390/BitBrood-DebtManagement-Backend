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
    </style>
</head>
<body class="min-h-screen bg-[#F8F8F8] text-[#2D3748]">
    <header class="bg-white border-b border-[#E2E8F0]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-14 items-center">
                <div class="flex gap-6">
                    <a href="{{ route('admin.dashboard') }}" class="font-semibold text-[#2D3748]">Debt Manager Admin</a>
                    <nav class="flex gap-4">
                        <a href="{{ route('admin.dashboard') }}" class="text-[#718096] hover:text-[#2D3748] font-medium">Dashboard</a>
                        <a href="{{ route('admin.users.index') }}" class="text-[#718096] hover:text-[#2D3748] font-medium">Users</a>
                        <a href="{{ route('admin.customers.index') }}" class="text-[#718096] hover:text-[#2D3748] font-medium">Customers</a>
                        <a href="{{ route('admin.debts.index') }}" class="text-[#718096] hover:text-[#2D3748] font-medium">Debts</a>
                    </nav>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-[#718096] hover:text-[#2D3748] font-medium">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
</body>
</html>
