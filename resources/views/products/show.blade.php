@extends('layouts.public')

@section('title', $product['name'] . ' – Shop & Ship')
@section('meta_description', 'Buy ' . $product['name'] . ' and ship it to Bangladesh via GoodsShippers.')

@section('content')
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Breadcrumb -->
            <nav class="mb-8 text-sm text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-accent">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('catalog') }}" class="hover:text-accent">Catalog</a>
                <span class="mx-2">/</span>
                <span class="text-slate-800 dark:text-white font-medium">{{ $product['name'] }}</span>
            </nav>

            <div class="grid lg:grid-cols-2 gap-16">
                <!-- Images -->
                <div class="space-y-4">
                    <div class="aspect-square rounded-2xl overflow-hidden bg-slate-100 dark:bg-slate-800">
                        <img alt="{{ $product['name'] }}" class="w-full h-full object-contain" src="{{ $product['image'] }}" />
                    </div>
                </div>

                <!-- Details -->
                <div class="space-y-6">
                    <div>
                        <span class="text-xs font-bold text-accent uppercase tracking-widest">{{ $product['category'] }}</span>
                        <h1 class="text-3xl font-black text-primary dark:text-white mt-2">{{ $product['name'] }}</h1>
                        <div class="flex items-center gap-2 mt-2">
                            <div class="flex text-yellow-400">★★★★★</div>
                            <span class="text-sm text-slate-500">({{ $product['reviews'] }} reviews)</span>
                        </div>
                    </div>

                    <div class="text-4xl font-black text-primary dark:text-accent">{{ $product['price'] }}</div>

                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed">{{ $product['description'] }}</p>

                    <!-- Specs -->
                    <div class="bg-slate-50 dark:bg-slate-800 rounded-xl p-6">
                        <h4 class="font-bold text-primary dark:text-white mb-4">Specifications</h4>
                        <div class="space-y-2">
                            @foreach($product['specs'] as $spec)
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">{{ $spec[0] }}</span>
                                <span class="font-semibold text-slate-800 dark:text-white">{{ $spec[1] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Shipping Info -->
                    <div class="bg-primary/5 dark:bg-slate-800/50 rounded-xl p-6 space-y-3">
                        <h4 class="font-bold text-primary dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-accent">local_shipping</span>
                            Shipping Info
                        </h4>
                        <div class="grid grid-cols-3 gap-4 text-center text-sm">
                            <div><p class="text-slate-500">Ship From</p><p class="font-bold mt-1">🇺🇸 USA</p></div>
                            <div><p class="text-slate-500">Air Transit</p><p class="font-bold mt-1">10-15 Days</p></div>
                            <div><p class="text-slate-500">Est. Shipping</p><p class="font-bold mt-1">~$14/kg</p></div>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="space-y-3">
                        <a href="{{ route('register') }}" class="flex items-center justify-center gap-3 w-full py-4 bg-accent text-white font-bold rounded-xl hover:bg-accent/90 transition-all shadow-lg shadow-accent/20">
                            <span class="material-symbols-outlined">add_shopping_cart</span>
                            Buy & Ship This Product
                        </a>
                        <a href="{{ route('calculator') }}" class="flex items-center justify-center gap-3 w-full py-4 border-2 border-primary text-primary font-bold rounded-xl hover:bg-primary hover:text-white transition-all">
                            <span class="material-symbols-outlined">calculate</span>
                            Calculate Shipping Cost
                        </a>
                    </div>
                </div>
            </div>

            <!-- How to Order -->
            <div class="mt-20 bg-white dark:bg-slate-900 rounded-2xl p-10 border border-slate-100 dark:border-slate-800 shadow-sm">
                <h2 class="text-2xl font-bold text-primary dark:text-white mb-8 text-center">How to Order This Product</h2>
                <div class="grid md:grid-cols-4 gap-6 text-center">
                    @foreach(['Register Free','Send Product Link','We Purchase & Ship','You Receive'] as $i => $step)
                    <div>
                        <div class="w-12 h-12 bg-accent text-white rounded-full flex items-center justify-center font-bold text-xl mx-auto mb-3 shadow-lg">{{ $i+1 }}</div>
                        <p class="font-bold">{{ $step }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
