@extends('layouts.public')

@section('title', 'Our Global Warehouses')
@section('meta_description', 'GoodsShippers operates warehouses in USA, UK, and Malaysia to bring your favorite international products to Bangladesh.')

@section('content')
    <!-- Hero -->
    <section class="bg-primary py-20 text-white">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-5xl md:text-6xl font-black mb-6">Our Global Warehouse Network</h1>
            <p class="text-slate-300 text-lg max-w-2xl mx-auto">Strategically located receiving hubs in the USA, UK, and Malaysia, designed for fast and affordable shipping to Bangladesh.</p>
            <div class="flex flex-wrap justify-center gap-4 mt-10">
                <a href="{{ route('warehouses.usa') }}" class="px-6 py-3 bg-white/10 border border-white/20 rounded-lg font-bold hover:bg-white/20 transition-all">🇺🇸 USA Warehouse</a>
                <a href="{{ route('warehouses.uk') }}" class="px-6 py-3 bg-white/10 border border-white/20 rounded-lg font-bold hover:bg-white/20 transition-all">🇬🇧 UK Warehouse</a>
                <a href="{{ route('warehouses.malaysia') }}" class="px-6 py-3 bg-white/10 border border-white/20 rounded-lg font-bold hover:bg-white/20 transition-all">🇲🇾 Malaysia Warehouse</a>
            </div>
        </div>
    </section>

    <!-- Warehouse Cards -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8">
                @foreach([
                    ['London, UK','https://lh3.googleusercontent.com/aida-public/AB6AXuD4Lx1xKX2xQ9v9wize1nXPl0YeEnMTbHNE_MbBEh8-ru5-1o657l0tQOq_pLlNf80X3wNx4LkaG0xlt1HvczFy-njX_KNb_Ok7NL-ExmDyYZLiuJHDV0Fe2-ntSIiyNM23IYQEp_7lRqLGLAx9zn5ynXDlCYqVFCh5wu5rvuxXskihZHP0NHmDz7nQpBlrWWhbNh6Vmr76HV7KbweZWpesfAN0ibQFwt1OfgO0CDGX3ighHu9BdrWWDttOVhUJrZHypojY3aIXv5g','2x Weekly','7-10 Days','30 Days Free','uk'],
                    ['New York, USA','https://lh3.googleusercontent.com/aida-public/AB6AXuDhU3VgJ1I4TKasWv6uhg4wZYooB70zwTuwb4ebDGfv1foCqoYzgbeuggXqphotFSTkElp9kUVz4dpskBW0E7KHlk1hzjiAPm7na9Uj5bqyP9M4m_rYQMqoe7nVqsBOiV_LmB05ia389RFtPmatf3tIoC3WIztfDF4Ek1xiVHaM9FIDlZcbJLYojOhJ9_mdVGqmaqMDit-HLmHbFyKNB4Qg4DKKf3ucfvp029CRqdl1CBUTDJUhXRMZQssv4WoYC5xYE2F82MkYowg','3x Weekly','5-9 Days','21 Days Free','usa'],
                    ['Kuala Lumpur, MY','https://lh3.googleusercontent.com/aida-public/AB6AXuBCIdaW_kPO5aAZsZoq1QateSWnCCKhy2UyfOxzlPMWRgszVwlaX5R4FBQSuTVo7yg6_wvoftfo99DO51SY3HAFy3RdJovJhqfTIuSFMo3C0rAHF-l2yjmJGGDuU1LVp1Fc93_7AJmHJrrTYw0BhkSLrh2n-Q7vp0M83B8jMkgcb2rOz2QX82lvgnvuijRwcsuQa0kGKC-vzkxFoCY1nJM0sYnOOQIyEk3gfGdqbbRqp_KHVzK97aBs1loU6nz-cGgiNeZzSWt9iMc','Daily','3-5 Days','14 Days Free','malaysia'],
                ] as $hub)
                <div class="bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-sm border border-slate-100 dark:border-slate-700 group hover:shadow-xl transition-shadow">
                    <div class="h-48 relative">
                        <img alt="{{ $hub[0] }}" class="w-full h-full object-cover" src="{{ $hub[1] }}" />
                        <div class="absolute inset-0 bg-primary/20"></div>
                        <div class="absolute bottom-4 left-4">
                            <h3 class="text-white font-bold text-xl">{{ $hub[0] }}</h3>
                        </div>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between text-sm"><span class="text-slate-500">Frequency:</span><span class="font-bold">{{ $hub[2] }}</span></div>
                        <div class="flex justify-between text-sm"><span class="text-slate-500">Delivery Time:</span><span class="font-bold">{{ $hub[3] }}</span></div>
                        <div class="flex justify-between text-sm"><span class="text-slate-500">Storage:</span><span class="font-bold">{{ $hub[4] }}</span></div>
                        <a href="{{ route('warehouses.' . $hub[5]) }}" class="block w-full text-center mt-4 py-2 border border-primary text-primary font-bold rounded-lg hover:bg-primary hover:text-white transition-colors">View Details</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Handling Process -->
    <section class="py-20 bg-slate-50 dark:bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-primary dark:text-white mb-16">Our Package Handling Process</h2>
            <div class="relative">
                <div class="hidden md:block absolute top-7 left-0 w-full h-0.5 bg-slate-200 dark:bg-slate-800"></div>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-6 relative z-10">
                    @foreach([
                        ['inbox','Receive','Package arrives at our hub.'],
                        ['fact_check','Inspect','We verify contents and condition.'],
                        ['straighten','Measure','Weight and dimensions recorded.'],
                        ['photo_camera','Photo','Pics uploaded to your dashboard.'],
                        ['lock','Store','Secure storage until dispatch.'],
                    ] as $step)
                    <div class="text-center">
                        <div class="size-14 bg-white dark:bg-slate-900 border-2 border-primary/20 rounded-full flex items-center justify-center text-primary mx-auto mb-4 shadow-sm">
                            <span class="material-symbols-outlined">{{ $step[0] }}</span>
                        </div>
                        <h4 class="font-bold text-primary dark:text-white mb-1">{{ $step[1] }}</h4>
                        <p class="text-xs text-slate-500">{{ $step[2] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison Table -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-primary dark:text-white mb-16">Warehouse Feature Comparison</h2>
            <div class="overflow-x-auto rounded-2xl shadow border border-slate-200 dark:border-slate-800">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th class="p-5 text-left">Feature</th>
                            <th class="p-5 text-center">🇺🇸 USA</th>
                            <th class="p-5 text-center">🇬🇧 UK</th>
                            <th class="p-5 text-center">🇲🇾 Malaysia</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach([
                            ['Free Storage Period', '21 days', '30 days', '14 days'],
                            ['Photo Service', 'Included', 'Included', 'Included'],
                            ['Air Shipping', '✓', '✓', '✓'],
                            ['Sea Shipping', '✓', '✓', '✓'],
                            ['Consolidation', '✓', '✓', '✓'],
                            ['Special Care Handling', 'Limited', '✓', 'Limited'],
                        ] as $row)
                        <tr class="bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800/50">
                            <td class="p-5 font-medium text-slate-700 dark:text-slate-300">{{ $row[0] }}</td>
                            @foreach(array_slice($row, 1) as $val)
                            <td class="p-5 text-center font-semibold">{{ $val }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
