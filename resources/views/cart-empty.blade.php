@extends('layouts.public')

@section('title', 'Your Cart is Empty')
@section('meta_description', 'Your shopping cart is empty. Browse our global product catalog to find great deals.')

@section('content')
<section class="py-16 md:py-24">
    <div class="max-w-2xl mx-auto px-4 text-center">

        {{-- Illustration --}}
        <div class="w-36 h-36 mx-auto rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-8 shadow-inner">
            <span class="material-symbols-outlined text-[80px] text-slate-300 dark:text-slate-600">shopping_basket</span>
        </div>

        <h1 class="text-3xl sm:text-4xl font-black text-primary dark:text-white mb-3">Your cart is empty</h1>
        <p class="text-slate-500 text-lg mb-10 max-w-sm mx-auto">
            You haven't added any products yet. Explore our global catalog to find great deals.
        </p>

        <a href="{{ route('shop') }}" class="btn-primary px-8 py-4 text-base">
            <span class="material-symbols-outlined">explore</span>
            Browse Products
        </a>

        {{-- Category grid --}}
        <div class="mt-16">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Popular Categories</p>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach([
                    ['devices',  'Electronics', 'Global Tech',     'blue'],
                    ['face_5',   'Beauty',       'Skin & Care',     'pink'],
                    ['chair',    'Home Decor',   'Interior Design', 'amber'],
                    ['apparel',  'Fashion',      'Trendy Wear',     'emerald'],
                ] as $cat)
                <a href="{{ route('shop') }}" class="group card p-5 text-center card-hover">
                    <div class="w-10 h-10 mx-auto mb-3 rounded-lg bg-{{ $cat[3] }}-50 dark:bg-{{ $cat[3] }}-900/20 text-{{ $cat[3] }}-600 flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-[20px]">{{ $cat[0] }}</span>
                    </div>
                    <p class="font-bold text-sm">{{ $cat[1] }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $cat[2] }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
