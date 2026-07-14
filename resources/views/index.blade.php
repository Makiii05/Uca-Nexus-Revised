<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UCA Nexus - Enrollment Management System</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-primary-900 via-primary-800 to-sidebar min-h-screen">
    <div class="min-h-screen flex flex-col items-center justify-center p-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-white tracking-tight">
                <span class="text-primary-300">UCA</span>
                <span class="text-white/90">Nexus</span>
            </h1>
            <p class="text-primary-200/60 mt-3 text-lg">Enrollment Management System</p>
            <p class="text-primary-200/40 mt-1 text-sm">Select your portal to continue</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full max-w-5xl">
            <a href="{{ route('login', 'admin') }}" class="group block bg-white/95 backdrop-blur rounded-2xl shadow-xl p-8 text-center hover:bg-white hover:shadow-2xl hover:-translate-y-1 transition-all duration-200">
                <div class="w-16 h-16 mx-auto mb-4 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center group-hover:bg-primary-600 group-hover:text-white transition-colors duration-200">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-slate-800 mb-1">Admin</h2>
                <p class="text-sm text-slate-500">System management and configuration</p>
                <span class="inline-block mt-4 text-sm font-medium text-primary-600 group-hover:text-primary-700">Enter Portal &rarr;</span>
            </a>

            <a href="{{ route('login', 'registrar') }}" class="group block bg-white/95 backdrop-blur rounded-2xl shadow-xl p-8 text-center hover:bg-white hover:shadow-2xl hover:-translate-y-1 transition-all duration-200">
                <div class="w-16 h-16 mx-auto mb-4 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center group-hover:bg-primary-600 group-hover:text-white transition-colors duration-200">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-slate-800 mb-1">Registrar</h2>
                <p class="text-sm text-slate-500">Student records and enrollment management</p>
                <span class="inline-block mt-4 text-sm font-medium text-primary-600 group-hover:text-primary-700">Enter Portal &rarr;</span>
            </a>

            <a href="{{ route('login', 'accounting') }}" class="group block bg-white/95 backdrop-blur rounded-2xl shadow-xl p-8 text-center hover:bg-white hover:shadow-2xl hover:-translate-y-1 transition-all duration-200">
                <div class="w-16 h-16 mx-auto mb-4 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center group-hover:bg-primary-600 group-hover:text-white transition-colors duration-200">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-slate-800 mb-1">Accounting</h2>
                <p class="text-sm text-slate-500">Fees, payments, and financial transactions</p>
                <span class="inline-block mt-4 text-sm font-medium text-primary-600 group-hover:text-primary-700">Enter Portal &rarr;</span>
            </a>

            <a href="{{ route('login', 'admission') }}" class="group block bg-white/95 backdrop-blur rounded-2xl shadow-xl p-8 text-center hover:bg-white hover:shadow-2xl hover:-translate-y-1 transition-all duration-200">
                <div class="w-16 h-16 mx-auto mb-4 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center group-hover:bg-primary-600 group-hover:text-white transition-colors duration-200">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-slate-800 mb-1">Admission</h2>
                <p class="text-sm text-slate-500">Applicant processing and evaluation</p>
                <span class="inline-block mt-4 text-sm font-medium text-primary-600 group-hover:text-primary-700">Enter Portal &rarr;</span>
            </a>
        </div>

        <p class="text-center text-primary-200/40 text-xs mt-12">
            &copy; {{ date('Y') }} UCA Nexus. All rights reserved.
        </p>
    </div>
</body>
</html>
