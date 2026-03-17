@extends('layouts.public')

@section('title', 'About Us')
@section('meta_description', 'Bridging continents and simplifying logistics. Your trusted gateway for international shopping and shipping to Bangladesh.')

@section('content')
    <!-- Hero -->
    <section class="relative bg-primary text-white py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <img alt="Background pattern" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA06DnQfGPpVQCnC2Lz7SWyXTcXzQtgKX3WMVD7_1xZFHi_g76A_Dw0klvkNmRc6bnrhzxVetoOJVpzaZ9IIlfrZniAYsMZMq_n0kf7ocBw8Ar-o1egcihngHGpda5f7YEJb-Mbb_JfU46ZC5fe43l0p7sLIRc-OzmSGZNV2YjjAMmQCTJ4mI64s-yayDlM0XKkSWpxec-47aGjgaGGSdevDdj2UZ3R1Rbahykg6Jo3Zzs3eGhMqumRhsp5pLciJ3cPvtPWz_e8jcE" />
        </div>
        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-black mb-6">About GoodsShippers</h1>
            <p class="text-xl text-slate-300 max-w-2xl mx-auto">Bridging continents and simplifying logistics. Your trusted gateway for international shopping and shipping to Bangladesh.</p>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-20 bg-white dark:bg-background-dark">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div class="inline-block px-4 py-1 bg-accent/10 text-accent rounded-full text-sm font-bold tracking-wider uppercase">Our Story</div>
                    <h2 class="text-4xl font-black text-primary dark:text-white">Pioneering Seamless Global Logistics Since 2015</h2>
                    <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed">GoodsShippers started with a simple mission: to make international products accessible to everyone in Bangladesh. We recognized the challenges of high shipping costs, complex customs, and unreliable tracking.</p>
                    <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed">Today, we operate a global network of warehouses in the USA, UK, and Malaysia, serving thousands of customers and businesses with transparent pricing and exceptional care.</p>
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <p class="text-4xl font-black text-accent">50k+</p>
                            <p class="text-sm font-bold text-slate-500 uppercase tracking-widest mt-1">Packages Delivered</p>
                        </div>
                        <div>
                            <p class="text-4xl font-black text-accent">3</p>
                            <p class="text-sm font-bold text-slate-500 uppercase tracking-widest mt-1">Global Hubs</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="rounded-3xl overflow-hidden shadow-2xl">
                        <img alt="Warehouse team" class="w-full h-full object-cover aspect-square" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA06DnQfGPpVQCnC2Lz7SWyXTcXzQtgKX3WMVD7_1xZFHi_g76A_Dw0klvkNmRc6bnrhzxVetoOJVpzaZ9IIlfrZniAYsMZMq_n0kf7ocBw8Ar-o1egcihngHGpda5f7YEJb-Mbb_JfU46ZC5fe43l0p7sLIRc-OzmSGZNV2YjjAMmQCTJ4mI64s-yayDlM0XKkSWpxec-47aGjgaGGSdevDdj2UZ3R1Rbahykg6Jo3Zzs3eGhMqumRhsp5pLciJ3cPvtPWz_e8jcE" />
                    </div>
                    <div class="absolute -bottom-6 -left-6 bg-white dark:bg-slate-900 p-8 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-800 hidden md:block">
                        <div class="flex items-center gap-4">
                            <span class="material-symbols-outlined text-accent text-4xl">verified</span>
                            <div>
                                <p class="text-xl font-bold text-primary dark:text-white">Trusted Partner</p>
                                <p class="text-sm text-slate-500">Official Customs Clearing Agent</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-20 bg-slate-50 dark:bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white dark:bg-slate-900 p-10 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800">
                    <span class="material-symbols-outlined text-accent text-5xl mb-6">rocket_launch</span>
                    <h3 class="text-2xl font-bold text-primary dark:text-white mb-4">Our Mission</h3>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed">To empower consumers and businesses in Bangladesh by providing a reliable, cost-effective, and transparent international shipping bridge to the world's leading marketplaces.</p>
                </div>
                <div class="bg-primary p-10 rounded-3xl shadow-sm border border-primary">
                    <span class="material-symbols-outlined text-accent text-5xl mb-6">visibility</span>
                    <h3 class="text-2xl font-bold text-white mb-4">Our Vision</h3>
                    <p class="text-slate-300 leading-relaxed">To become the leading logistics platform that defines the future of cross-border commerce in South Asia through innovation, technology, and customer-centric service.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-20 bg-white dark:bg-background-dark">
        <div class="max-w-7xl mx-auto px-4 text-center mb-16">
            <h2 class="text-4xl font-black text-primary dark:text-white mb-4">Why Choose Us?</h2>
            <p class="text-slate-600 dark:text-slate-400">Comprehensive logistics solutions tailored for your needs.</p>
        </div>
        <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-3 gap-8">
            @foreach([
                ['inventory_2','Free Consolidation','Combine multiple orders into one package to save up to 70% on shipping costs.'],
                ['track_changes','Real-time Tracking','Know exactly where your package is, from our warehouse to your doorstep in Bangladesh.'],
                ['support_agent','Expert Support','Our dedicated team assists with customs documentation and provides local support.'],
            ] as $feat)
            <div class="p-8 bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 hover:shadow-xl transition-all group">
                <div class="w-14 h-14 bg-primary/5 rounded-xl flex items-center justify-center text-primary mb-6 group-hover:bg-accent group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined">{{ $feat[0] }}</span>
                </div>
                <h4 class="text-xl font-bold mb-3">{{ $feat[1] }}</h4>
                <p class="text-slate-600 dark:text-slate-400 text-sm">{{ $feat[2] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-20 bg-slate-50 dark:bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-black text-center text-primary dark:text-white mb-16">How It Works</h2>
            <div class="relative">
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-slate-200 dark:bg-slate-800 -translate-y-1/2"></div>
                <div class="grid md:grid-cols-4 gap-8 relative z-10">
                    @foreach(['Register','Shop & Ship','Consolidate','Receive'] as $i => $step)
                    <div class="text-center space-y-4">
                        <div class="w-12 h-12 bg-accent text-white rounded-full flex items-center justify-center mx-auto font-bold text-xl shadow-lg">{{ $i+1 }}</div>
                        <h5 class="font-bold">{{ $step }}</h5>
                        <p class="text-sm text-slate-500">{{ ['Get your unique warehouse addresses.','Ship your items to our global hubs.','Review and group your packages.','Door-to-door delivery in BD.'][$i] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Global Warehouse CTA -->
    <section class="py-20 bg-white dark:bg-background-dark">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-primary rounded-3xl p-12 overflow-hidden relative">
                <div class="absolute inset-0 opacity-20">
                    <img alt="World map" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA06DnQfGPpVQCnC2Lz7SWyXTcXzQtgKX3WMVD7_1xZFHi_g76A_Dw0klvkNmRc6bnrhzxVetoOJVpzaZ9IIlfrZniAYsMZMq_n0kf7ocBw8Ar-o1egcihngHGpda5f7YEJb-Mbb_JfU46ZC5fe43l0p7sLIRc-OzmSGZNV2YjjAMmQCTJ4mI64s-yayDlM0XKkSWpxec-47aGjgaGGSdevDdj2UZ3R1Rbahykg6Jo3Zzs3eGhMqumRhsp5pLciJ3cPvtPWz_e8jcE" />
                </div>
                <div class="relative z-10 flex flex-col lg:flex-row items-center gap-12">
                    <div class="flex-1 space-y-6">
                        <h2 class="text-3xl md:text-4xl font-black text-white">Our Global Warehouse Network</h2>
                        <p class="text-slate-300">Strategically located hubs to minimize internal transit times and maximize shipping frequency.</p>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3 text-white"><span class="material-symbols-outlined text-accent">location_on</span><strong>New Jersey, USA</strong> - Daily intake & Weekly air/sea</li>
                            <li class="flex items-center gap-3 text-white"><span class="material-symbols-outlined text-accent">location_on</span><strong>London, UK</strong> - Specialized luxury item handling</li>
                            <li class="flex items-center gap-3 text-white"><span class="material-symbols-outlined text-accent">location_on</span><strong>Kuala Lumpur, Malaysia</strong> - Fast regional transit</li>
                        </ul>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('warehouses.index') }}" class="inline-block px-8 py-4 bg-accent hover:bg-accent/90 text-white font-bold rounded-xl transition-all shadow-xl shadow-accent/20">View All Warehouse Locations</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
