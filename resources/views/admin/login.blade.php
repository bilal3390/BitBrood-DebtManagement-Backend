<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style> body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; } </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 bg-[#F8F8F8] text-[#2D3748]">
    <div class="w-full max-w-md">
        <h1 class="text-2xl font-bold text-[#2D3748] text-center mb-1">Admin Login</h1>
        <p class="text-[#718096] text-center text-sm mb-6">Sign in to manage Debt Manager</p>
        <form method="POST" action="{{ route('admin.login') }}" class="bg-white rounded-2xl border border-[#E2E8F0] shadow-sm p-6 space-y-4">
            @csrf
            @if ($errors->has('email'))
                <p class="text-sm text-red-600">{{ $errors->first('email') }}</p>
            @endif
            <div>
                <label for="email" class="block text-sm font-semibold text-[#2D3748] mb-1">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email"
                    class="w-full rounded-xl border border-[#E2E8F0] bg-white px-4 py-3 text-[#2D3748] placeholder-[#718096] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:border-transparent">
            </div>
            <div>
                <label for="password" class="block text-sm font-semibold text-[#2D3748] mb-1">Password *</label>
                <input type="password" name="password" id="password" required placeholder="Enter your password"
                    class="w-full rounded-xl border border-[#E2E8F0] bg-white px-4 py-3 text-[#2D3748] placeholder-[#718096] focus:outline-none focus:ring-2 focus:ring-[#1A3D66] focus:border-transparent">
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="rounded border-[#E2E8F0] text-[#1A3D66] focus:ring-[#1A3D66]">
                <label for="remember" class="ml-2 text-sm text-[#718096]">Remember me</label>
            </div>
            <button type="submit" class="w-full rounded-xl bg-[#1A3D66] hover:bg-[#153354] text-white font-semibold py-3 px-4 flex items-center justify-center gap-2">
                Sign in
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </form>
    </div>
</body>
</html>
