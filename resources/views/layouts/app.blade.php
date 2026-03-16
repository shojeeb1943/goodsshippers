<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GoossShippers') }} - Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-72 bg-indigo-900 border-r border-indigo-950 flex-shrink-0 flex flex-col hidden md:flex shadow-2xl z-20">
        <div class="h-20 flex items-center justify-center border-b border-indigo-800 bg-indigo-950 px-6">
            <h1 class="text-2xl font-extrabold tracking-tight text-white flex items-center gap-3">
                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                GoossShippers
            </h1>
        </div>
        
        <div class="p-5 bg-indigo-800/80 mt-4 mb-3 mx-4 rounded-xl flex items-center space-x-4 shadow border border-indigo-700">
            <div class="bg-indigo-500 rounded-full p-3 shadow-inner">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div class="overflow-hidden">
                <p class="text-[11px] text-indigo-300 uppercase tracking-widest font-bold mb-0.5">Your Suite ID</p>
                <p class="text-xl font-bold text-white truncate drop-shadow-sm">{{ auth()->user()->warehouse_suite_id ?? 'Pending' }}</p>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto py-2 scrollbar-thin scrollbar-thumb-indigo-700">
            <ul class="space-y-1.5 px-4">
                <li>
                    <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 px-4 py-3.5 rounded-lg hover:bg-indigo-800 transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-800 text-white font-semibold' : 'text-indigo-100' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-indigo-300' : 'text-indigo-400 group-hover:text-indigo-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('orders.index') }}" class="group flex items-center gap-3 px-4 py-3.5 rounded-lg hover:bg-indigo-800 transition-all duration-200 {{ request()->routeIs('orders.*') ? 'bg-indigo-800 text-white font-semibold' : 'text-indigo-100' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('orders.*') ? 'text-indigo-300' : 'text-indigo-400 group-hover:text-indigo-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        My Orders
                    </a>
                </li>
                <li>
                    <a href="#" class="group flex items-center gap-3 px-4 py-3.5 rounded-lg hover:bg-indigo-800 transition-all duration-200 text-indigo-100">
                        <svg class="w-5 h-5 text-indigo-400 group-hover:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        My Parcels
                    </a>
                </li>
                <li>
                    <a href="#" class="group flex items-center gap-3 px-4 py-3.5 rounded-lg hover:bg-indigo-800 transition-all duration-200 text-indigo-100">
                        <svg class="w-5 h-5 text-indigo-400 group-hover:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Shipments
                    </a>
                </li>
                <li>
                    <a href="#" class="group flex items-center gap-3 px-4 py-3.5 rounded-lg hover:bg-indigo-800 transition-all duration-200 text-indigo-100">
                        <svg class="w-5 h-5 text-indigo-400 group-hover:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Invoices
                    </a>
                </li>
                <li>
                    <a href="{{ route('tracking.index') }}" class="group flex items-center gap-3 px-4 py-3.5 rounded-lg hover:bg-indigo-800 transition-all duration-200 text-indigo-100">
                        <svg class="w-5 h-5 text-indigo-400 group-hover:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Live Tracking
                    </a>
                </li>
                <li>
                    <a href="{{ route('tickets.index') }}" class="group flex items-center gap-3 px-4 py-3.5 rounded-lg hover:bg-indigo-800 transition-all duration-200 {{ request()->routeIs('tickets.*') ? 'bg-indigo-800 text-white font-semibold' : 'text-indigo-100' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('tickets.*') ? 'text-indigo-300' : 'text-indigo-400 group-hover:text-indigo-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Support Tickets
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar footer (Profile) -->
        <div class="p-5 bg-indigo-950 border-t border-indigo-900 mt-auto">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 group text-indigo-100">
                <div class="w-10 h-10 rounded-full bg-indigo-700 flex items-center justify-center font-bold shadow-inner group-hover:bg-indigo-600 transition-colors">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate group-hover:text-indigo-200 transition-colors">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-indigo-400 truncate mt-0.5">{{ auth()->user()->email }}</p>
                </div>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="mt-5 border-t border-indigo-900/50 pt-4">
                @csrf
                <button type="submit" class="w-full text-left text-sm font-medium text-indigo-300 hover:text-white flex items-center justify-between group transition-colors px-1">
                    Sign Out
                    <svg class="w-4 h-4 text-indigo-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content wrapper -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden bg-gray-50 z-10">
        
        <!-- Header -->
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-200 flex items-center justify-between px-6 lg:px-10 shadow-sm flex-shrink-0 z-30 sticky top-0">
            <!-- Mobile Menu Toggle -->
            <button class="md:hidden text-gray-500 hover:text-indigo-600 focus:outline-none transition-colors p-2 rounded-lg hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>

            <!-- Page Title slot -->
            <div class="flex-1 min-w-0 md:ml-0 ml-4">
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight truncate">
                    {{ $header ?? '' }}
                </h2>
            </div>

            <!-- Notifications / Right Nav -->
            <div class="flex items-center gap-6">
                <!-- Notifications Bell -->
                <button class="relative p-2.5 text-gray-400 hover:text-indigo-600 transition-colors rounded-full hover:bg-indigo-50 border border-transparent hover:border-indigo-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="absolute top-1 right-1 flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 border-2 border-white"></span>
                        </span>
                    @endif
                </button>
            </div>
        </header>

        <!-- Main Content scrollable area -->
        <main class="flex-1 overflow-y-auto w-full p-6 lg:p-10 custom-scrollbar">
            <div class="max-w-[1600px] mx-auto space-y-8 pb-10">
                @if (session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                @endif
                @if (session('warning'))
                    <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-lg shadow-sm flex items-start gap-3">
                        <svg class="w-5 h-5 text-amber-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <p class="text-sm font-medium text-amber-800">{{ session('warning') }}</p>
                    </div>
                @endif
                
                {{ $slot }}
            </div>
        </main>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 8px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
    </style>
</body>
</html>
