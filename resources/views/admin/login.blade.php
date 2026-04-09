<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login | Goods Shippers</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased min-h-screen" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f2744 100%);">
    <!-- Decorative blobs -->
    <div class="fixed top-0 left-0 w-80 h-80 rounded-full blur-3xl opacity-20" style="background: radial-gradient(circle, #f59e0b, transparent); transform: translate(-40%, -40%);"></div>
    <div class="fixed bottom-0 right-0 w-96 h-96 rounded-full blur-3xl opacity-15" style="background: radial-gradient(circle, #1e3a5f, transparent); transform: translate(30%, 30%);"></div>
    <div class="fixed top-1/2 left-1/2 w-64 h-64 rounded-full blur-3xl opacity-10" style="background: radial-gradient(circle, #f59e0b, transparent); transform: translate(-50%, -50%);"></div>

    <div class="min-h-screen flex">
        <!-- Left: Login Panel -->
        <div class="flex w-full flex-col justify-center px-6 py-12 lg:w-5/12 relative z-10">
            <div class="mx-auto w-full max-w-sm">
                <!-- Brand Logo -->
                <div class="flex items-center gap-3 mb-12">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl text-white shadow-xl" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                        <span class="material-symbols-outlined text-2xl">shield</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-black tracking-tight text-white">Goods Shippers</h2>
                        <p class="text-xs font-semibold tracking-widest uppercase text-amber-400/80">Admin Portal</p>
                    </div>
                </div>

                <!-- Welcome Text -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-white mb-2">Admin Login</h1>
                    <p class="text-slate-400 text-sm">Restricted access. Authorized personnel only.</p>
                </div>

                <!-- Error Messages -->
                @if (session('error'))
                    <div class="mb-4 flex items-center gap-2 rounded-xl bg-red-900/30 border border-red-500/30 px-4 py-3 text-sm text-red-400">
                        <span class="material-symbols-outlined text-base">error</span>
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Login Form -->
                <div class="rounded-2xl p-6 border" style="background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
                    <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2" for="email">Admin Email</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500">
                                    <span class="material-symbols-outlined text-lg">alternate_email</span>
                                </span>
                                <input
                                    class="block w-full rounded-xl border-0 bg-white/10 pl-11 pr-4 py-3.5 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                                    id="email" name="email" placeholder="admin@goodsshippers.com" type="email"
                                    value="{{ old('email') }}" required autofocus autocomplete="username" />
                            </div>
                            @error('email')
                                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2" for="password">Password</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-500">
                                    <span class="material-symbols-outlined text-lg">lock</span>
                                </span>
                                <input
                                    class="block w-full rounded-xl border-0 bg-white/10 pl-11 pr-12 py-3.5 text-white placeholder:text-slate-500 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                                    id="password" name="password" placeholder="Enter admin password" type="password"
                                    required autocomplete="current-password" />
                                <button type="button" onclick="toggleAdminPassword()"
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-500 hover:text-slate-300 transition-colors">
                                    <span class="material-symbols-outlined text-lg" id="toggle-icon">visibility</span>
                                </button>
                            </div>
                        </div>

                        <!-- Submit -->
                        <button type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-xl px-4 py-4 text-sm font-bold text-white shadow-lg transition-all hover:shadow-xl hover:-translate-y-0.5 focus:outline-none"
                            style="background: linear-gradient(135deg, #f59e0b, #d97706); box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);">
                            <span class="material-symbols-outlined text-lg">login</span>
                            Sign In to Admin Panel
                        </button>
                    </form>
                </div>

                <!-- Back link -->
                <p class="mt-6 text-center text-sm text-slate-500">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-1 hover:text-slate-300 transition-colors">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        Back to Website
                    </a>
                </p>
            </div>
        </div>

        <!-- Right: Visual Panel -->
        <div class="hidden lg:flex lg:w-7/12 relative overflow-hidden items-center justify-center">
            <div class="relative z-10 text-center px-12 xl:px-20">
                <!-- Main Icon -->
                <div class="flex justify-center mb-8">
                    <div class="relative">
                        <div class="w-32 h-32 rounded-3xl flex items-center justify-center shadow-2xl" style="background: linear-gradient(135deg, #f59e0b22, #f59e0b11); border: 2px solid rgba(245, 158, 11, 0.3);">
                            <span class="material-symbols-outlined text-7xl" style="color: #f59e0b;">admin_panel_settings</span>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-amber-500 flex items-center justify-center shadow-lg">
                            <span class="material-symbols-outlined text-white text-sm">shield</span>
                        </div>
                    </div>
                </div>

                <h2 class="text-4xl xl:text-5xl font-black text-white leading-tight mb-4">
                    Admin Control<br/>
                    <span style="color: #f59e0b;">Center</span>
                </h2>
                <p class="text-lg text-slate-400 max-w-md mx-auto mb-12">
                    Manage users, orders, shipments, and business operations from one powerful dashboard.
                </p>

                <!-- Feature pills -->
                <div class="flex flex-wrap justify-center gap-3">
                    @foreach (['User Management', 'Order Processing', 'Shipment Tracking', 'Invoice Control', 'Support Tickets', 'Analytics'] as $feature)
                    <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-medium text-slate-300" style="background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); backdrop-filter: blur(8px);">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                        {{ $feature }}
                    </span>
                    @endforeach
                </div>

                <!-- Security badge -->
                <div class="mt-12 inline-flex items-center gap-3 px-6 py-3 rounded-2xl" style="background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.2);">
                    <span class="material-symbols-outlined text-amber-400">verified_user</span>
                    <span class="text-sm text-slate-300 font-medium">Secured & Encrypted Admin Access</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAdminPassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggle-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>
