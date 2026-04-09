<x-guest-layout>
    <x-slot name="title">Create Account</x-slot>
    <x-slot name="heading">Create your account</x-slot>
    <x-slot name="subheading">Join thousands of shoppers. Start ordering from UK, USA & Malaysia today!</x-slot>

    <x-slot name="bottomLink">
        <div class="mt-6 text-center">
            <p class="text-sm text-slate-500">
                Already have an account?
                <a class="font-semibold text-[#1e3a5f] hover:text-[#f97316] transition-colors" href="{{ route('login') }}">Sign In</a>
            </p>
        </div>
    </x-slot>

    <x-slot name="rightPanel">
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-[#1e3a5f] via-[#0f2744] to-[#0a192f]">
            <div class="absolute top-0 right-0 w-96 h-96 bg-[#f97316]/10 rounded-full blur-3xl -mr-48 -mt-48"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-[#1e3a5f]/30 rounded-full blur-2xl -ml-32 -mb-32"></div>
            
            <div class="relative z-10 flex flex-col justify-center px-12 py-12">
                <div class="mb-8">
                    <div class="inline-flex items-center gap-2 bg-[#f97316]/20 backdrop-blur-sm rounded-full px-4 py-2 mb-4">
                        <span class="material-symbols-outlined text-[#f97316]">rocket_launch</span>
                        <span class="text-white/90 text-sm font-medium">Get started in minutes</span>
                    </div>
                    <h2 class="text-4xl font-black text-white leading-tight mb-4">
                        Start Shopping<br/>
                        <span class="text-[#f97316]">Globally</span>
                    </h2>
                    <p class="text-white/70 max-w-md">
                        Create your account and get your personal warehouse address. We'll handle the rest!
                    </p>
                </div>

                <div class="space-y-4 mb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-[#f97316]">
                            <span class="material-symbols-outlined">badge</span>
                        </div>
                        <div>
                            <p class="font-semibold text-white text-sm">Personal Suite ID</p>
                            <p class="text-xs text-white/60">Your unique warehouse address</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-[#f97316]">
                            <span class="material-symbols-outlined">public</span>
                        </div>
                        <div>
                            <p class="font-semibold text-white text-sm">Global Warehouses</p>
                            <p class="text-xs text-white/60">USA, UK & Malaysia</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-[#22c55e]">
                            <span class="material-symbols-outlined">support_agent</span>
                        </div>
                        <div>
                            <p class="font-semibold text-white text-sm">WhatsApp Support</p>
                            <p class="text-xs text-white/60">We help you shop & ship</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-md p-5 rounded-2xl border border-white/10">
                    <p class="text-white/60 text-xs uppercase tracking-wider mb-2">Example Suite ID</p>
                    <p class="text-2xl font-mono font-bold text-white">BD-2045</p>
                </div>
            </div>
        </div>
    </x-slot>

    <form class="space-y-4" action="{{ route('register') }}" method="POST">
        @csrf

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5" for="name">Full Name</label>
            <input class="w-full px-4 py-2.5 rounded-lg border border-slate-300 bg-white text-slate-900 text-sm focus:border-[#1e3a5f] focus:ring-1 focus:ring-[#1e3a5f] focus:outline-none transition-colors"
                id="name" name="name" placeholder="Your full name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5" for="email">Email Address</label>
                <input class="w-full px-4 py-2.5 rounded-lg border border-slate-300 bg-white text-slate-900 text-sm focus:border-[#1e3a5f] focus:ring-1 focus:ring-[#1e3a5f] focus:outline-none transition-colors"
                    id="email" name="email" placeholder="your@email.com" type="email" value="{{ old('email') }}" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5" for="phone">Phone (WhatsApp)</label>
                <input class="w-full px-4 py-2.5 rounded-lg border border-slate-300 bg-white text-slate-900 text-sm focus:border-[#1e3a5f] focus:ring-1 focus:ring-[#1e3a5f] focus:outline-none transition-colors"
                    id="phone" name="phone" placeholder="+880 1XXX-XXXXXX" type="tel" value="{{ old('phone') }}" autocomplete="tel" />
                <x-input-error :messages="$errors->get('phone')" class="mt-1" />
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5" for="password">Password</label>
            <input class="w-full px-4 py-2.5 rounded-lg border border-slate-300 bg-white text-slate-900 text-sm focus:border-[#1e3a5f] focus:ring-1 focus:ring-[#1e3a5f] focus:outline-none transition-colors"
                id="password" name="password" placeholder="Create a password" type="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1.5" for="password_confirmation">Confirm Password</label>
            <input class="w-full px-4 py-2.5 rounded-lg border border-slate-300 bg-white text-slate-900 text-sm focus:border-[#1e3a5f] focus:ring-1 focus:ring-[#1e3a5f] focus:outline-none transition-colors"
                id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" type="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="flex items-center gap-2">
            <input class="rounded border-slate-300 text-[#f97316] focus:ring-[#f97316]" id="terms" name="terms" type="checkbox" required />
            <label class="text-sm text-slate-600" for="terms">
                I agree to the <a class="text-[#1e3a5f] hover:underline" href="#">Terms</a> and <a class="text-[#1e3a5f] hover:underline" href="#">Privacy Policy</a>
            </label>
        </div>

        <button class="w-full bg-[#f97316] hover:bg-[#ea580c] text-white font-semibold py-2.5 rounded-lg transition-colors"
            type="submit">
            Create Account
        </button>

        <div class="flex items-center gap-2">
            <div class="flex-1 h-px bg-slate-200"></div>
            <span class="text-xs text-slate-400">or</span>
            <div class="flex-1 h-px bg-slate-200"></div>
        </div>

        <button type="button" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg border border-slate-300 bg-white hover:bg-slate-50 transition-colors">
            <svg class="w-4 h-4" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            <span class="text-sm text-slate-700">Continue with Google</span>
        </button>
    </form>
</x-guest-layout>
