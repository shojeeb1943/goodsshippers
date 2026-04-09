<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'GoodsShippers') - GoodsShippers</title>
    <meta name="description" content="@yield('meta_description', 'GoodsShippers - Your trusted partner for global logistics, providing seamless shipping solutions from USA, UK, and Malaysia to Bangladesh.')">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1a355b",
                        "accent": "#f97316",
                        "background-light": "#f8fafc",
                        "background-dark": "#13181f",
                        "navy-dark": "#11223a",
                        "navy-light": "#234575",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "3xl": "1.5rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-size: 24px; vertical-align: middle; }

        /* Navigation */
        .nav-link {
            @apply text-[15px] font-semibold text-primary hover:text-accent transition-colors duration-200 flex items-center gap-1 focus:outline-none focus:text-accent rounded;
        }
        .dropdown-item:hover .item-title { @apply text-accent; }

        /* Shared Buttons */
        .btn-primary {
            @apply inline-flex items-center justify-center gap-2 px-6 py-3 bg-accent text-white font-bold rounded-lg shadow-lg shadow-accent/20 hover:bg-accent/90 hover:-translate-y-0.5 transition-all focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2;
        }
        .btn-outline {
            @apply inline-flex items-center justify-center gap-2 px-6 py-3 border-2 border-primary text-primary font-bold rounded-lg hover:bg-primary hover:text-white transition-all focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2;
        }
        .btn-sm { @apply px-4 py-2 text-sm; }

        /* Shared Cards */
        .card {
            @apply bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm;
        }
        .card-hover { @apply hover:shadow-xl transition-shadow; }

        /* Shared Form Inputs */
        .form-input {
            @apply w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg px-4 py-3 text-sm text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors;
        }
        .form-label {
            @apply block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1.5;
        }

        /* Layout helpers */
        .section-gap   { @apply py-14 md:py-20 lg:py-24; }
        .container-lg  { @apply max-w-7xl mx-auto px-4 sm:px-6 lg:px-8; }
    </style>
    @yield('head')
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100">
    {{-- Top Announcement Bar --}}
    <div class="bg-[#11223a] text-white py-2 text-center text-sm font-medium px-4">
        🚚 Weekly shipments from USA, UK, and Malaysia available.
        <a class="underline ml-2 hover:text-accent transition-colors" href="{{ route('how-it-works') }}">Learn More</a>
    </div>

    {{-- Sticky Header --}}
    <header x-data="{ mobileOpen: false }" class="sticky top-0 z-50 w-full border-b border-slate-200 dark:border-slate-800 bg-white/95 dark:bg-background-dark/95 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                <span class="material-symbols-outlined text-primary dark:text-accent text-3xl">local_shipping</span>
                <span class="text-xl font-extrabold tracking-tight text-primary dark:text-white uppercase">GoodsShippers</span>
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden lg:flex items-center gap-8">
                <a class="nav-link {{ request()->routeIs('home') ? 'text-accent' : '' }}" href="{{ route('home') }}">Home</a>
                
                <a class="nav-link {{ request()->routeIs('shop') ? 'text-accent' : '' }}" href="{{ route('shop') }}">Shop</a>

                {{-- Shipping Dropdown --}}
                <div class="relative group h-20 flex items-center">
                    <button class="nav-link group-hover:text-accent">
                        Shipping
                        <span class="material-symbols-outlined text-lg">expand_more</span>
                    </button>
                    <div class="absolute top-[80px] left-1/2 -translate-x-1/2 w-[280px] bg-white dark:bg-slate-900 rounded-xl shadow-2xl border border-slate-100 dark:border-slate-800 p-2 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition-all duration-200 transform translate-y-2 group-hover:translate-y-0">
                        <a class="dropdown-item flex items-start gap-4 p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" href="{{ route('warehouses.usa') }}">
                            <span class="material-symbols-outlined text-primary">flag</span>
                            <div>
                                <p class="item-title text-sm font-bold text-primary dark:text-white">USA Shipping</p>
                                <p class="text-xs text-slate-500 mt-0.5">Fast air & sea freight from our NJ warehouse.</p>
                            </div>
                        </a>
                        <a class="dropdown-item flex items-start gap-4 p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" href="{{ route('warehouses.malaysia') }}">
                            <span class="material-symbols-outlined text-primary">flag_circle</span>
                            <div>
                                <p class="item-title text-sm font-bold text-primary dark:text-white">Malaysia Shipping</p>
                                <p class="text-xs text-slate-500 mt-0.5">Reliable logistics from Kuala Lumpur hub.</p>
                            </div>
                        </a>
                        <a class="dropdown-item flex items-start gap-4 p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" href="{{ route('warehouses.uk') }}">
                            <span class="material-symbols-outlined text-primary">flag</span>
                            <div>
                                <p class="item-title text-sm font-bold text-primary dark:text-white">UK Shipping</p>
                                <p class="text-xs text-slate-500 mt-0.5">Weekly consolidations from London depot.</p>
                            </div>
                        </a>
                    </div>
                </div>


                <a class="nav-link {{ request()->routeIs('warehouses.*') ? 'text-accent' : '' }}" href="{{ route('warehouses.index') }}">Warehouse</a>
                <a class="nav-link {{ request()->routeIs('about') ? 'text-accent' : '' }}" href="{{ route('about') }}">About Us</a>
                <a class="nav-link {{ request()->routeIs('contact') ? 'text-accent' : '' }}" href="{{ route('contact') }}">Contact Us</a>
            </nav>

            {{-- Auth Buttons + Mobile Toggle --}}
            <div class="flex items-center gap-1 sm:gap-2">
                {{-- Login: visible sm+ in header; always in mobile menu --}}
                <a class="hidden sm:inline-flex items-center text-sm font-bold text-primary dark:text-white hover:text-accent transition-colors px-3 py-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-primary/30" href="{{ route('login') }}">Login</a>
                {{-- Register: icon-only on mobile, icon+text on sm+ --}}
                <a href="{{ route('register') }}" class="flex items-center gap-1.5 px-3 sm:px-5 py-2.5 bg-accent text-white font-bold rounded-lg hover:bg-accent/90 transition-all shadow-lg shadow-accent/20 focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2">
                    <span class="material-symbols-outlined text-[18px]">person_add</span>
                    <span class="hidden sm:inline">Register</span>
                </a>
                {{-- Hamburger: icon swaps menu ↔ close via Alpine --}}
                <button @click="mobileOpen = !mobileOpen" :aria-expanded="mobileOpen.toString()" aria-label="Toggle navigation" class="lg:hidden p-2 ml-0.5 text-primary dark:text-white rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors focus:outline-none focus:ring-2 focus:ring-primary/30">
                    <span x-show="!mobileOpen" class="material-symbols-outlined text-[26px]">menu</span>
                    <span x-show="mobileOpen" x-cloak class="material-symbols-outlined text-[26px]">close</span>
                </button>
            </div>
        </div>

        {{-- Mobile Menu — Alpine-driven with smooth transition --}}
        <div id="mobile-menu"
             x-show="mobileOpen"
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1"
             class="lg:hidden bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 shadow-lg">
            <nav class="px-3 py-2 space-y-0.5">
                <a @click="mobileOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-primary dark:text-white hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-accent rounded-lg transition-colors" href="{{ route('home') }}">
                    <span class="material-symbols-outlined text-[18px] shrink-0">home</span> Home
                </a>
                <a @click="mobileOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-primary dark:text-white hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-accent rounded-lg transition-colors" href="{{ route('services') }}">
                    <span class="material-symbols-outlined text-[18px] shrink-0">inventory_2</span> Services
                </a>
                <div class="px-3 pt-3 pb-1">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Warehouses</p>
                </div>
                <a @click="mobileOpen = false" class="flex items-center gap-3 pl-6 pr-3 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-accent rounded-lg transition-colors" href="{{ route('warehouses.usa') }}">🇺🇸 USA Warehouse</a>
                <a @click="mobileOpen = false" class="flex items-center gap-3 pl-6 pr-3 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-accent rounded-lg transition-colors" href="{{ route('warehouses.uk') }}">🇬🇧 UK Warehouse</a>
                <a @click="mobileOpen = false" class="flex items-center gap-3 pl-6 pr-3 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-accent rounded-lg transition-colors" href="{{ route('warehouses.malaysia') }}">🇲🇾 Malaysia Warehouse</a>
                <a @click="mobileOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-primary dark:text-white hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-accent rounded-lg transition-colors" href="{{ route('shop') }}">
                    <span class="material-symbols-outlined text-[18px] shrink-0">storefront</span> Products
                </a>
                <a @click="mobileOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-primary dark:text-white hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-accent rounded-lg transition-colors" href="{{ route('about') }}">
                    <span class="material-symbols-outlined text-[18px] shrink-0">info</span> About Us
                </a>
                <a @click="mobileOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-primary dark:text-white hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-accent rounded-lg transition-colors" href="{{ route('contact') }}">
                    <span class="material-symbols-outlined text-[18px] shrink-0">mail</span> Contact Us
                </a>
                <a @click="mobileOpen = false" class="flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-primary dark:text-white hover:bg-slate-50 dark:hover:bg-slate-800 hover:text-accent rounded-lg transition-colors" href="{{ route('faq') }}">
                    <span class="material-symbols-outlined text-[18px] shrink-0">help_outline</span> FAQ
                </a>
            </nav>
            <div class="flex gap-3 px-4 py-3 border-t border-slate-100 dark:border-slate-800">
                <a href="{{ route('login') }}" class="flex-1 text-center py-2.5 border-2 border-primary text-primary font-bold rounded-lg text-sm hover:bg-primary hover:text-white transition-colors">Login</a>
                <a href="{{ route('register') }}" class="flex-1 text-center py-2.5 bg-accent text-white font-bold rounded-lg text-sm hover:bg-accent/90 transition-colors">Register</a>
            </div>
        </div>
    </header>

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-[#11223a] text-white">
        <div class="max-w-7xl mx-auto px-4 pt-16 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 mb-12">
                {{-- Brand --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-accent text-3xl">local_shipping</span>
                        <span class="text-xl font-extrabold tracking-tight uppercase">GoodsShippers</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Your trusted partner for global logistics, providing seamless shipping solutions from USA, UK, and Malaysia to Bangladesh.
                    </p>
                    <div class="flex gap-4">
                        <a class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent transition-colors" href="#">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path></svg>
                        </a>
                        <a class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent transition-colors" href="#">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44c-.795 0-1.439-.645-1.439-1.44s.644-1.44 1.439-1.44z"></path></svg>
                        </a>
                    </div>
                </div>
                {{-- Services --}}
                <div class="space-y-6">
                    <h4 class="font-bold text-lg">Services</h4>
                    <ul class="space-y-4 text-slate-400 text-sm">
                        <li><a class="hover:text-accent transition-colors" href="{{ route('shop') }}">Shop</a></li>
                        <li><a class="hover:text-accent transition-colors" href="{{ route('calculator') }}">Shipping Calculator</a></li>
                        <li><a class="hover:text-accent transition-colors" href="{{ route('services') }}">Pricing</a></li>
                    </ul>
                </div>
                {{-- Warehouses --}}
                <div class="space-y-6">
                    <h4 class="font-bold text-lg">Warehouses</h4>
                    <ul class="space-y-4 text-slate-400 text-sm">
                        <li><a class="hover:text-accent transition-colors" href="{{ route('warehouses.usa') }}">USA Warehouse</a></li>
                        <li><a class="hover:text-accent transition-colors" href="{{ route('warehouses.uk') }}">UK Warehouse</a></li>
                        <li><a class="hover:text-accent transition-colors" href="{{ route('warehouses.malaysia') }}">Malaysia Warehouse</a></li>
                    </ul>
                </div>
                {{-- Support --}}
                <div class="space-y-6">
                    <h4 class="font-bold text-lg">Support</h4>
                    <ul class="space-y-4 text-slate-400 text-sm">
                        <li><a class="hover:text-accent transition-colors" href="{{ route('track-shipment') }}">Track Shipment</a></li>
                        <li><a class="hover:text-accent transition-colors" href="{{ route('faq') }}">FAQ</a></li>
                        <li><a class="hover:text-accent transition-colors" href="{{ route('contact') }}">Contact Us</a></li>
                        <li><a class="hover:text-accent transition-colors" href="{{ route('how-it-works') }}">Shipping Guide</a></li>
                    </ul>
                </div>
                {{-- Account --}}
                <div class="space-y-6">
                    <h4 class="font-bold text-lg">Account</h4>
                    <ul class="space-y-4 text-slate-400 text-sm">
                        <li><a class="hover:text-accent transition-colors" href="{{ route('login') }}">Login</a></li>
                        <li><a class="hover:text-accent transition-colors" href="{{ route('register') }}">Register</a></li>
                        @auth
                        <li><a class="hover:text-accent transition-colors" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a class="hover:text-accent transition-colors" href="{{ route('tracking.index') }}">Track Order</a></li>
                        @endauth
                    </ul>
                </div>
            </div>

            {{-- Contact Info Bar --}}
            <div class="flex flex-wrap justify-center lg:justify-start gap-8 py-8 border-y border-white/10 mb-8 text-sm text-slate-300">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-accent text-lg">mail</span>
                    support@goodsshippers.com
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-accent text-lg">call</span>
                    +880 1234 567890
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-accent text-lg">location_on</span>
                    Banani, Dhaka, Bangladesh
                </div>
            </div>

            {{-- Newsletter --}}
            <div class="mb-12">
                <div class="flex flex-col lg:flex-row justify-between items-center gap-6">
                    <div class="text-center lg:text-left">
                        <h4 class="font-bold text-xl mb-2">Stay Updated</h4>
                        <p class="text-slate-400 text-sm">Subscribe to get the latest shipping rates and offers.</p>
                    </div>
                    <div class="w-full lg:w-auto flex flex-col sm:flex-row gap-2">
                        <input class="w-full sm:w-80 bg-white/5 border border-white/10 rounded-lg px-4 py-3 focus:ring-accent focus:border-accent text-white placeholder-slate-500" placeholder="Enter your email" type="email" />
                        <button class="bg-accent hover:bg-accent/90 text-white font-bold px-8 py-3 rounded-lg transition-all">Subscribe</button>
                    </div>
                </div>
            </div>

            {{-- Trust Badges --}}
            <div class="flex flex-wrap justify-center gap-12 mb-12 py-4 grayscale opacity-60">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined">verified_user</span>
                    <span class="text-xs font-bold uppercase tracking-widest">Secure Payments</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined">local_shipping</span>
                    <span class="text-xs font-bold uppercase tracking-widest">Trusted Shipping</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined">public</span>
                    <span class="text-xs font-bold uppercase tracking-widest">Global Warehouses</span>
                </div>
            </div>

            {{-- Copyright --}}
            <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-slate-500 text-xs">
                <p>© 2025 GoodsShippers. All rights reserved.</p>
                <div class="flex gap-6">
                    <a class="hover:text-white transition-colors" href="#">Privacy Policy</a>
                    <a class="hover:text-white transition-colors" href="#">Terms of Service</a>
                    <a class="hover:text-white transition-colors" href="#">Refund Policy</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- Mobile menu is now handled by Alpine.js x-data on <header> --}}

    @yield('scripts')
</body>
</html>
