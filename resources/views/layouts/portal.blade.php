<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard' }} - UCA Nexus</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100">
    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-sidebar text-white flex flex-col shrink-0">
            <div class="p-5 border-b border-white/10">
                <h1 class="text-xl font-bold tracking-tight">
                    <span class="text-primary-400">UCA</span>
                    <span class="text-white/80">Nexus</span>
                </h1>
                <p class="text-xs text-white/50 mt-1 capitalize">{{ auth()->user()->type }} Portal</p>
            </div>

            <nav class="flex-1 overflow-y-auto p-3 space-y-1">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150 {{ request()->routeIs('dashboard') ? 'bg-sidebar-active text-white' : 'text-white/70 hover:bg-sidebar-hover hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-3 text-xs font-semibold text-white/30 uppercase tracking-wider">Navigation</p>
                </div>

                @foreach($menuItems ?? [] as $item)
                    <a href="{{ $item['route'] }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150 text-white/50 hover:bg-sidebar-hover hover:text-white/80 cursor-not-allowed">
                        @if($item['icon'] ?? false)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                            </svg>
                        @endif
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="p-3 border-t border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/50 hover:bg-sidebar-hover hover:text-white transition-colors duration-150 w-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white border-b border-slate-200 px-6 py-3 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-800">{{ $header ?? 'Dashboard' }}</h2>
                    @if($subheader ?? false)
                        <p class="text-sm text-slate-500">{{ $subheader }}</p>
                    @endif
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <p class="text-sm font-medium text-slate-700 capitalize">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-400 capitalize">{{ auth()->user()->type }}</p>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-primary-600 text-white flex items-center justify-center text-sm font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div class="mb-4 alert alert-success shadow-sm">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 alert alert-error shadow-sm">
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
