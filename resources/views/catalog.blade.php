@extends('layouts.public')

@section('title', 'Store Catalog')
@section('meta_description', 'Browse popular products from US, UK, and Malaysian stores available for shipping to Bangladesh.')

@section('content')
    <!-- Hero -->
    <section class="bg-primary py-16 text-white text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-black mb-4">Store Catalog</h1>
            <p class="text-slate-300 text-lg">Explore popular products from thousands of global stores. We'll ship them to your doorstep.</p>
        </div>
    </section>

    <!-- Filters -->
    <section class="sticky top-20 z-30 bg-white dark:bg-background-dark border-b border-slate-200 dark:border-slate-800 py-3">
        <div class="max-w-7xl mx-auto px-4 flex items-center gap-2 overflow-x-auto scrollbar-none pb-0.5">
            <span class="text-xs font-bold text-slate-500 shrink-0 mr-1">Filter:</span>
            @foreach(['All','Electronics','Fashion','Health & Beauty','Sports','Home','Books'] as $filter)
            <button class="shrink-0 px-3 py-1.5 rounded-full text-xs sm:text-sm font-semibold border {{ $loop->first ? 'bg-primary text-white border-primary' : 'border-slate-200 text-slate-600 hover:border-primary hover:text-primary' }} transition-all whitespace-nowrap">{{ $filter }}</button>
            @endforeach
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach([
                    ['Smartphone Pro X', '$999.00', '4.8', 'Electronics', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBrJ4kQpD_Uc1aV2WJns2c_hvGUMxu5HfdiwauUQY_YC_-NszXosavpC-Kqhh7R6dlD6YDvPlTcMuG4t2hC8Sp9llVqv-Hf9VppuRJI6OQMB7uwtbsASN4FVHHl2nEHCztbfrQG9FJnK7Q7X0hxLWnvZBwNPbgPqJfZBGC7wbyMEx5-kC6XlxcroZRgEEkyF-g8yRcPIMN22_Qup2qlnye7Wuko5tsxs4WnATNSoMRcMjV5ckSmGTb3U5hFeoCYCKaoYt29lfjR5q8', 'smartphone-pro-x'],
                    ['Vitality Multi-Vitamins', '$45.50', '4.9', 'Health', 'https://lh3.googleusercontent.com/aida-public/AB6AXuA6bVVrqyRUKhuRrv8FhKGy_2FgfVZJnXPleyglo4LWBVFNUhuOhKljX0MuClnMU9yzBPb777tVi6m2nR47KxWUWG0RLi_jqmdM85UI-9dOYGIPsLl9fhCwdkRdhsGKpqWxgqorxsbCiPEOEYX7tsCfs1KwFU_qPa1oSD2MkmwQfsmNAIDSrQm9HOw6dwmtBq50xwnnmN6e0xwSGi9W49aIO2pdFvD-D5Z2_Az3eAExsNB4c-B7x0DjzoEYftni-WivtygcnO9oiq0', 'vitality-multi-vitamins'],
                    ['SonicWave Elite Headphones', '$129.99', '4.7', 'Electronics', 'https://lh3.googleusercontent.com/aida-public/AB6AXuD0ZKoTVvlGGOY5Y5NeLREgt662mEJ4TdxkV1ydVGICGoFTcr89EJDYFOleM4n1iBWn9nOIEK3J14cyN93TgmMjtyHajuMcku-nGmGe4iKBkG61vKuEwSmefFsjjOY87M8-gFawqoaiw54rauWvrRBuCgrAtZkSgW_RG228DCS_Mta0kB3bC97jiyfYvcxSAyV2QyCBehZF3yg4QOZObyfjC5JdblJD41Q-PoATv7np2utzfyAXuWj_bZLdefYmeolJm_nK_nKEvtQ', 'sonicwave-elite'],
                    ['AeroRunner Max Shoes', '$160.00', '4.6', 'Fashion', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCKsM0tMq4_qWif1WrKsSibjgIGBgn6Mrv0WTh4E57YcQpURv3kwnepI2axduIcdgMKp93sHLCAepGBE48An4r6CQxsnJ9aro82shDTQM0vGszn_t9aeD9MVuHcSe8QvvI3a3216q20Q7CMUrTuMC_cFjJk0AqbTEBXzJAIMqt45_LE5zNGw_X8dfO3JTlTcOYt1ge_LhR6FfwzeNIQZxe_n6f-zTFlcFHTJ34-RglME2grKN0kr-F4S0i6GziWgpobXwnccKsj2pc', 'aerorunner-max'],
                    ['Bluetooth Mechanical Keyboard', '$89.99', '4.5', 'Electronics', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBrJ4kQpD_Uc1aV2WJns2c_hvGUMxu5HfdiwauUQY_YC_-NszXosavpC-Kqhh7R6dlD6YDvPlTcMuG4t2hC8Sp9llVqv-Hf9VppuRJI6OQMB7uwtbsASN4FVHHl2nEHCztbfrQG9FJnK7Q7X0hxLWnvZBwNPbgPqJfZBGC7wbyMEx5-kC6XlxcroZRgEEkyF-g8yRcPIMN22_Qup2qlnye7Wuko5tsxs4WnATNSoMRcMjV5ckSmGTb3U5hFeoCYCKaoYt29lfjR5q8', 'bluetooth-keyboard'],
                    ['Premium Skincare Set', '$72.00', '4.8', 'Health', 'https://lh3.googleusercontent.com/aida-public/AB6AXuA6bVVrqyRUKhuRrv8FhKGy_2FgfVZJnXPleyglo4LWBVFNUhuOhKljX0MuClnMU9yzBPb777tVi6m2nR47KxWUWG0RLi_jqmdM85UI-9dOYGIPsLl9fhCwdkRdhsGKpqWxgqorxsbCiPEOEYX7tsCfs1KwFU_qPa1oSD2MkmwQfsmNAIDSrQm9HOw6dwmtBq50xwnnmN6e0xwSGi9W49aIO2pdFvD-D5Z2_Az3eAExsNB4c-B7x0DjzoEYftni-WivtygcnO9oiq0', 'premium-skincare'],
                    ['Smart Watch Pro 7', '$349.00', '4.9', 'Electronics', 'https://lh3.googleusercontent.com/aida-public/AB6AXuD0ZKoTVvlGGOY5Y5NeLREgt662mEJ4TdxkV1ydVGICGoFTcr89EJDYFOleM4n1iBWn9nOIEK3J14cyN93TgmMjtyHajuMcku-nGmGe4iKBkG61vKuEwSmefFsjjOY87M8-gFawqoaiw54rauWvrRBuCgrAtZkSgW_RG228DCS_Mta0kB3bC97jiyfYvcxSAyV2QyCBehZF3yg4QOZObyfjC5JdblJD41Q-PoATv7np2utzfyAXuWj_bZLdefYmeolJm_nK_nKEvtQ', 'smart-watch-pro'],
                    ['Trail Running Jacket', '$95.00', '4.6', 'Fashion', 'https://lh3.googleusercontent.com/aida-public/AB6AXuCKsM0tMq4_qWif1WrKsSibjgIGBgn6Mrv0WTh4E57YcQpURv3kwnepI2axduIcdgMKp93sHLCAepGBE48An4r6CQxsnJ9aro82shDTQM0vGszn_t9aeD9MVuHcSe8QvvI3a3216q20Q7CMUrTuMC_cFjJk0AqbTEBXzJAIMqt45_LE5zNGw_X8dfO3JTlTcOYt1ge_LhR6FfwzeNIQZxe_n6f-zTFlcFHTJ34-RglME2grKN0kr-F4S0i6GziWgpobXwnccKsj2pc', 'trail-jacket'],
                ] as $product)
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden group hover:shadow-xl transition-shadow">
                    <div class="h-52 bg-slate-50 dark:bg-slate-800 overflow-hidden">
                        <img alt="{{ $product[0] }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300" src="{{ $product[4] }}" />
                    </div>
                    <div class="p-5">
                        <span class="text-xs font-bold text-accent uppercase tracking-wider">{{ $product[3] }}</span>
                        <h3 class="font-bold text-slate-800 dark:text-white mt-1 mb-1">{{ $product[0] }}</h3>
                        <div class="flex items-center gap-1 mb-3">
                            <span class="text-yellow-400 text-sm">★</span>
                            <span class="text-xs text-slate-500">{{ $product[2] }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-xl font-black text-primary dark:text-accent">{{ $product[1] }}</p>
                        </div>
                        <a href="{{ route('products.show', $product[5]) }}" class="block w-full mt-4 py-2.5 bg-primary text-white font-bold rounded-lg text-center hover:bg-primary/90 transition-colors text-sm">Shop Now</a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- CTA -->
            <div class="mt-16 text-center bg-slate-50 dark:bg-slate-800/50 rounded-2xl p-12">
                <h3 class="text-2xl font-bold text-primary dark:text-white mb-4">Can't find what you're looking for?</h3>
                <p class="text-slate-500 mb-8">Use our "Shop For Me" service — just send us the product link and we'll purchase and ship it for you!</p>
                <a href="{{ route('services') }}" class="inline-block bg-accent text-white font-bold px-8 py-4 rounded-lg hover:bg-accent/90 transition-all">Learn About Shop For Me</a>
            </div>
        </div>
    </section>
@endsection
