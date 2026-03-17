@extends('layouts.public')

@section('title', 'Shop Globally, Ship Seamlessly')
@section('meta_description', 'Get your own local shipping address in the US, UK, and Malaysia. Shop from any international store and we\'ll deliver to your doorstep with zero hassle.')

@section('head')
<style>
    .sticky-header { position: sticky; top: 0; z-index: 50; backdrop-filter: blur(8px); background-color: rgba(255,255,255,0.95); }
    .process-line { position: relative; }
    .process-line::after { content: ''; position: absolute; top: 50%; left: 100%; width: 2rem; height: 2px; background-color: #e5e7eb; transform: translateY(-50%); }
    .process-line:last-child::after { display: none; }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-20 pb-24 overflow-hidden bg-gradient-to-b from-blue-50/50 to-white">
        <div class="max-w-[1280px] mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-6xl font-extrabold text-primary leading-[1.1] mb-6">
                    Shop Globally,<br />Ship Seamlessly
                </h1>
                <p class="text-lg text-slate-600 mb-8 max-w-lg leading-relaxed">
                    Get your own local shipping address in the US, UK, and Malaysia. Shop from any international store and we'll deliver to your doorstep with zero hassle.
                </p>
                <div class="flex flex-wrap gap-4 mb-12">
                    <a href="{{ route('calculator') }}" class="bg-accent text-white font-bold px-8 py-4 rounded-lg shadow-lg shadow-orange-200 hover:-translate-y-0.5 transition-all">Get a Quote</a>
                    <a href="{{ route('track-shipment') }}" class="border-2 border-primary text-primary font-bold px-8 py-4 rounded-lg hover:bg-primary hover:text-white transition-all">Track Shipment</a>
                </div>
                <div class="flex items-center gap-6">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Global Warehouses</span>
                    <div class="flex gap-4">
                        <div class="flex items-center gap-2 bg-white px-3 py-1.5 rounded-full border border-gray-200 shadow-sm">
                            <span class="text-xs font-semibold">🇺🇸 USA</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white px-3 py-1.5 rounded-full border border-gray-200 shadow-sm">
                            <span class="text-xs font-semibold">🇬🇧 UK</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white px-3 py-1.5 rounded-full border border-gray-200 shadow-sm">
                            <span class="text-xs font-semibold">🇲🇾 Malaysia</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hero Widget (3-Tab) — fixed height so all tabs are the same size -->
            <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden flex flex-col" style="height:430px">
                <!-- Tab Bar -->
                <div class="flex border-b border-gray-100 shrink-0">
                    <button data-tab="ship" class="tab-btn flex-1 py-4 font-bold text-sm text-primary border-b-2 border-primary transition-colors">Ship</button>
                    <button data-tab="shop" class="tab-btn flex-1 py-4 font-bold text-sm text-slate-400 border-b-2 border-transparent hover:text-primary transition-colors">Shop</button>
                    <button data-tab="track" class="tab-btn flex-1 py-4 font-bold text-sm text-slate-400 border-b-2 border-transparent hover:text-primary transition-colors">Track</button>
                </div>

                <!-- ── Ship Tab ── -->
                <div id="tab-ship" class="tab-panel flex-1 flex flex-col justify-between p-7">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">From (Warehouse)</label>
                            <select class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:ring-primary focus:border-primary">
                                <option>New York, USA</option>
                                <option>London, UK</option>
                                <option>Kuala Lumpur, Malaysia</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Destination (To)</label>
                            <input class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:ring-primary focus:border-primary" placeholder="Enter your city/country" type="text" />
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Product Type</label>
                            <select class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2.5 text-sm focus:ring-primary focus:border-primary">
                                <option>Electronics</option>
                                <option>Clothing &amp; Fashion</option>
                                <option>Health &amp; Beauty</option>
                                <option>General Goods</option>
                            </select>
                        </div>
                    </div>
                    <a href="{{ route('calculator') }}" class="block w-full bg-accent text-white font-extrabold py-3.5 rounded-lg hover:brightness-110 transition-all text-center text-base mt-2">Get Rate</a>
                </div>

                <!-- ── Shop Tab ── -->
                <div id="tab-shop" class="tab-panel hidden flex-1 flex flex-col justify-between p-7">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Paste Product Link</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                </span>
                                <input class="w-full bg-slate-50 border border-slate-200 rounded-lg pl-10 pr-4 py-2.5 text-sm focus:ring-primary focus:border-primary placeholder-slate-400" placeholder="e.g. https://amazon.com/product-name" type="url" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Country to Buy From</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-base">🌐</span>
                                <select class="w-full bg-slate-50 border border-slate-200 rounded-lg pl-10 pr-8 py-2.5 text-sm focus:ring-primary focus:border-primary appearance-none">
                                    <option>United States</option>
                                    <option>United Kingdom</option>
                                    <option>Malaysia</option>
                                </select>
                                <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </span>
                            </div>
                        </div>
                        <!-- Mini steps — fills vertical space -->
                        <div class="flex justify-between gap-2">
                            @foreach(['Send Link','We Buy','We Ship','Delivered'] as $i => $s)
                            <div class="flex-1 text-center">
                                <div class="w-7 h-7 rounded-full bg-yellow-100 text-yellow-700 font-extrabold text-xs flex items-center justify-center mx-auto mb-1">{{ $i+1 }}</div>
                                <span class="text-[10px] font-semibold text-slate-500 leading-tight">{{ $s }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="space-y-3">
                        <a href="{{ route('services') }}" class="flex items-center justify-center gap-2 w-full bg-yellow-400 hover:bg-yellow-300 text-slate-900 font-extrabold py-3.5 rounded-lg transition-all shadow-sm text-base">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            SHOP FOR ME
                        </a>
                        <div class="flex justify-around border-t border-slate-100 pt-2.5">
                            @foreach([['🛡','Secure Payments'],['🌐','Global Delivery'],['💬','24/7 Support']] as $b)
                            <div class="flex items-center gap-1 text-slate-400">
                                <span class="text-sm leading-none">{{ $b[0] }}</span>
                                <span class="text-[9px] font-bold uppercase tracking-wide">{{ $b[1] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- ── Track Tab ── -->
                <div id="tab-track" class="tab-panel hidden flex-1 flex flex-col justify-between p-7">
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs font-bold text-slate-500 mb-1">Enter your GoodsShippers tracking ID</p>
                            <div class="flex gap-2">
                                <div class="relative flex-1">
                                    <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                    </span>
                                    <input id="hero-track-input" class="w-full bg-slate-50 border border-slate-200 rounded-lg pl-10 pr-4 py-2.5 text-sm focus:ring-primary focus:border-primary placeholder-slate-400 font-medium" placeholder="e.g. GS-8823-X920" type="text" />
                                </div>
                                <a id="hero-track-btn" href="{{ route('track-shipment') }}" class="px-5 py-2.5 bg-yellow-400 hover:bg-yellow-300 text-slate-900 font-extrabold rounded-lg whitespace-nowrap transition-all text-sm">Track Now</a>
                            </div>
                        </div>
                        <!-- Example tracking IDs — fills vertical space + signals how ID looks -->
                        <div class="bg-slate-50 rounded-xl p-4">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">Recent Example IDs</p>
                            <div class="space-y-2">
                                @foreach(['GS-8823-X920','GS-4410-B371','GS-6601-K944'] as $ex)
                                <button onclick="document.getElementById('hero-track-input').value='{{ $ex }}'" class="w-full flex items-center justify-between px-3 py-2 bg-white border border-slate-200 rounded-lg hover:border-primary transition-colors group">
                                    <span class="font-mono text-xs font-semibold text-slate-700">{{ $ex }}</span>
                                    <span class="text-[10px] text-primary opacity-0 group-hover:opacity-100 transition-opacity">Use this →</span>
                                </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-around border-t border-slate-100 pt-3">
                        @foreach([['🔄','Real-Time Updates'],['🌍','Global Coverage'],['🛡','Secure Handling']] as $b)
                        <div class="flex items-center gap-1 text-slate-400">
                            <span class="text-sm leading-none">{{ $b[0] }}</span>
                            <span class="text-[9px] font-bold uppercase tracking-wide">{{ $b[1] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-primary">Popular in Global Stores</h2>
                    <p class="text-slate-500 mt-2">Recommended items from USA and UK marketplaces</p>
                </div>
                <a class="text-primary font-bold flex items-center gap-2" href="{{ route('catalog') }}">View All Stores
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach([
                    ['Smartphone Pro X', '$999.00', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBrJ4kQpD_Uc1aV2WJns2c_hvGUMxu5HfdiwauUQY_YC_-NszXosavpC-Kqhh7R6dlD6YDvPlTcMuG4t2hC8Sp9llVqv-Hf9VppuRJI6OQMB7uwtbsASN4FVHHl2nEHCztbfrQG9FJnK7Q7X0hxLWnvZBwNPbgPqJfZBGC7wbyMEx5-kC6XlxcroZRgEEkyF-g8yRcPIMN22_Qup2qlnye7Wuko5tsxs4WnATNSoMRcMjV5ckSmGTb3U5hFeoCYCKaoYt29lfjR5q8', 'smartphone-pro-x'],
                    ['Vitality Multi-Vitamins', '$45.50', 'https://lh3.googleusercontent.com/aida-public/AB6AXuA6bVVrqyRUKhuRrv8FhKGy_2FgfVZJnXPleyglo4LWBVFNUhuOhKljX0MuClnMU9yzBPb777tVi6m2nR47KxWUWG0RLi_jqmdM85UI-9dOYGIPsLl9fhCwdkRdhsGKpqWxgqorxsbCiPEOEYX7tsCfs1KwFU_qPa1oSD2MkmwQfsmNAIDSrQm9HOw6dwmtBq50xwnnmN6e0xwSGi9W49aIO2pdFvD-D5Z2_Az3eAExsNB4c-B7x0DjzoEYftni-WivtygcnO9oiq0', 'vitality-multi-vitamins'],
                    ['SonicWave Elite', '$129.99', 'https://lh3.googleusercontent.com/aida-public/AB6AXuD0ZKoTVvlGGOY5Y5NeLREgt662mEJ4TdxkV1ydVGICGoFTcr89EJDYFOleM4n1iBWn9nOIEK3J14cyN93TgmMjtyHajuMcku-nGmGe4iKBkG61vKuEwSmefFsjjOY87M8-gFawqoaiw54rauWvrRBuCgrAtZkSgW_RG228DCS_Mta0kB3bC97jiyfYvcxSAyV2QyCBehZF3yg4QOZObyfjC5JdblJD41Q-PoATv7np2utzfyAXuWj_bZLdefYmeolJm_nK_nKEvtQ', 'sonicwave-elite'],
                    ['AeroRunner Max', '$160.00', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCKsM0tMq4_qWif1WrKsSibjgIGBgn6Mrv0WTh4E57YcQpURv3kwnepI2axduIcdgMKp93sHLCAepGBE48An4r6CQxsnJ9aro82shDTQM0vGszn_t9aeD9MVuHcSe8QvvI3a3216q20Q7CMUrTuMC_cFjJk0AqbTEBXzJAIMqt45_LE5zNGw_X8dfO3JTlTcOYt1ge_LhR6FfwzeNIQZxe_n6f-zTFlcFHTJ34-RglME2grKN0kr-F4S0i6GziWgpobXwnccKsj2pc', 'aerorunner-max'],
                ] as $product)
                <div class="bg-white p-4 rounded-xl border border-gray-100 hover:shadow-xl transition-shadow group">
                    <div class="h-48 rounded-lg bg-gray-50 mb-4 overflow-hidden">
                        <img alt="{{ $product[0] }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform" src="{{ $product[2] }}" />
                    </div>
                    <h3 class="font-bold text-slate-800">{{ $product[0] }}</h3>
                    <p class="text-primary font-bold text-xl mt-1">{{ $product[1] }}</p>
                    <a href="{{ route('products.show', $product[3]) }}" class="block w-full mt-4 py-2 border border-primary text-primary font-bold rounded-lg hover:bg-primary hover:text-white transition-colors text-center">Shop Now</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-24">
        <div class="max-w-[1280px] mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-primary mb-16">Shipping Made Simple</h2>
            <div class="flex flex-col md:flex-row justify-between items-start gap-12">
                @foreach([
                    ['Shop Overseas', 'Shop your favorite brands from USA, UK or Malaysia stores.', '<path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>'],
                    ['Consolidate', 'Receive items at our hubs and combine packages to save costs.', '<path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>'],
                    ['Express Delivery', 'Fastest shipping options to your doorstep in days.', '<path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>'],
                ] as $step)
                <div class="flex-1 text-center group">
                    <div class="w-20 h-20 bg-blue-50 text-primary rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $step[2] !!}</svg>
                    </div>
                    <h4 class="font-bold text-xl mb-3">{{ $step[0] }}</h4>
                    <p class="text-slate-500 leading-relaxed">{{ $step[1] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Choose Your Solution -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-[1280px] mx-auto px-6">
            <h2 class="text-3xl font-bold text-primary text-center mb-16">Choose Your Solution</h2>
            <div class="space-y-8">
                @foreach([
                    ['Buy For Me', 'We handle the purchase and the shipping for you.', [['Send Link','Step 01'],['Pay Goods','Step 02'],['We Purchase','Step 03'],['Home Delivery','Step 04']]],
                    ['Ship For Me', 'You shop, we ship from our warehouse to you.', [['Get Address','Step 01'],['Shop Online','Step 02'],['Consolidate','Step 03'],['Ship Home','Step 04']]],
                    ['Bulk Shipment', 'Large volume logistics for businesses.', [['Quote Inquiry','Step 01'],['Cargo Pickup','Step 02'],['Customs Clear','Step 03'],['Port to Port','Step 04']]],
                ] as $solution)
                <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm flex flex-col xl:flex-row gap-8 items-center">
                    <div class="xl:w-1/4">
                        <h3 class="text-2xl font-bold text-primary mb-2">{{ $solution[0] }}</h3>
                        <p class="text-slate-500 text-sm">{{ $solution[1] }}</p>
                    </div>
                    <div class="flex-1 grid grid-cols-2 md:grid-cols-4 gap-4 w-full">
                        @foreach($solution[2] as $step)
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <span class="text-xs font-bold text-primary block mb-1">{{ $step[1] }}</span>
                            <span class="text-sm font-medium">{{ $step[0] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Strategic Hubs -->
    <section class="py-24">
        <div class="max-w-[1280px] mx-auto px-6">
            <h2 class="text-3xl font-bold text-primary mb-12">Our Strategic Hubs</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                    ['London, UK','https://lh3.googleusercontent.com/aida-public/AB6AXuCj_ZdpPZzsI-XzzAcckD3G3tgY91MFnsK-8oS89HY4mKmOtbcW_36wG3Q1_24-zt1O1zPdVFz7cLdcfw6aunbg_M9-rF85y_7_4u6WGlU7wuU9qSJcj3eYfDRvOsLNvXFYVXwyrw2dIVMElt1YQMVKMpvKQBJ0OLp2vqunwNvRKqR7Od5s5DJjbw6CGXDRXqWVd4Xo8e4Kvo493D0Ta5giZtc81EWPK3O7vnhIMfTdKEHXaP_b6rWPSgdxvADIAQynUvFxIXdDDwM','Twice Weekly','3-5 Days','4-6 Weeks', 'uk'],
                    ['New York, USA','https://lh3.googleusercontent.com/aida-public/AB6AXuAmdALwUQnN8yUFRHSDfTd3c-FZQELvZJkby8QU8e5zoxuerK5T5C95yQi-daMb3jAWeFYQqg0FJVgkHqOpABUXlAJTgLLYh7uzWOu0RAjhNbUSgC-exqAilHl_AAp1h5PvSy9fdP6U2UKfJHhTl_Kr4VG1DEo2vH-v6hJZVPYoBEyE3XQVpVHnRjGPbn8j-cOtOnfZ3_2nk_BsodU2xVtOHuH3sQqm6evca0jEdFJlyc3oM4TZhlsPRI5BzojDckErz07dI9qqB30','Daily Flights','5-7 Days','6-8 Weeks','usa'],
                    ['Kuala Lumpur, MY','https://lh3.googleusercontent.com/aida-public/AB6AXuBTteBAFqh-QyGqKHZ9dt0zMCb5QnjIKnemxMQ8xwnKdY_jZ8qnsHMosVoe-E_cF9IlWSbUTtzLlqHrUJGpXZERAdiir9tuschEPTYGzMPdZSxfamFFT_PjvuejO7_xBvNTcyecniVyJNFdeKEpZB_Wc4s0I2x66pzipxejJuNQKuXUa11wIbFMfmOm2WrPsavstS10j8j-AmpmtNvXGP7aaclG6wnPztxneN2nkrQ_qTSj8vBSyntYhoeaybaLHM96Kue15qS_N1A','Weekly','4-6 Days','2-3 Weeks','malaysia'],
                ] as $hub)
                <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                    <img alt="{{ $hub[0] }} Hub" class="w-full h-48 object-cover" src="{{ $hub[1] }}" />
                    <div class="p-6">
                        <h3 class="font-bold text-xl text-primary mb-4">{{ $hub[0] }}</h3>
                        <div class="space-y-3 text-sm text-slate-600 mb-6">
                            <div class="flex justify-between"><span>Frequency:</span> <span class="font-semibold text-slate-900">{{ $hub[2] }}</span></div>
                            <div class="flex justify-between"><span>Air Freight:</span> <span class="font-semibold text-slate-900">{{ $hub[3] }}</span></div>
                            <div class="flex justify-between"><span>Sea Freight:</span> <span class="font-semibold text-slate-900">{{ $hub[4] }}</span></div>
                        </div>
                        <a class="text-primary font-bold text-sm underline" href="{{ route('warehouses.' . $hub[5]) }}">Learn More</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pricing Transparency -->
    <section class="py-24 bg-primary text-white">
        <div class="max-w-[1280px] mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl font-bold mb-6">No Hidden Fees. Ever.</h2>
                <p class="text-blue-100 text-lg mb-10 leading-relaxed">We believe in honest pricing. Our rates are calculated based on actual or volumetric weight, whichever is higher, following industry standards.</p>
                <div class="bg-blue-900/50 p-6 rounded-2xl border border-blue-800">
                    <h4 class="font-bold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                        Volumetric Formula
                    </h4>
                    <div class="text-2xl font-mono text-center bg-primary p-4 rounded-lg">(L × W × H) ÷ 5000 = KG</div>
                    <p class="text-xs text-blue-300 mt-4 text-center">Dimensions in centimeters (cm)</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-8 text-slate-900 shadow-2xl">
                <h4 class="font-bold text-xl mb-6 border-b pb-4 border-gray-100">Sample Cost Breakdown</h4>
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between text-sm"><span class="text-slate-500">Shipping (2.5kg from USA)</span><span class="font-semibold">$35.00</span></div>
                    <div class="flex justify-between text-sm"><span class="text-slate-500">Consolidation Fee</span><span class="font-semibold">FREE</span></div>
                    <div class="flex justify-between text-sm"><span class="text-slate-500">Insurance (Optional)</span><span class="font-semibold">$5.00</span></div>
                    <div class="flex justify-between text-sm"><span class="text-slate-500">Handling Fee</span><span class="font-semibold">$2.50</span></div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg border-2 border-dashed border-gray-200">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-slate-600">Total Estimate</span>
                        <span class="text-3xl font-extrabold text-primary">$42.50</span>
                    </div>
                </div>
                <a href="{{ route('calculator') }}" class="block w-full mt-6 bg-accent text-white font-bold py-4 rounded-lg hover:brightness-110 transition-all text-center">Calculate My Package</a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-24 bg-white">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                    ['Lower Cost','Up to 70% cheaper than direct international shipping rates through our volume discounts.', '<path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>'],
                    ['Faster Processing','Same-day package intake and rapid dispatch cycles from all our global warehouse locations.', '<path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>'],
                    ['Full Transparency','Real-time tracking and zero hidden surcharges. What you see is exactly what you pay.', '<path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>'],
                ] as $feat)
                <div class="p-8 rounded-2xl bg-white border border-gray-100 shadow-sm text-center">
                    <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $feat[2] !!}</svg>
                    </div>
                    <h3 class="font-bold text-xl mb-4 text-primary">{{ $feat[0] }}</h3>
                    <p class="text-slate-500 leading-relaxed">{{ $feat[1] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-[1280px] mx-auto px-6 text-center">
            <h2 class="text-4xl font-extrabold text-primary mb-6">Ready to Start Importing?</h2>
            <p class="text-slate-600 text-lg mb-10 max-w-2xl mx-auto">Join 50,000+ shoppers who trust GoodsShippers for their international logistics needs.</p>
            <a href="{{ route('register') }}" class="inline-block bg-primary text-white font-extrabold px-10 py-5 rounded-lg text-lg shadow-xl hover:scale-105 transition-all">Create Free Account Today</a>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Hero widget tab switching
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('.tab-panel');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const target = btn.dataset.tab;

            // Reset all tabs
            tabBtns.forEach(b => {
                b.classList.remove('text-primary', 'border-primary');
                b.classList.add('text-slate-400', 'border-transparent');
            });
            tabPanels.forEach(p => p.classList.add('hidden'));

            // Activate clicked tab
            btn.classList.add('text-primary', 'border-primary');
            btn.classList.remove('text-slate-400', 'border-transparent');
            document.getElementById('tab-' + target).classList.remove('hidden');
        });
    });

    // Track Now — append tracking number to URL
    document.getElementById('hero-track-btn').addEventListener('click', function (e) {
        const val = document.getElementById('hero-track-input').value.trim();
        if (val) {
            e.preventDefault();
            window.location.href = '{{ route('track-shipment') }}?tracking=' + encodeURIComponent(val);
        }
    });
    document.getElementById('hero-track-input').addEventListener('keydown', function (e) {
        if (e.key === 'Enter') document.getElementById('hero-track-btn').click();
    });
</script>
@endsection
