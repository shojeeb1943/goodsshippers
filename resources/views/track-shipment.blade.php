@extends('layouts.public')

@section('title', 'Track Your Shipment')
@section('meta_description', 'Enter your GoodsShippers tracking number to see the real-time location and status of your parcel.')

@section('content')
    <!-- Hero -->
    <section class="bg-primary py-16 text-white text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-black mb-4">Track Your Shipment</h1>
            <p class="text-slate-300 text-lg">Enter your tracking number below for real-time shipment updates.</p>
            <div class="mt-8 flex flex-col sm:flex-row gap-3 max-w-xl mx-auto">
                <input id="track-input" class="flex-1 h-14 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 px-5 focus:ring-accent focus:border-accent text-lg" placeholder="GS-XXXX-XXXX" type="text" />
                <button id="track-btn" class="px-8 h-14 bg-accent text-white font-bold rounded-xl hover:bg-accent/90 transition-all shadow-lg">Track</button>
            </div>
        </div>
    </section>

    <!-- Result Area -->
    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Demo Result -->
            <div id="track-result" class="hidden">
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="bg-primary/5 dark:bg-slate-800 p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Tracking Number</p>
                            <p id="display-tracking" class="text-xl font-mono font-bold text-primary dark:text-white">GS-8823-X920</p>
                        </div>
                        <span class="px-4 py-2 bg-blue-100 text-blue-700 font-bold text-sm rounded-full">In Transit</span>
                    </div>

                    <div class="p-6 grid sm:grid-cols-3 gap-6 border-b border-slate-100 dark:border-slate-800">
                        <div><p class="text-xs text-slate-500 mb-1">From</p><p class="font-bold">New York, USA</p></div>
                        <div><p class="text-xs text-slate-500 mb-1">To</p><p class="font-bold">Dhaka, Bangladesh</p></div>
                        <div><p class="text-xs text-slate-500 mb-1">Est. Delivery</p><p class="font-bold text-primary">Oct 25, 2023</p></div>
                    </div>

                    <div class="p-8">
                        <h3 class="font-bold text-xl text-primary dark:text-white mb-8">Shipment Timeline</h3>
                        <div class="relative">
                            <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-slate-200 dark:bg-slate-800"></div>
                            <div class="space-y-8">
                                @foreach([
                                    ['check','green-500','Product Requested','Oct 12, 2023 – 09:45 AM','Order received and assigned to our team.','completed'],
                                    ['check','green-500','Arrived at Warehouse','Oct 14, 2023 – 02:20 PM','Package received at New Jersey facility.','completed'],
                                    ['check','green-500','Ready for Shipment','Oct 15, 2023 – 11:00 AM','Package verified, labeled, and ready for dispatch.','completed'],
                                    ['radio_button_checked','primary','In Transit','Oct 16, 2023 – Ongoing','On the way to Dhaka, Bangladesh via air freight.','active'],
                                    ['radio_button_unchecked','slate-300','Customs Clearance','Pending','Awaiting clearance at Dhaka customs.','pending'],
                                    ['radio_button_unchecked','slate-300','Out for Delivery','Pending','—','pending'],
                                    ['radio_button_unchecked','slate-300','Delivered','Pending','—','pending'],
                                ] as $event)
                                <div class="flex gap-6 {{ $event[5] === 'pending' ? 'opacity-40' : '' }}">
                                    <div class="size-10 rounded-full {{ $event[5] === 'completed' ? 'bg-green-500' : ($event[5] === 'active' ? 'bg-primary' : 'bg-slate-200 dark:bg-slate-700') }} flex items-center justify-center text-white z-10 shrink-0">
                                        <span class="material-symbols-outlined text-[18px]">{{ $event[0] }}</span>
                                    </div>
                                    <div class="pt-1.5">
                                        <p class="font-bold {{ $event[5] === 'active' ? 'text-primary' : 'text-slate-800 dark:text-white' }}">{{ $event[2] }}</p>
                                        <p class="text-xs text-slate-500 mt-0.5">{{ $event[3] }}</p>
                                        @if($event[4] !== '—')
                                        <p class="text-sm text-slate-600 dark:text-slate-400 mt-2">{{ $event[4] }}</p>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div id="track-empty" class="text-center py-16">
                <div class="w-24 h-24 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-slate-400 text-5xl">search</span>
                </div>
                <h3 class="text-xl font-bold text-slate-600 dark:text-slate-300 mb-2">Enter Your Tracking Number</h3>
                <p class="text-slate-400 text-sm max-w-sm mx-auto">Type your GoodsShippers tracking ID above and click Track to see your shipment status.</p>
            </div>

            <!-- Register CTA -->
            <div class="mt-12 bg-primary/5 dark:bg-slate-800/50 rounded-2xl p-8 flex flex-col sm:flex-row items-center gap-6 justify-between">
                <div>
                    <h4 class="font-bold text-lg text-primary dark:text-white">Don't have a tracking number yet?</h4>
                    <p class="text-slate-500 text-sm mt-1">Create a free account to get your suite ID and start shipping today.</p>
                </div>
                <a href="{{ route('register') }}" class="shrink-0 px-8 py-3 bg-primary text-white font-bold rounded-lg hover:bg-primary/90 transition-all">Register Free</a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.getElementById('track-btn').addEventListener('click', () => {
        const val = document.getElementById('track-input').value.trim();
        if (!val) return;
        document.getElementById('display-tracking').textContent = val;
        document.getElementById('track-result').classList.remove('hidden');
        document.getElementById('track-empty').classList.add('hidden');
    });
    document.getElementById('track-input').addEventListener('keydown', (e) => {
        if (e.key === 'Enter') document.getElementById('track-btn').click();
    });
</script>
@endsection
