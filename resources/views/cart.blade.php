@extends('layouts.public')

@section('title', 'Your Cart')
@section('meta_description', 'Review your selected products and proceed to checkout for international shipping to Bangladesh.')

@section('content')

    {{-- ────────────────────────────────── FILLED CART STATE ────────────────────────── --}}
    <section x-data="cart()" class="py-10 md:py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-1.5 text-sm text-slate-400 mb-8">
                <a href="{{ route('home') }}" class="hover:text-accent transition-colors">Home</a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <a href="{{ route('catalog') }}" class="hover:text-accent transition-colors">Products</a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <span class="text-slate-700 dark:text-slate-200 font-medium">Cart</span>
            </nav>

            {{-- Page heading + item count --}}
            <div class="mb-8 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-black text-primary dark:text-white tracking-tight">Your Cart</h1>
                    <p class="text-slate-500 mt-1">Review your items before checking out.</p>
                </div>
                <a href="{{ route('catalog') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-primary hover:text-accent transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span> Continue Shopping
                </a>
            </div>

            {{-- ── EMPTY STATE (shown when 0 items) ── --}}
            <div x-show="items.length === 0" x-cloak class="py-20 flex flex-col items-center text-center">
                <div class="w-32 h-32 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-[72px] text-slate-300 dark:text-slate-600">shopping_basket</span>
                </div>
                <h2 class="text-2xl font-bold text-primary dark:text-white mb-2">Your cart is empty</h2>
                <p class="text-slate-500 max-w-sm mb-8">You haven't added any products yet. Explore our global catalog to find great deals.</p>
                <a href="{{ route('catalog') }}" class="btn-primary px-8 py-3.5">
                    <span class="material-symbols-outlined text-[18px]">explore</span>
                    Browse Products
                </a>

                {{-- Categories strip on empty state --}}
                <div class="mt-16 w-full max-w-2xl">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Popular Categories</p>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @foreach([['devices','Electronics','Global Tech','blue'],['face_5','Beauty','Skin & Care','pink'],['chair','Home Decor','Interior','amber'],['apparel','Fashion','Trendy Wear','emerald']] as $cat)
                        <a href="{{ route('catalog') }}" class="group card p-5 text-center hover:border-primary/30 card-hover cursor-pointer">
                            <div class="w-10 h-10 mx-auto mb-3 rounded-lg bg-{{ $cat[3] }}-50 dark:bg-{{ $cat[3] }}-900/20 text-{{ $cat[3] }}-600 flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-[20px]">{{ $cat[0] }}</span>
                            </div>
                            <p class="font-bold text-sm text-slate-800 dark:text-white">{{ $cat[1] }}</p>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $cat[2] }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ── FILLED CART ── --}}
            <div x-show="items.length > 0" class="flex flex-col-reverse gap-8 lg:grid lg:grid-cols-3 lg:gap-10">

                {{-- Left: Items + Promo --}}
                <div class="lg:col-span-2 space-y-4">

                    {{-- Cart items --}}
                    <template x-for="(item, index) in items" :key="index">
                        <div class="card p-5 sm:p-6 flex flex-col sm:flex-row gap-5 sm:items-center card-hover">
                            {{-- Product image --}}
                            <div class="w-full sm:w-28 h-32 sm:h-28 rounded-xl bg-slate-50 dark:bg-slate-800 overflow-hidden shrink-0">
                                <img :src="item.image" :alt="item.name" class="w-full h-full object-contain">
                            </div>
                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start gap-3">
                                    <div class="min-w-0">
                                        <h3 class="font-bold text-primary dark:text-white truncate" x-text="item.name"></h3>
                                        <p class="text-xs text-slate-400 mt-0.5" x-text="'SKU: ' + item.sku"></p>
                                    </div>
                                    <p class="text-lg font-black text-primary dark:text-accent shrink-0" x-text="'$' + (item.price * item.qty).toFixed(2)"></p>
                                </div>
                                {{-- Quantity + Remove --}}
                                <div class="mt-4 flex items-center justify-between gap-4">
                                    {{-- QTY stepper --}}
                                    <div class="inline-flex items-center border border-slate-200 dark:border-slate-700 rounded-lg overflow-hidden bg-slate-50 dark:bg-slate-800">
                                        <button @click="decrement(index)" class="px-3 py-2 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors text-slate-600 dark:text-slate-300">
                                            <span class="material-symbols-outlined text-[16px]">remove</span>
                                        </button>
                                        <span x-text="item.qty" class="px-4 font-bold text-slate-900 dark:text-white min-w-[2rem] text-center"></span>
                                        <button @click="increment(index)" class="px-3 py-2 hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors text-slate-600 dark:text-slate-300">
                                            <span class="material-symbols-outlined text-[16px]">add</span>
                                        </button>
                                    </div>
                                    <button @click="remove(index)" class="flex items-center gap-1 text-red-500 hover:text-red-600 text-xs font-semibold transition-colors">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>

                    {{-- Promo Code --}}
                    <div class="card p-5 sm:p-6">
                        <label class="form-label">Promo / Referral Code</label>
                        <div class="flex gap-3 mt-1">
                            <input type="text" placeholder="Enter code" class="form-input flex-1">
                            <button class="shrink-0 px-5 py-2.5 bg-primary/10 text-primary dark:text-white dark:bg-slate-700 font-bold rounded-lg hover:bg-primary hover:text-white transition-all text-sm">Apply</button>
                        </div>
                    </div>

                    {{-- Shipping reassurance - inline on mobile --}}
                    <div class="card p-5 flex flex-wrap gap-5 lg:hidden">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 shrink-0 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                <span class="material-symbols-outlined text-[18px]">shield</span>
                            </div>
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Secure Payments</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 shrink-0 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <span class="material-symbols-outlined text-[18px]">payments</span>
                            </div>
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Transparent Pricing</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 shrink-0 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                                <span class="material-symbols-outlined text-[18px]">location_on</span>
                            </div>
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Live Tracking</span>
                        </div>
                    </div>
                </div>

                {{-- Right: Order Summary --}}
                <div>
                    <div class="sticky top-24 space-y-4">
                        <div class="card p-6 sm:p-8 shadow-md">
                            <h3 class="text-lg font-black text-primary dark:text-white mb-5 pb-4 border-b border-slate-100 dark:border-slate-800">Order Summary</h3>
                            <div class="space-y-3 text-sm mb-6">
                                <div class="flex justify-between text-slate-600 dark:text-slate-400">
                                    <span>Subtotal (<span x-text="items.length"></span> items)</span>
                                    <span class="font-semibold text-slate-900 dark:text-white" x-text="'$' + subtotal().toFixed(2)"></span>
                                </div>
                                <div class="flex justify-between text-slate-600 dark:text-slate-400">
                                    <span>Estimated Shipping</span>
                                    <span class="font-semibold text-slate-900 dark:text-white">$15.00</span>
                                </div>
                                <div class="pt-3 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center">
                                    <span class="text-base font-bold text-primary dark:text-white">Total</span>
                                    <span class="text-2xl font-black text-accent" x-text="'$' + (subtotal() + 15).toFixed(2)"></span>
                                </div>
                            </div>

                            {{-- Shipping note --}}
                            <div class="bg-slate-50 dark:bg-slate-800 rounded-xl p-4 mb-6 flex gap-2.5 text-xs text-slate-500">
                                <span class="material-symbols-outlined text-primary text-[16px] shrink-0 mt-0.5">info</span>
                                <p>Shipping cost is estimated. Final cost is confirmed after parcel weighing at our warehouse.</p>
                            </div>

                            <a href="{{ route('checkout') }}" class="flex items-center justify-center gap-2 w-full py-4 bg-accent text-white font-black rounded-xl hover:bg-accent/90 hover:-translate-y-0.5 transition-all shadow-lg shadow-accent/20 text-base">
                                <span class="material-symbols-outlined text-[20px]">shopping_cart_checkout</span>
                                Proceed to Checkout
                            </a>
                        </div>

                        {{-- Trust badges: desktop only --}}
                        <div class="hidden lg:block space-y-3 px-1">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 shrink-0 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                    <span class="material-symbols-outlined text-[18px]">shield</span>
                                </div>
                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Secure Payments</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 shrink-0 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                    <span class="material-symbols-outlined text-[18px]">payments</span>
                                </div>
                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Transparent Pricing</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 shrink-0 rounded-full bg-purple-100 flex items-center justify-center text-purple-600">
                                    <span class="material-symbols-outlined text-[18px]">location_on</span>
                                </div>
                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Live Shipment Tracking</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- You May Also Like --}}
            <section class="mt-20" x-show="items.length > 0">
                <h3 class="text-2xl font-black text-primary dark:text-white mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-accent">recommend</span>
                    You May Also Like
                </h3>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                    @foreach([
                        ['SonicWave Elite', 'Noise Cancelling Headphones', '$129.99', 'https://lh3.googleusercontent.com/aida-public/AB6AXuD0ZKoTVvlGGOY5Y5NeLREgt662mEJ4TdxkV1ydVGICGoFTcr89EJDYFOleM4n1iBWn9nOIEK3J14cyN93TgmMjtyHajuMcku-nGmGe4iKBkG61vKuEwSmefFsjjOY87M8-gFawqoaiw54rauWvrRBuCgrAtZkSgW_RG228DCS_Mta0kB3bC97jiyfYvcxSAyV2QyCBehZF3yg4QOZObyfjC5JdblJD41Q-PoATv7np2utzfyAXuWj_bZLdefYmeolJm_nK_nKEvtQ', 'sonicwave-elite'],
                        ['AeroRunner Max', 'High Performance Shoes', '$160.00', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCKsM0tMq4_qWif1WrKsSibjgIGBgn6Mrv0WTh4E57YcQpURv3kwnepI2axduIcdgMKp93sHLCAepGBE48An4r6CQxsnJ9aro82shDTQM0vGszn_t9aeD9MVuHcSe8QvvI3a3216q20Q7CMUrTuMC_cFjJk0AqbTEBXzJAIMqt45_LE5zNGw_X8dfO3JTlTcOYt1ge_LhR6FfwzeNIQZxe_n6f-zTFlcFHTJ34-RglME2grKN0kr-F4S0i6GziWgpobXwnccKsj2pc', 'aerorunner-max'],
                        ['Smart Watch Pro 7', 'Premium Smartwatch', '$349.00', 'https://lh3.googleusercontent.com/aida-public/AB6AXuD0ZKoTVvlGGOY5Y5NeLREgt662mEJ4TdxkV1ydVGICGoFTcr89EJDYFOleM4n1iBWn9nOIEK3J14cyN93TgmMjtyHajuMcku-nGmGe4iKBkG61vKuEwSmefFsjjOY87M8-gFawqoaiw54rauWvrRBuCgrAtZkSgW_RG228DCS_Mta0kB3bC97jiyfYvcxSAyV2QyCBehZF3yg4QOZObyfjC5JdblJD41Q-PoATv7np2utzfyAXuWj_bZLdefYmeolJm_nK_nKEvtQ', 'smart-watch-pro'],
                        ['Premium Skincare Set', 'Health & Beauty', '$72.00', 'https://lh3.googleusercontent.com/aida-public/AB6AXuA6bVVrqyRUKhuRrv8FhKGy_2FgfVZJnXPleyglo4LWBVFNUhuOhKljX0MuClnMU9yzBPb777tVi6m2nR47KxWUWG0RLi_jqmdM85UI-9dOYGIPsLl9fhCwdkRdhsGKpqWxgqorxsbCiPEOEYX7tsCfs1KwFU_qPa1oSD2MkmwQfsmNAIDSrQm9HOw6dwmtBq50xwnnmN6e0xwSGi9W49aIO2pdFvD-D5Z2_Az3eAExsNB4c-B7x0DjzoEYftni-WivtygcnO9oiq0', 'premium-skincare'],
                    ] as $rec)
                    <div class="card card-hover overflow-hidden group">
                        <div class="aspect-square bg-slate-50 dark:bg-slate-800 overflow-hidden">
                            <img src="{{ $rec[3] }}" alt="{{ $rec[0] }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-slate-800 dark:text-white text-sm group-hover:text-accent transition-colors">{{ $rec[0] }}</h4>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $rec[1] }}</p>
                            <div class="flex items-center justify-between mt-3">
                                <p class="font-black text-primary dark:text-accent">{{ $rec[2] }}</p>
                                <a href="{{ route('products.show', $rec[4]) }}" class="text-xs font-bold text-accent hover:underline">View →</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

        </div>
    </section>

    {{-- Mobile sticky bottom bar (only when cart has items) --}}
    <div x-data="cart()" x-show="items.length > 0" x-cloak class="fixed bottom-0 inset-x-0 z-40 lg:hidden bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 px-4 py-3 flex items-center gap-4 shadow-2xl">
        <div class="flex-1 min-w-0">
            <p class="text-xs text-slate-400">Total</p>
            <p class="text-xl font-black text-primary dark:text-accent" x-text="'$' + (subtotal() + 15).toFixed(2)"></p>
        </div>
        <a href="{{ route('checkout') }}" class="shrink-0 btn-primary btn-sm px-6 py-3">
            Checkout
        </a>
    </div>
    <div class="h-20 lg:hidden"></div>

@endsection

@section('scripts')
<script>
function cart() {
    return {
        items: @json($cartItems ?? []).map(item => ({
            name:  item.name,
            sku:   item.sku,
            price: parseFloat(item.price),
            qty:   parseInt(item.qty),
            image: item.image,
        })),
        subtotal() {
            return this.items.reduce((sum, item) => sum + item.price * item.qty, 0);
        },
        increment(index) {
            this.items[index].qty++;
        },
        decrement(index) {
            if (this.items[index].qty > 1) {
                this.items[index].qty--;
            } else {
                this.remove(index);
            }
        },
        remove(index) {
            this.items.splice(index, 1);
        }
    }
}
</script>
@endsection
