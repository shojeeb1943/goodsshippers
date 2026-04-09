<x-guest-layout>
    <x-slot name="title">Login</x-slot>
    <x-slot name="heading">Welcome back!</x-slot>
    <x-slot name="subheading">Sign in to track your orders, manage shipments, and shop globally.</x-slot>

    <x-slot name="bottomLink">
        <p class="mt-8 text-center text-sm text-slate-500">
            New to Goods Shippers?
            <a class="font-bold text-brand-blue hover:text-brand-orange transition-colors" href="{{ route('register') }}">Create an Account</a>
        </p>
    </x-slot>

    <x-slot name="rightPanel">
        <div class="hidden w-1/2 lg:flex relative overflow-hidden bg-gradient-to-br from-brand-blue via-brand-blue-dark to-slate-900">
            <div class="absolute top-0 right-0 w-96 h-96 bg-brand-orange/10 rounded-full blur-3xl -mr-48 -mt-48"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-brand-blue/30 rounded-full blur-2xl -ml-32 -mb-32"></div>
            <div class="relative z-10 flex h-full w-full flex-col justify-center px-16 xl:px-20">
                <div class="mb-12">
                    <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 mb-6">
                        <span class="material-symbols-outlined text-brand-orange">verified</span>
                        <span class="text-white/90 text-sm font-medium">Trusted by 500+ happy customers</span>
                    </div>
                    <h2 class="text-4xl xl:text-5xl font-black text-white leading-tight mb-4">
                        Shop from<br/>
                        <span class="text-brand-orange">UK, USA & Malaysia</span>
                    </h2>
                    <p class="text-lg text-white/70 max-w-md">
                        We deliver to Bangladesh. No international card? No problem. We've got you covered.
                    </p>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center gap-4 bg-white/10 backdrop-blur-sm rounded-2xl p-4">
                        <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-brand-orange text-white">
                            <span class="material-symbols-outlined">local_shipping</span>
                        </div>
                        <div>
                            <p class="font-semibold text-white">Real-time Tracking</p>
                            <p class="text-sm text-white/60">Know where your package is, always</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 bg-white/10 backdrop-blur-sm rounded-2xl p-4">
                        <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-brand-green text-white">
                            <span class="material-symbols-outlined">support_agent</span>
                        </div>
                        <div>
                            <p class="font-semibold text-white">WhatsApp Support</p>
                            <p class="text-sm text-white/60">We're here to help, anytime</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 bg-white/10 backdrop-blur-sm rounded-2xl p-4">
                        <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-white/20 text-white">
                            <span class="material-symbols-outlined">credit_card_off</span>
                        </div>
                        <div>
                            <p class="font-semibold text-white">No Card Required</p>
                            <p class="text-sm text-white/60">Pay with bKash, Nagad, or bank transfer</p>
                        </div>
                    </div>
                </div>
                <div class="mt-12 flex items-center gap-6">
                    <div class="flex items-center gap-2 text-white/60 text-sm"><span class="text-2xl">🇬🇧</span> UK</div>
                    <div class="flex items-center gap-2 text-white/60 text-sm"><span class="text-2xl">🇺🇸</span> USA</div>
                    <div class="flex items-center gap-2 text-white/60 text-sm"><span class="text-2xl">🇲🇾</span> Malaysia</div>
                    <div class="flex items-center gap-2 text-white/60 text-sm">
                        <span class="material-symbols-outlined text-brand-orange">arrow_forward</span>
                    </div>
                    <div class="flex items-center gap-2 text-white text-sm font-semibold"><span class="text-2xl">🇧🇩</span> Bangladesh</div>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Field -->
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2" for="email">Email Address</label>
            <input
                class="block w-full rounded-xl border-0 bg-white px-4 py-3.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-200 placeholder:text-slate-400 focus:ring-2 focus:ring-brand-blue"
                id="email" name="email" placeholder="your@email.com" type="email"
                value="{{ old('email') }}" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password Field -->
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2" for="password">Password</label>
            <div class="relative">
                <input
                    class="block w-full rounded-xl border-0 bg-white px-4 py-3.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-200 placeholder:text-slate-400 focus:ring-2 focus:ring-brand-blue"
                    id="password" name="password" placeholder="Enter your password" type="password"
                    required autocomplete="current-password" />
                <button
                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-brand-blue transition-colors"
                    type="button" onclick="togglePassword('password', this)">
                    <span class="material-symbols-outlined">visibility</span>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember & Forgot -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input class="h-4 w-4 rounded-md border-slate-300 text-brand-orange focus:ring-brand-orange"
                    id="remember_me" name="remember" type="checkbox" />
                <label class="ml-2 block text-sm text-slate-600" for="remember_me">Remember me</label>
            </div>
            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-brand-blue hover:text-brand-orange transition-colors"
                    href="{{ route('password.request') }}">
                    Forgot Password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button
            class="flex w-full items-center justify-center rounded-xl bg-brand-orange px-4 py-4 text-sm font-bold text-white shadow-lg shadow-orange-200 transition-all hover:bg-brand-orange-hover hover:shadow-xl hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-brand-orange focus:ring-offset-2"
            type="submit">
            Sign In
        </button>
    </form>

    <script>
        function togglePassword(fieldId, btn) {
            const input = document.getElementById(fieldId);
            const icon = btn.querySelector('span');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }
    </script>
</x-guest-layout>
