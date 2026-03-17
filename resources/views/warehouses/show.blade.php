@extends('layouts.public')

@section('title', $warehouse['name'] . ' Warehouse Details')
@section('meta_description', 'Get your personal suite address at our ' . $warehouse['name'] . ' warehouse. Ship from ' . $warehouse['country'] . ' to Bangladesh.')

@section('content')
    <!-- Hero -->
    <section class="relative h-64 overflow-hidden">
        <img alt="{{ $warehouse['name'] }}" class="w-full h-full object-cover" src="{{ $warehouse['image'] }}" />
        <div class="absolute inset-0 bg-primary/60"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center px-4">
            <span class="text-5xl mb-4">{{ $warehouse['flag'] }}</span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black">{{ $warehouse['name'] }} Warehouse</h1>
            <p class="text-slate-200 mt-2">{{ $warehouse['address_short'] }}</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col-reverse gap-8 lg:grid lg:grid-cols-3 lg:gap-12">
                <!-- Left/Main -->
                <div class="lg:col-span-2 space-y-10">
                    <!-- Shipping Address -->
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm">
                        <h2 class="text-2xl font-bold text-primary dark:text-white mb-6 flex items-center gap-3">
                            <span class="material-symbols-outlined text-accent">location_on</span>
                            Your Shipping Address
                        </h2>
                        <div class="bg-slate-50 dark:bg-slate-800 rounded-xl p-6 font-mono text-sm leading-relaxed">
                            <p class="font-bold text-primary text-base">{{ $warehouse['name'] }} Warehouse</p>
                            <p>Your Name + Suite ID: <span class="font-bold text-accent">GS-XXXXX</span></p>
                            <p>{{ $warehouse['address'] }}</p>
                            <p>{{ $warehouse['city_state'] }}</p>
                            <p>{{ $warehouse['country'] }}</p>
                        </div>
                        <p class="text-sm text-slate-500 mt-4">Replace <strong>GS-XXXXX</strong> with your personal Suite ID. <a class="text-accent font-bold underline" href="{{ route('register') }}">Register to get yours free →</a></p>
                    </div>

                    <!-- How to Use -->
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm">
                        <h2 class="text-2xl font-bold text-primary dark:text-white mb-6">How to Use Your Suite ID</h2>
                        <div class="space-y-6">
                            @foreach($warehouse['steps'] as $i => $step)
                            <div class="flex gap-4">
                                <div class="size-10 bg-primary text-white rounded-full flex items-center justify-center font-bold shrink-0">{{ $i+1 }}</div>
                                <div>
                                    <h4 class="font-bold text-slate-800 dark:text-white">{{ $step[0] }}</h4>
                                    <p class="text-slate-500 text-sm mt-1">{{ $step[1] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Supported Stores -->
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm">
                        <h2 class="text-2xl font-bold text-primary dark:text-white mb-6">Compatible Stores</h2>
                        <div class="flex flex-wrap gap-3">
                            @foreach($warehouse['stores'] as $store)
                            <span class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-full text-sm font-medium">{{ $store }}</span>
                            @endforeach
                        </div>
                        <p class="text-slate-500 text-sm mt-4">And thousands more online retailers that ship to our {{ $warehouse['country'] }} address.</p>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Quick Stats -->
                    <div class="bg-primary text-white rounded-2xl p-6">
                        <h3 class="font-bold text-lg mb-6">Warehouse Stats</h3>
                        <div class="space-y-5">
                            @foreach($warehouse['stats'] as $stat)
                            <div class="flex justify-between">
                                <span class="text-slate-300 text-sm">{{ $stat[0] }}</span>
                                <span class="font-bold">{{ $stat[1] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Policies -->
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-slate-100 dark:border-slate-800 shadow-sm">
                        <h3 class="font-bold text-lg text-primary dark:text-white mb-4">Warehouse Policies</h3>
                        <ul class="space-y-3">
                            @foreach($warehouse['policies'] as $policy)
                            <li class="flex items-start gap-2 text-sm text-slate-600 dark:text-slate-400">
                                <span class="material-symbols-outlined text-green-500 text-base mt-0.5">check_circle</span>
                                {{ $policy }}
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- CTA -->
                    <div class="bg-accent rounded-2xl p-6 text-white text-center">
                        <h3 class="font-black text-xl mb-2">Get This Address Free</h3>
                        <p class="text-orange-100 text-sm mb-4">Register in 2 minutes and receive your personal {{ $warehouse['name'] }} Suite ID.</p>
                        <a href="{{ route('register') }}" class="block w-full py-3 bg-white text-accent font-bold rounded-lg hover:bg-orange-50 transition-colors">Create Free Account</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
