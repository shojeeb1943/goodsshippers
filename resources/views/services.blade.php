@extends('layouts.public')

@section('title', 'Our Services')
@section('meta_description', 'Explore GoodsShippers service options: Shop For Me, Ship For Me, and Bulk Shipment — with transparent pricing.')

@section('content')
    <!-- Hero -->
    <section class="bg-primary text-white py-20 text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-5xl md:text-6xl font-black mb-6">Our Services</h1>
            <p class="text-slate-300 text-lg max-w-2xl mx-auto">Choose the service that fits your needs. From personal shopping to bulk commercial logistics — we have you covered globally.</p>
        </div>
    </section>

    <!-- Service Cards -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8">
                @foreach([
                    ['Shop For Me','send_to_mobile','Let us purchase and ship your desired products from global stores directly to Bangladesh.','We browse and buy on your behalf.',['Submit product links & details','Receive an itemized quote','Pay & we make the purchase','Track until it arrives'],'#'],
                    ['Ship For Me','inventory_2','Get your personal suite ID, shop on any global store, ship to our address, and we forward it home.','The most popular option.',['Get your unique Suite ID','Shop at any global store','We receive and verify','Select consolidation & pay'], '#'],
                    ['Bulk Shipment','warehouse','For businesses and high-volume importers needing dedicated cargo solutions and customs handling.','Ideal for commercial imports.',['Speak with our cargo team','Submit inventory manifest','We arrange cargo pickup','Door-to-port or door-to-door'], '#'],
                ] as $service)
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden flex flex-col">
                    <div class="bg-primary/5 dark:bg-slate-800 p-8">
                        <div class="w-14 h-14 bg-primary text-white rounded-xl flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-2xl">{{ $service[1] }}</span>
                        </div>
                        <h2 class="text-2xl font-black text-primary dark:text-white mb-2">{{ $service[0] }}</h2>
                        <p class="text-xs font-bold text-accent uppercase tracking-widest">{{ $service[3] }}</p>
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <p class="text-slate-600 dark:text-slate-400 mb-6">{{ $service[2] }}</p>
                        <div class="space-y-3 mb-8 flex-1">
                            @foreach($service[4] as $i => $step)
                            <div class="flex items-start gap-3">
                                <span class="size-6 rounded-full bg-primary/10 text-primary text-xs flex items-center justify-center font-bold shrink-0 mt-0.5">{{ $i+1 }}</span>
                                <span class="text-sm text-slate-700 dark:text-slate-300">{{ $step }}</span>
                            </div>
                            @endforeach
                        </div>
                        <a href="{{ route('register') }}" class="block w-full text-center py-3 bg-accent text-white font-bold rounded-lg hover:bg-accent/90 transition-all">Get Started</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Comparison Table -->
    <section class="py-20 bg-slate-50 dark:bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-primary dark:text-white mb-16">Service Comparison</h2>
            <div class="overflow-x-auto rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th class="p-6 text-left font-bold">Feature</th>
                            <th class="p-6 text-center font-bold">Shop For Me</th>
                            <th class="p-6 text-center font-bold bg-[#2a528a]">Ship For Me</th>
                            <th class="p-6 text-center font-bold">Bulk Shipment</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach([
                            ['We Purchase for You','✓','✗','✗'],
                            ['Free Consolidation','✓','✓','✓'],
                            ['Air Shipping','✓','✓','✓'],
                            ['Sea Shipping','✓','✓','✓'],
                            ['Suite ID / Personal Address','✗','✓','✓'],
                            ['Dedicated Cargo Agent','✗','✗','✓'],
                            ['Customs Clearance Support','✓','✓','✓'],
                            ['Volume Discounts','✗','✗','✓'],
                        ] as $row)
                        <tr class="bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="p-5 font-medium text-slate-700 dark:text-slate-300">{{ $row[0] }}</td>
                            @foreach(array_slice($row, 1) as $val)
                            <td class="p-5 text-center">
                                @if($val === '✓')
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-green-100 text-green-600 font-bold text-xs">✓</span>
                                @else
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-slate-100 text-slate-400 font-bold text-xs">✗</span>
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-primary dark:text-white mb-6">Transparent, Weight-Based Pricing</h2>
            <p class="text-slate-500 max-w-2xl mx-auto mb-16">We charge based on actual or volumetric weight (whichever is higher). No surprise fees.</p>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach([['🇺🇸 USA', '$14 / kg (Air)', '$4.5 / kg (Sea)', '10-15 days', '45-60 days'],
                          ['🇬🇧 UK', '£11 / kg (Air)', '£3.5 / kg (Sea)', '7-12 days', '40-55 days'],
                          ['🇲🇾 Malaysia', 'RM 35 / kg (Air)', 'RM 12 / kg (Sea)', '4-7 days', '25-35 days']] as $price)
                <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm">
                    <h3 class="text-xl font-bold text-primary dark:text-white mb-6">{{ $price[0] }}</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-slate-100 dark:border-slate-800">
                            <span class="text-slate-500 text-sm">Air Rate</span>
                            <span class="font-bold text-primary">{{ $price[1] }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-slate-100 dark:border-slate-800">
                            <span class="text-slate-500 text-sm">Sea Rate</span>
                            <span class="font-bold text-primary">{{ $price[2] }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-slate-100 dark:border-slate-800">
                            <span class="text-slate-500 text-sm">Air Transit</span>
                            <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $price[3] }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3">
                            <span class="text-slate-500 text-sm">Sea Transit</span>
                            <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $price[4] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <p class="text-slate-500 text-sm mt-8">All rates are estimates. Use the <a class="text-accent font-bold" href="{{ route('calculator') }}">Shipping Calculator</a> for exact pricing.</p>
        </div>
    </section>
@endsection
