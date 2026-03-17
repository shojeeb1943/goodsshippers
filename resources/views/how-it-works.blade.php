@extends('layouts.public')

@section('title', 'How It Works')
@section('meta_description', 'Learn how GoodsShippers works in 5 simple steps – from creating your account to receiving your package in Bangladesh.')

@section('content')
    <!-- Hero -->
    <section class="relative overflow-hidden py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="max-w-2xl">
                    <span class="inline-block px-3 py-1 rounded-full bg-accent/10 text-accent text-sm font-bold tracking-wide uppercase mb-4">How It Works</span>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 dark:text-white leading-tight mb-6">
                        Shipping International Packages <span class="text-primary">Made Simple</span>
                    </h1>
                    <p class="text-lg text-slate-600 dark:text-slate-400 mb-8 leading-relaxed">
                        Learn how our forwarding system works — from getting your personal suite ID to receiving your packages at your doorstep in Bangladesh.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-accent text-white font-bold rounded-xl shadow-lg shadow-accent/20 hover:bg-accent/90 transition-all flex items-center gap-2">
                            Create Free Account <span class="material-symbols-outlined">arrow_forward</span>
                        </a>
                        <a href="{{ route('track-shipment') }}" class="px-8 py-4 border-2 border-primary text-primary font-bold rounded-xl hover:bg-primary/5 transition-all">
                            Track Shipment
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-square bg-slate-200 dark:bg-slate-800 rounded-3xl overflow-hidden shadow-2xl">
                        <img alt="Logistics Warehouse" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQuEYWJ1otTT9o0WwQQXfxiJF2K3G1geUfSzRmnmLjBwKgVN7smTSx2QgnxA6azh6ynp_87lt9t0RqhS3y_WxNn-GXHTTQ7SusNuLEw9UiSATnAeR5LcCY8hGvOJVdusOl4LtFtXYhqrPnFLd-YHz9dF7gUFk3bjQ-rIRoPCJ5NipZZr4YOFv9Q0AEK2ZUNL3gTtjQxtKtiDd6n1ScWAR7ue5Vl85iRe-tSmk9x5lZUURdCPmBKxJeAgpvIChJbBgk09ZGgI7TXi4" />
                    </div>
                    {{-- Trust badge — now inline below image so it never clips outside its container on mobile --}}
                    <div class="mt-4 bg-white dark:bg-slate-900 p-4 rounded-2xl shadow-xl flex items-center gap-4 border border-slate-100 dark:border-slate-800">
                        <div class="size-10 shrink-0 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                            <span class="material-symbols-outlined text-[20px]">verified</span>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium">Safe Delivery</p>
                            <p class="text-sm font-bold">100k+ Packages Delivered</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5 Steps -->
    <section class="py-20 bg-white dark:bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-4">Shipping Made Easy in 5 Steps</h2>
                <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">Our system is designed to make international shopping and shipping simple and transparent.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach([
                    ['person_add','Create Account','Sign up for your personal suite ID instantly.'],
                    ['shopping_bag','Shop or Send','Shop global or ship your items to our warehouse.'],
                    ['warehouse','Processing','Items are weighed, recorded, and inspected.'],
                    ['package_2','Consolidation','We create your shipment and consolidate items.'],
                    ['local_shipping','Delivery','Track your package right to your doorstep.'],
                ] as $step)
                <div class="bg-slate-50 dark:bg-slate-800 p-8 rounded-2xl text-center border border-slate-100 dark:border-slate-700 hover:shadow-xl transition-shadow group">
                    <div class="size-16 bg-white dark:bg-slate-900 rounded-full flex items-center justify-center text-primary shadow-sm mx-auto mb-6 group-hover:bg-primary group-hover:text-white transition-all">
                        <span class="material-symbols-outlined text-3xl">{{ $step[0] }}</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2">{{ $step[1] }}</h3>
                    <p class="text-sm text-slate-500">{{ $step[2] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Service Types -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-4">Choose the Service That Fits Your Needs</h2>
                <p class="text-slate-600 dark:text-slate-400">Multiple ways to ship from anywhere in the world.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                    ['add_shopping_cart','Shop For Me','Can\'t buy it yourself? Let us handle the purchase and payment for you.', ['Submit Links','Receive Quote','Approve Purchase','Delivered'], false],
                    ['package','Ship For Me','Shop yourself and use our global warehouse address as your delivery destination.',['Buy on Website','Ship to Suite','Consolidate','Arrives in BD'], true],
                    ['inventory_2','Bulk Shipment','Ideal for businesses. Large volumes with dedicated logistics support.',['Business Setup','Inventory Link','Customs Clear','Door-to-Door'], false],
                ] as $service)
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 border {{ $service[4] ? 'border-2 border-primary relative shadow-xl' : 'border-slate-200 dark:border-slate-700 shadow-sm' }} flex flex-col h-full">
                    @if($service[4])
                    <span class="absolute top-0 right-8 -translate-y-1/2 px-3 py-1 bg-primary text-white text-[10px] font-bold rounded-full uppercase tracking-widest">Most Popular</span>
                    @endif
                    <div class="size-12 {{ $service[4] ? 'bg-primary text-white' : 'bg-primary/10 text-primary' }} rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined">{{ $service[0] }}</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">{{ $service[1] }}</h3>
                    <p class="text-slate-500 text-sm mb-8">{{ $service[2] }}</p>
                    <div class="space-y-4 mb-8">
                        @foreach($service[3] as $i => $step)
                        <div class="flex items-center gap-3">
                            <span class="size-6 rounded-full bg-primary text-white text-[10px] flex items-center justify-center font-bold">{{ $i+1 }}</span>
                            <span class="text-xs font-medium">{{ $step }}</span>
                        </div>
                        @endforeach
                    </div>
                    <a class="mt-auto text-primary font-bold text-sm flex items-center gap-1 hover:underline" href="{{ route('services') }}">Learn More <span class="material-symbols-outlined text-sm">chevron_right</span></a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Warehouse Handling Process -->
    <section class="py-20 bg-slate-50 dark:bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-4">What Happens When Your Parcel Arrives</h2>
                <p class="text-slate-600 dark:text-slate-400">Our meticulous warehouse process ensures your items are safe and documented.</p>
            </div>
            <div class="relative flex flex-col md:flex-row justify-between items-center gap-8 px-10">
                <div class="absolute top-1/2 left-0 w-full h-0.5 bg-slate-200 dark:bg-slate-700 -translate-y-1/2 hidden md:block"></div>
                @foreach([
                    ['inbox','Parcel Received'],['fact_check','Inspection'],['straighten','Dimensions'],['photo_camera','Photos Taken'],['lock','Stored Safely']
                ] as $step)
                <div class="relative z-10 flex flex-col items-center group">
                    <div class="size-16 rounded-full bg-white dark:bg-slate-800 border-4 border-slate-50 dark:border-slate-900 flex items-center justify-center text-primary shadow-lg mb-4">
                        <span class="material-symbols-outlined text-3xl">{{ $step[0] }}</span>
                    </div>
                    <p class="text-sm font-bold">{{ $step[1] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Tracking Demo -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">Track Every Step of Your Shipment</h2>
                    <p class="text-lg text-slate-600 dark:text-slate-400 mb-8">Our real-time tracking interface gives you peace of mind. Know exactly where your package is from the merchant's store to your front door.</p>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50">
                            <span class="material-symbols-outlined text-primary mt-1">notifications_active</span>
                            <div>
                                <p class="font-bold">Automated Notifications</p>
                                <p class="text-sm text-slate-500">Email and SMS updates at every major milestone.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50">
                            <span class="material-symbols-outlined text-primary mt-1">mobile_friendly</span>
                            <div>
                                <p class="font-bold">Mobile Optimization</p>
                                <p class="text-sm text-slate-500">Track on the go with our user-friendly dashboard.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-2xl border border-slate-100 dark:border-slate-700">
                    <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-100 dark:border-slate-700">
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider font-bold">Tracking ID</p>
                            <p class="text-lg font-mono font-bold">GS-8823-X920</p>
                        </div>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">In Transit</span>
                    </div>
                    <div class="space-y-6">
                        @foreach([
                            ['check','green','Product Requested','Oct 12, 2023 - 09:45 AM','completed'],
                            ['check','green','Arrived at Warehouse','Oct 14, 2023 - 02:20 PM (New York, USA)','completed'],
                            ['check','green','Ready for Shipment','Oct 15, 2023 - 11:00 AM','completed'],
                            ['radio_button_checked','primary','In Transit','On the way to Dhaka, Bangladesh','active'],
                            ['radio_button_unchecked','slate','Customs Clearance','Pending','pending'],
                            ['radio_button_unchecked','slate','Delivered','Pending','pending'],
                        ] as $track)
                        <div class="flex gap-4 {{ $track[4] === 'pending' ? 'opacity-40' : '' }}">
                            <div class="flex flex-col items-center">
                                <div class="size-6 rounded-full {{ $track[4] === 'completed' ? 'bg-green-500' : ($track[4] === 'active' ? 'border-2 border-primary bg-white dark:bg-slate-800' : 'border-2 border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800') }} flex items-center justify-center text-white">
                                    @if($track[4] === 'completed')
                                    <span class="material-symbols-outlined text-[14px]">check</span>
                                    @elseif($track[4] === 'active')
                                    <div class="size-2 rounded-full bg-primary animate-pulse"></div>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-bold {{ $track[4] === 'active' ? 'text-primary' : '' }}">{{ $track[2] }}</p>
                                <p class="text-xs text-slate-500">{{ $track[3] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Features -->
    <section class="py-20 bg-primary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach([
                    ['payments','Transparent Pricing','No hidden fees. What you see on our calculator is what you pay.'],
                    ['admin_panel_settings','Secure Handling','24/7 monitored warehouses ensure your goods are protected.'],
                    ['inventory','Consolidation','Save up to 70% on shipping by combining multiple orders.'],
                    ['track_changes','Real-Time Tracking','Advanced API integration with global carriers for live updates.'],
                ] as $feat)
                <div class="bg-white/5 border border-white/10 p-8 rounded-2xl">
                    <span class="material-symbols-outlined text-accent text-3xl mb-4">{{ $feat[0] }}</span>
                    <h4 class="text-white font-bold mb-2">{{ $feat[1] }}</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">{{ $feat[2] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-primary to-[#2a528a] rounded-[2rem] p-8 md:p-16 text-center">
                <h2 class="text-3xl md:text-5xl font-black text-white mb-6">Ready to Start Shipping Internationally?</h2>
                <p class="text-blue-100 text-lg mb-10">Join 50,000+ happy customers in Bangladesh shopping global brands today.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="px-10 py-4 bg-accent text-white font-bold rounded-xl shadow-xl shadow-accent/20 hover:scale-105 transition-transform">Create Free Account</a>
                    <a href="{{ route('track-shipment') }}" class="px-10 py-4 bg-white text-primary font-bold rounded-xl hover:bg-blue-50 transition-colors">Track Your Shipment</a>
                </div>
            </div>
        </div>
    </section>
@endsection
