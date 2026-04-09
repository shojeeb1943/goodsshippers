<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background: #f1f5f9; }
        .sidebar { width: 260px; min-height: 100vh; background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%); }
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 10px 16px; border-radius: 10px; color: rgba(255,255,255,0.6); font-size: 0.875rem; font-weight: 500; transition: all 0.2s; text-decoration: none; margin-bottom: 2px; }
        .nav-link:hover, .nav-link.active { background: rgba(245,158,11,0.15); color: #f59e0b; }
        .nav-link .material-symbols-outlined { font-size: 20px; }
        .stat-card { background: white; border-radius: 16px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="sidebar flex-shrink-0 flex flex-col py-6 px-4">
            <!-- Logo -->
            <div class="flex items-center gap-3 px-2 mb-8">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <span class="material-symbols-outlined text-white text-lg">shield</span>
                </div>
                <div>
                    <p class="text-white font-bold text-sm leading-tight">Goods Shippers</p>
                    <p class="text-amber-400/70 text-xs font-semibold tracking-wider uppercase">Admin</p>
                </div>
            </div>

            <!-- Nav -->
            <nav class="flex-1 space-y-0.5">
                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest px-2 mb-3">Main</p>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">dashboard</span> Dashboard
                </a>
                <a href="#" class="nav-link">
                    <span class="material-symbols-outlined">group</span> Users
                </a>
                <a href="#" class="nav-link">
                    <span class="material-symbols-outlined">shopping_bag</span> Orders
                </a>
                <a href="#" class="nav-link">
                    <span class="material-symbols-outlined">inventory_2</span> Parcels
                </a>
                <a href="#" class="nav-link">
                    <span class="material-symbols-outlined">local_shipping</span> Shipments
                </a>
                <a href="#" class="nav-link">
                    <span class="material-symbols-outlined">receipt_long</span> Invoices
                </a>

                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest px-2 mt-6 mb-3">Support</p>
                <a href="#" class="nav-link">
                    <span class="material-symbols-outlined">support_agent</span> Tickets
                </a>
                <a href="#" class="nav-link">
                    <span class="material-symbols-outlined">bar_chart</span> Reports
                </a>

                <p class="text-slate-500 text-xs font-bold uppercase tracking-widest px-2 mt-6 mb-3">System</p>
                <a href="#" class="nav-link">
                    <span class="material-symbols-outlined">settings</span> Settings
                </a>
                <a href="{{ route('home') }}" class="nav-link" target="_blank">
                    <span class="material-symbols-outlined">open_in_new</span> View Website
                </a>
            </nav>

            <!-- Admin profile at bottom -->
            <div class="px-2 mt-6 pt-6 border-t border-white/10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-xl bg-amber-500/20 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-amber-400 text-lg">person</span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-white text-sm font-semibold truncate">{{ session('admin_name', 'Admin') }}</p>
                        <p class="text-slate-500 text-xs truncate">{{ session('admin_email') }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="nav-link w-full text-red-400 hover:bg-red-500/10 hover:text-red-400">
                        <span class="material-symbols-outlined">logout</span> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top bar -->
            <header class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-lg font-bold text-slate-800">@yield('page-title', 'Dashboard')</h1>
                    <p class="text-xs text-slate-500">@yield('page-subtitle', 'Welcome back, ' . session('admin_name', 'Admin'))</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-slate-400">{{ now()->format('D, d M Y') }}</span>
                    <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center">
                        <span class="material-symbols-outlined text-amber-600 text-lg">notifications</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
