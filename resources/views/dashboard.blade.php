<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
        <!-- Stat Card 1 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 flex flex-col justify-between hover:shadow-lg transition-all duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Active Shop For Me</p>
                    <p class="text-4xl font-black text-gray-900 tracking-tight">{{ auth()->user()->orders()->whereNotIn('status', ['cancelled', 'delivered'])->count() ?? 0 }}</p>
                </div>
                <div class="p-3.5 bg-blue-100/80 rounded-2xl border border-blue-200 text-blue-600 shadow-sm group-hover:-translate-y-1 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
            <div class="mt-8 relative z-10">
                <a href="{{ route('orders.index') }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors group-hover:underline decoration-blue-300 underline-offset-4">
                    Manage Orders 
                    <svg class="ml-1.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 flex flex-col justify-between hover:shadow-lg transition-all duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Parcels Received</p>
                    <p class="text-4xl font-black text-gray-900 tracking-tight">{{ auth()->user()->parcels()->whereIn('status', ['arrived', 'stored', 'ready_for_shipment'])->count() ?? 0 }}</p>
                </div>
                <div class="p-3.5 bg-indigo-100/80 rounded-2xl border border-indigo-200 text-indigo-600 shadow-sm group-hover:-translate-y-1 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>
            <div class="mt-8 relative z-10">
                <a href="{{ route('parcels.index') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors group-hover:underline decoration-indigo-300 underline-offset-4">
                    View Parcels
                    <svg class="ml-1.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 flex flex-col justify-between hover:shadow-lg transition-all duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-emerald-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">In-Transit</p>
                    <p class="text-4xl font-black text-gray-900 tracking-tight">{{ auth()->user()->shipments()->whereIn('status', ['in_transit', 'customs_clearance', 'out_for_delivery'])->count() ?? 0 }}</p>
                </div>
                <div class="p-3.5 bg-emerald-100/80 rounded-2xl border border-emerald-200 text-emerald-600 shadow-sm group-hover:-translate-y-1 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
            </div>
            <div class="mt-8 relative z-10">
                <a href="{{ route('shipments.index') }}" class="inline-flex items-center text-sm font-semibold text-emerald-600 hover:text-emerald-800 transition-colors group-hover:underline decoration-emerald-300 underline-offset-4">
                    Track Shipments
                    <svg class="ml-1.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 flex flex-col justify-between hover:shadow-lg transition-all duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-rose-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Unpaid Balance</p>
                    <p class="text-3xl font-black text-rose-600 tracking-tight mt-1">{{ number_format(auth()->user()->invoices()->whereIn('status', ['draft', 'sent'])->sum('total_amount'), 2) }} <span class="text-sm font-semibold text-rose-400">BDT</span></p>
                </div>
                <div class="p-3.5 bg-rose-100/80 rounded-2xl border border-rose-200 text-rose-600 shadow-sm group-hover:-translate-y-1 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
            <div class="mt-6 relative z-10">
                <a href="{{ route('invoices.index') }}" class="inline-flex items-center text-sm font-semibold text-rose-600 hover:text-rose-800 transition-colors group-hover:underline decoration-rose-300 underline-offset-4">
                    Pay Now
                    <svg class="ml-1.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="mt-10 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/80 flex justify-between items-center">
            <h3 class="font-bold text-lg text-gray-900 tracking-tight">Recent Activity Feed</h3>
        </div>
        <div class="p-8">
            @php
                $recentLogs = \App\Models\StatusLog::where(function($q) {
                    $q->whereHasMorph('loggable', [\App\Models\Order::class, \App\Models\Parcel::class, \App\Models\Shipment::class, \App\Models\Invoice::class], function($morphQ) {
                        $morphQ->where('user_id', auth()->id());
                    });
                })->latest()->take(5)->get();
            @endphp

            @if($recentLogs->count() > 0)
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @foreach($recentLogs as $log)
                            <li>
                                <div class="relative pb-8">
                                    @if(!$loop->last)
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-4">
                                        <div>
                                            <span class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white
                                                {{ $log->loggable_type === \App\Models\Order::class ? 'bg-blue-100 text-blue-600' : '' }}
                                                {{ $log->loggable_type === \App\Models\Parcel::class ? 'bg-indigo-100 text-indigo-600' : '' }}
                                                {{ $log->loggable_type === \App\Models\Shipment::class ? 'bg-emerald-100 text-emerald-600' : '' }}
                                                {{ $log->loggable_type === \App\Models\Invoice::class ? 'bg-rose-100 text-rose-600' : '' }}
                                            ">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">
                                                    {{ class_basename($log->loggable_type) }} #{{ $log->loggable_id }} update: 
                                                    <span class="font-bold uppercase tracking-wider text-[11px] 
                                                        {{ str_starts_with($log->status, 'cancelled') || str_starts_with($log->status, 'reject') ? 'text-rose-600' : 'text-indigo-600' }}">
                                                        {{ str_replace('_', ' ', $log->status) }}
                                                    </span>
                                                </p>
                                                @if($log->note)
                                                    <p class="text-sm text-gray-500 mt-1">{{ $log->note }}</p>
                                                @endif
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-400 font-medium">
                                                <time datetime="{{ $log->created_at }}">{{ $log->created_at->diffForHumans() }}</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="text-center py-12 px-6 rounded-xl border-2 border-dashed border-gray-200 bg-gray-50/50">
                    <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    <p class="text-base font-semibold text-gray-900 tracking-tight">No activity yet</p>
                    <p class="mt-2 text-sm text-gray-500 max-w-sm mx-auto">When your orders, parcels, or shipments receive updates, you'll see a timeline of activity here.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
