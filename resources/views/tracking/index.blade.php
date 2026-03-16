<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Track Your Package | {{ config('app.name', 'GoossShippers') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col">
    
    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="/" class="flex items-center gap-2.5">
                    <div class="bg-indigo-600 p-2 rounded-xl text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="text-xl font-extrabold text-slate-900 tracking-tight">GoossShippers</span>
                </a>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-200 transition-all hover:-translate-y-0.5">Get Suite ID</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        <!-- Hero Section -->
        <div class="bg-white border-b border-slate-200 pt-16 pb-20 overflow-hidden relative">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#4f46e5 1px, transparent 1px); background-size: 24px 24px;"></div>
            
            <div class="max-w-4xl mx-auto px-4 relative z-10 text-center">
                <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight mb-4">
                    Track your <span class="text-indigo-600">journey</span>.
                </h1>
                <p class="text-lg text-slate-500 max-w-2xl mx-auto mb-10 font-medium">
                    Enter your tracking number or shipment ID below to get real-time status updates on your packages.
                </p>

                <!-- Search Box -->
                <form action="{{ route('tracking.search') }}" method="GET" class="relative max-w-2xl mx-auto group">
                    <input type="text" name="tracking_number" value="{{ request('tracking_number') }}" placeholder="SH-BD-XXXX or Carrier Tracking #" required
                           class="w-full pl-6 pr-32 py-5 bg-white border-2 border-slate-200 rounded-2xl text-slate-900 font-bold placeholder:text-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50/50 transition-all shadow-xl shadow-slate-100">
                    <button type="submit" class="absolute right-3 top-3 bottom-3 px-8 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 flex items-center gap-2">
                        <span>Track</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </form>
            </div>
        </div>

        <!-- Results Section -->
        <div class="max-w-4xl mx-auto px-4 -mt-10 pb-20 relative z-20">
            @if(isset($entity))
                <div class="bg-white rounded-3xl shadow-2xl shadow-slate-200 border border-slate-100 overflow-hidden">
                    <div class="bg-slate-900 p-8 sm:p-10 text-white flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                        <div>
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">
                                {{ $type === 'Shipment' ? 'Shipment Number' : 'Carrier Tracking' }}
                            </p>
                            <h2 class="text-2xl font-black">{{ $tracking_number }}</h2>
                        </div>
                        <div class="flex flex-col items-start sm:items-end">
                            <span class="px-5 py-2 bg-indigo-600 text-white text-sm font-black rounded-full uppercase tracking-wider mb-2">
                                {{ str_replace('_', ' ', $entity->status) }}
                            </span>
                            <p class="text-slate-400 text-sm font-medium">Last Updated: {{ $entity->updated_at->format('M j, Y h:i A') }}</p>
                        </div>
                    </div>

                    @if($entity->statusLogs->count() > 0)
                        <div class="p-8 sm:p-10">
                            <h3 class="text-xl font-extrabold text-slate-900 mb-10 flex items-center gap-3">
                                <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Tracking History
                            </h3>

                            <div class="relative">
                                <!-- Vertical Line -->
                                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-slate-100"></div>

                                <div class="space-y-12">
                                    @foreach($entity->statusLogs as $log)
                                        <div class="relative pl-12">
                                            <!-- Dot -->
                                            <div class="absolute left-0 top-1.5 w-8 h-8 rounded-full border-4 border-white flex items-center justify-center z-10 
                                                {{ $loop->first ? 'bg-indigo-600 ring-4 ring-indigo-50 animate-pulse' : 'bg-slate-300' }}">
                                            </div>

                                            <div class="flex flex-col sm:flex-row justify-between items-start gap-2">
                                                <div>
                                                    <h4 class="text-lg font-bold {{ $loop->first ? 'text-indigo-600' : 'text-slate-800' }}">
                                                        {{ ucwords(str_replace('_', ' ', $log->status)) }}
                                                    </h4>
                                                    @if($log->note)
                                                        <p class="text-slate-500 mt-1 font-medium leading-relaxed">{{ $log->note }}</p>
                                                    @endif
                                                </div>
                                                <div class="flex flex-col items-start sm:items-end">
                                                    <p class="text-sm font-bold text-slate-900">{{ $log->created_at->format('h:i A') }}</p>
                                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-tight">{{ $log->created_at->format('M j, Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="p-16 text-center">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">No history found</h3>
                            <p class="mt-2 text-slate-500 font-medium">Tracking history for this package is currently unavailable.</p>
                        </div>
                    @endif
                </div>
            @elseif(request()->has('tracking_number'))
                <div class="bg-white rounded-3xl p-16 text-center shadow-xl shadow-slate-100 border border-slate-100">
                    <div class="w-24 h-24 bg-rose-50 rounded-full flex items-center justify-center mx-auto mb-8">
                        <svg class="w-12 h-12 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-900 mb-4">No package found</h2>
                    <p class="text-lg text-slate-500 max-w-md mx-auto font-medium">We couldn't find any parcel or shipment with the ID "<span class="text-rose-600 font-bold">{{ request('tracking_number') }}</span>". Please double-check the number and try again.</p>
                    <div class="mt-10">
                        <a href="{{ route('tracking.index') }}" class="text-indigo-600 font-bold hover:text-indigo-700 underline underline-offset-8">Clear and start over</a>
                    </div>
                </div>
            @endif
        </div>
    </main>

    <footer class="bg-slate-900 text-white py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-slate-400 font-medium">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <div class="mt-6 flex justify-center gap-6">
                <a href="#" class="text-slate-500 hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="text-slate-500 hover:text-white transition-colors">Terms of Service</a>
                <a href="#" class="text-slate-500 hover:text-white transition-colors">Support</a>
            </div>
        </div>
    </footer>
</body>
</html>
