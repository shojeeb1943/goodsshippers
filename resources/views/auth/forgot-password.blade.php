<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Forgot Password | Goods Shippers</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased min-h-screen bg-gradient-to-br from-brand-blue via-brand-blue-dark to-slate-900">
        <div class="fixed top-0 right-0 w-96 h-96 bg-brand-orange/10 rounded-full blur-3xl -mr-48 -mt-48"></div>
        <div class="fixed bottom-0 left-0 w-64 h-64 bg-brand-blue/30 rounded-full blur-2xl -ml-32 -mb-32"></div>

        <div class="min-h-screen flex items-center justify-center p-6 relative z-10">
            <main class="w-full max-w-md">
                <!-- Logo -->
                <div class="flex items-center justify-center gap-3 mb-8">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 backdrop-blur-sm text-white shadow-lg">
                        <span class="material-symbols-outlined text-2xl">package_2</span>
                    </div>
                    <h2 class="text-2xl font-black tracking-tight text-white">Goods Shippers</h2>
                </div>

                <!-- Card -->
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                    <!-- Card Header -->
                    <header class="pt-10 px-8 pb-6 text-center">
                        <div class="mb-6 flex justify-center">
                            <div class="p-5 bg-gradient-to-br from-brand-orange/20 to-brand-orange/5 rounded-full">
                                <span class="material-symbols-outlined text-5xl text-brand-orange">lock_reset</span>
                            </div>
                        </div>
                        <h1 class="text-2xl font-bold mb-3 text-brand-navy">Forgot your password?</h1>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            No worries! Enter your email and we'll send you a link to reset it.
                        </p>
                    </header>

                    <!-- Reset Form -->
                    <section class="px-8 pb-8">
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form action="{{ route('password.email') }}" class="space-y-5" method="POST">
                            @csrf
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2" for="email">Email Address</label>
                                <input
                                    class="block w-full rounded-xl border-0 bg-slate-50 px-4 py-3.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-200 placeholder:text-slate-400 focus:ring-2 focus:ring-brand-blue"
                                    id="email" name="email" placeholder="your@email.com" value="{{ old('email') }}" required type="email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <button
                                class="flex w-full items-center justify-center rounded-xl bg-brand-orange px-4 py-4 text-sm font-bold text-white shadow-lg shadow-orange-200 transition-all hover:bg-brand-orange-hover hover:shadow-xl hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-brand-orange focus:ring-offset-2"
                                type="submit">
                                Send Reset Link
                            </button>
                            <p class="text-center text-xs text-slate-400">
                                We'll email you a secure link to reset your password.
                            </p>
                        </form>

                        <!-- Back to Login -->
                        <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                            <p class="text-sm text-slate-500">
                                Remember your password?
                                <a class="text-brand-blue font-bold hover:text-brand-orange transition-colors" href="{{ route('login') }}">Back to Login</a>
                            </p>
                        </div>
                    </section>

                    <!-- Help Section -->
                    <section class="bg-slate-50 px-8 py-6">
                        <div class="flex items-center justify-center gap-4">
                            <div class="flex items-center gap-2 text-sm text-slate-500">
                                <span class="material-symbols-outlined text-brand-green text-lg">verified_user</span>
                                <span>Secure process</span>
                            </div>
                            <div class="w-px h-4 bg-slate-200"></div>
                            <div class="flex items-center gap-2 text-sm text-slate-500">
                                <span class="material-symbols-outlined text-brand-green text-lg">chat</span>
                                <a href="#" class="hover:text-brand-green transition-colors">Need help? Chat with us</a>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Footer -->
                <p class="mt-8 text-center text-sm text-white/50">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors inline-flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        Back to Home
                    </a>
                </p>
            </main>
        </div>
    </body>
</html>
