<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Create Account | Goods Shippers</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            'brand-blue': '#1e3a5f',
                            'brand-blue-dark': '#0f2744',
                            'brand-orange': '#f59e0b',
                            'brand-orange-hover': '#d97706',
                            'brand-green': '#22c55e',
                            'brand-navy': '#1a202c',
                        },
                        fontFamily: {
                            'sans': ['Inter', 'sans-serif'],
                        },
                    },
                },
            }
        </script>
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col md:flex-row">
            <div class="w-full md:w-1/2 flex items-center justify-center p-6 lg:p-12 bg-white">
                <div class="max-w-md w-full">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-blue to-brand-blue-dark text-white shadow-lg">
                            <span class="material-symbols-outlined text-2xl">package_2</span>
                        </div>
                        <h2 class="text-2xl font-black tracking-tight text-brand-navy">Goods Shippers</h2>
                    </div>

                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-brand-navy mb-2">Create your account</h1>
                        <p class="text-slate-500">Join thousands of shoppers. Start ordering from UK, USA & Malaysia today!</p>
                    </div>

                    <div class="rounded-3xl bg-slate-50 p-6 border border-slate-100">
                        {{ $slot }}
                    </div>

                    <div class="mt-6 text-center space-y-4">
                        <p class="text-sm text-slate-500">
                            Already have an account? <a class="text-brand-blue font-bold hover:text-brand-orange transition-colors" href="{{ route('login') }}">Sign In</a>
                        </p>
                        <a class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-brand-blue transition-colors" href="{{ route('home') }}">
                            <span class="material-symbols-outlined text-sm">arrow_back</span>
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>

            <div class="hidden md:flex md:w-1/2 relative overflow-hidden bg-gradient-to-br from-brand-blue via-brand-blue-dark to-slate-900">
                <div class="absolute top-0 right-0 w-96 h-96 bg-brand-orange/10 rounded-full blur-3xl -mr-48 -mt-48"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-brand-blue/30 rounded-full blur-2xl -ml-32 -mb-32"></div>

                <div class="relative z-10 flex flex-col justify-center px-12 xl:px-16 py-12">
                    <div class="mb-10">
                        <div class="inline-flex items-center gap-2 bg-brand-orange/20 backdrop-blur-sm rounded-full px-4 py-2 mb-6">
                            <span class="material-symbols-outlined text-brand-orange">rocket_launch</span>
                            <span class="text-white/90 text-sm font-medium">Get started in minutes</span>
                        </div>
                        <h2 class="text-4xl xl:text-5xl font-black text-white leading-tight mb-4">
                            Start Shopping<br/>
                            <span class="text-brand-orange">Globally</span>
                        </h2>
                        <p class="text-lg text-white/70 max-w-md">
                            Create your account and get your personal warehouse address. We'll handle the rest!
                        </p>
                    </div>

                    <div class="space-y-5 mb-10">
                        <div class="flex items-center gap-4 group">
                            <div class="size-14 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center text-brand-orange group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-2xl">badge</span>
                            </div>
                            <div>
                                <p class="font-semibold text-white">Personal Suite ID</p>
                                <p class="text-sm text-white/60">Your unique warehouse address</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 group">
                            <div class="size-14 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center text-brand-orange group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-2xl">public</span>
                            </div>
                            <div>
                                <p class="font-semibold text-white">Global Warehouses</p>
                                <p class="text-sm text-white/60">USA, UK & Malaysia locations</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 group">
                            <div class="size-14 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center text-brand-green group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-2xl">credit_card_off</span>
                            </div>
                            <div>
                                <p class="font-semibold text-white">No Card? No Problem!</p>
                                <p class="text-sm text-white/60">Pay with bKash, Nagad, or bank</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 group">
                            <div class="size-14 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center text-brand-green group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-2xl">support_agent</span>
                            </div>
                            <div>
                                <p class="font-semibold text-white">WhatsApp Support</p>
                                <p class="text-sm text-white/60">We help you shop & ship</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/10 mb-8">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="material-symbols-outlined text-brand-orange">info</span>
                            <span class="text-white/60 text-xs font-bold uppercase tracking-widest">Example Suite ID</span>
                        </div>
                        <h3 class="text-3xl font-mono font-bold tracking-wider text-white">BD-2045</h3>
                        <p class="text-sm mt-2 text-white/60">
                            Your packages will be identified & processed immediately at our warehouses.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-6 pt-6 border-t border-white/10">
                        <div class="flex items-center gap-2 text-white/50">
                            <span class="material-symbols-outlined text-brand-green">verified_user</span>
                            <span class="text-xs font-semibold uppercase tracking-wider">Secure</span>
                        </div>
                        <div class="flex items-center gap-2 text-white/50">
                            <span class="material-symbols-outlined text-brand-green">lock</span>
                            <span class="text-xs font-semibold uppercase tracking-wider">Protected</span>
                        </div>
                        <div class="flex items-center gap-2 text-white/50">
                            <span class="material-symbols-outlined text-brand-orange">workspace_premium</span>
                            <span class="text-xs font-semibold uppercase tracking-wider">500+ Users</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
