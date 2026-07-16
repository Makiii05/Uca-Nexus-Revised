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
    @php
        $type = auth()->user()->type;
        $sidebar = match ($type) {
            'admin' => [
                ['label' => 'Dashboard',    'route' => route('dashboard'), 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
            ],
            'registrar' => [
                ['label' => 'Dashboard',    'route' => route('dashboard'), 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['label' => 'Departments',  'route' => route('registrar.departments.index'), 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                ['label' => 'Programs',     'route' => route('registrar.programs.index'), 'icon' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4'],
                ['label' => 'Levels',       'route' => route('registrar.levels.index'), 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                ['label' => 'Subjects',     'route' => route('registrar.subjects.index'), 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['label' => 'Curricula',    'route' => route('registrar.curricula.index'), 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['label' => 'School Years', 'route' => route('registrar.school-years.index'), 'icon' => 'M9 12l2 2 4-6M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                ['label' => 'Academic Terms','route' => route('registrar.academic-terms.index'), 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
            ],
            'accounting' => [
                ['label' => 'Dashboard',  'route' => route('dashboard'), 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
            ],
            'admission' => [
                ['label' => 'Dashboard',  'route' => route('dashboard'), 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
            ],
            default => [],
        };
    @endphp

    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-sidebar text-white flex flex-col shrink-0">
            <div class="p-5 border-b border-white/10">
                <h1 class="text-xl font-bold tracking-tight">
                    <span class="text-primary-400">UCA</span>
                    <span class="text-white/80">Nexus</span>
                </h1>
                <p class="text-xs text-white/50 mt-1 capitalize">{{ $type }} Portal</p>
            </div>

            <nav class="flex-1 overflow-y-auto p-3 space-y-1">
                @foreach ($sidebar as $item)
                    @php
                        $isActive = request()->url() === $item['route']
                            || (isset($item['active']) && request()->routeIs($item['active']));
                    @endphp
                    <a href="{{ $item['route'] }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150 {{ $isActive ? 'bg-sidebar-active text-white' : 'text-white/70 hover:bg-sidebar-hover hover:text-white' }}">
                        @if ($item['icon'] ?? false)
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                            </svg>
                        @endif
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            <div class="p-3 border-t border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/50 hover:bg-sidebar-hover hover:text-white transition-colors duration-150 w-full">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <p class="text-xs text-slate-400 capitalize">{{ $type }}</p>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-primary-600 text-white flex items-center justify-center text-sm font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div class="mb-4 alert alert-success shadow-sm text-sm">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="mb-4 alert alert-error shadow-sm text-sm">{{ session('error') }}</div>
                @endif

                {{ $slot }}
            </div>
        </main>
    </div>

    <script>
        document.querySelectorAll('dialog.modal').forEach(d => {
            d.addEventListener('click', function(e) {
                if (e.target === this) this.close();
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
