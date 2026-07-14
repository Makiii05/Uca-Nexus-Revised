<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - UCA Nexus</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-primary-900 via-primary-800 to-sidebar min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <a href="{{ route('index') }}" class="inline-flex items-center text-primary-300/70 hover:text-primary-200 text-sm mb-6 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to portals
        </a>

        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-white/10 flex items-center justify-center">
                <svg class="w-8 h-8 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Admin Portal</h1>
            <p class="text-primary-200/60 mt-1 text-sm">System management and configuration</p>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-xl font-semibold text-slate-800 mb-1">Welcome back</h2>
            <p class="text-sm text-slate-500 mb-6">Sign in with your admin credentials.</p>

            <form method="POST" action="{{ route('login', 'admin') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="input input-bordered w-full @error('email') input-error @enderror"
                           placeholder="admin@example.com" required autofocus>
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" id="password"
                           class="input input-bordered w-full @error('password') input-error @enderror"
                           placeholder="Enter your password" required>
                    @error('password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @error('type')
                    <p class="text-xs text-red-500 mb-4">{{ $message }}</p>
                @enderror

                <button type="submit" class="btn bg-primary-600 hover:bg-primary-700 text-white w-full border-none">
                    Sign In
                </button>
            </form>

            <p class="text-center text-slate-400 text-xs mt-6">
                <a href="{{ route('index') }}" class="hover:text-primary-600 transition-colors">Select a different portal</a>
            </p>
        </div>

        <p class="text-center text-primary-200/30 text-xs mt-6">
            &copy; {{ date('Y') }} UCA Nexus. All rights reserved.
        </p>
    </div>
</body>
</html>
