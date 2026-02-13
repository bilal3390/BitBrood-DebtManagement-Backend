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
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <h1 class="text-2xl font-semibold text-center mb-6">Admin Login</h1>
        <form method="POST" action="{{ route('admin.login') }}" class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 space-y-4">
            @csrf
            @if ($errors->has('email'))
                <p class="text-sm text-red-600 dark:text-red-400">{{ $errors->first('email') }}</p>
            @endif
            <div>
                <label for="email" class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-gray-900 dark:text-gray-100">
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300">
                <label for="remember" class="ml-2 text-sm">Remember me</label>
            </div>
            <button type="submit" class="w-full rounded-lg bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-medium py-2 px-4 hover:opacity-90">
                Sign in
            </button>
        </form>
    </div>
</body>
</html>
