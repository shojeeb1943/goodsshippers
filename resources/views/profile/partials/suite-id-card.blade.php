<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __('Your Shipping Identity') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 font-medium">
            {{ __("This Suite ID belongs uniquely to you. When shopping online, always include this ID in the shipping address at our warehouses.") }}
        </p>
    </header>

    <div class="bg-indigo-600 rounded-2xl p-6 text-white shadow-lg shadow-indigo-100 relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute -right-6 -bottom-6 opacity-10">
            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
        </div>
        
        <div class="relative z-10">
            <p class="text-xs font-bold uppercase tracking-widest text-indigo-200 mb-1">Your Forwarding Suite ID</p>
            <h3 class="text-4xl font-black tracking-tighter">{{ $user->warehouse_suite_id }}</h3>
            <div class="mt-6 flex flex-wrap gap-4">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl px-4 py-3 border border-white/10">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-indigo-100 mb-1">Status</p>
                    <p class="text-sm font-bold">{{ ucwords($user->status ?? 'Active') }}</p>
                </div>
                @if($user->warehouse_id)
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl px-4 py-3 border border-white/10">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-indigo-100 mb-1">Assigned Warehouse</p>
                        <p class="text-sm font-bold">{{ $user->assignedWarehouse->name ?? 'Primary' }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-amber-50 rounded-xl p-5 border border-amber-100 flex gap-4 items-start">
        <div class="bg-amber-100 p-2 rounded-lg text-amber-600 flex-shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <div>
            <h4 class="text-sm font-bold text-amber-900">How to use your Suite ID?</h4>
            <p class="text-xs text-amber-800 mt-1 leading-relaxed font-medium">When you shop on websites like Amazon, eBay, or Walmart, add your Suite ID as part of your name or address line 2. Example: <br><span class="inline-block mt-2 font-black border-b border-amber-300">John Doe {{ $user->warehouse_suite_id }}</span></p>
        </div>
    </div>
</section>
