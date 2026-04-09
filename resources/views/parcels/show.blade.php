<x-app-layout>
    <x-slot name="header">Parcel Details - {{ $parcel->tracking_number }}</x-slot>

    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('parcels.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
            <svg class="mr-2 w-5 h-5 flex-shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Parcels
        </a>
        <span class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full 
            {{ in_array($parcel->status, ['arrived', 'stored']) ? 'bg-indigo-100 text-indigo-700' : '' }}
            {{ $parcel->status === 'damaged' ? 'bg-rose-100 text-rose-700' : '' }}
            {{ $parcel->status === 'ready_for_shipment' ? 'bg-emerald-100 text-emerald-700' : '' }}
            {{ $parcel->status === 'shipped' ? 'bg-blue-100 text-blue-700' : '' }}
        ">
            {{ ucwords(str_replace('_', ' ', $parcel->status)) }}
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Details & Photos -->
        <div class="lg:col-span-2 space-y-8">
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/80 flex items-center gap-3">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <h3 class="text-lg font-bold text-gray-900 tracking-tight">Package Dimensions & Info</h3>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-1">Carrier Tracking</p>
                        <p class="text-base font-bold text-gray-900">{{ $parcel->tracking_number }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-1">Location</p>
                        <p class="text-base font-bold text-gray-900">{{ $parcel->warehouse->name ?? 'Unknown' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-1">Weight</p>
                        <p class="text-base font-bold text-gray-900">{{ $parcel->weight ? $parcel->weight . ' kg' : 'Pending' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-1">Dimensions (L × W × H)</p>
                        <p class="text-base font-bold text-gray-900">
                            @if($parcel->length && $parcel->width && $parcel->height)
                                {{ $parcel->length }} × {{ $parcel->width }} × {{ $parcel->height }} cm
                            @else
                                <span class="text-gray-400 font-medium italic">Pending</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-1">Condition</p>
                        <p class="text-base font-bold {{ strtolower($parcel->condition) === 'damaged' ? 'text-rose-600' : 'text-gray-900' }}">
                            {{ $parcel->condition ?? 'Good' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-1">Arrival Date</p>
                        <p class="text-base font-bold text-gray-900">{{ $parcel->arrival_date ? \Carbon\Carbon::parse($parcel->arrival_date)->format('M j, Y') : 'Pending' }}</p>
                    </div>
                </div>
                @if($parcel->notes)
                    <div class="px-6 py-5 border-t border-gray-100 bg-amber-50/50">
                        <p class="text-sm font-semibold text-amber-800 uppercase tracking-wider mb-1">Warehouse Notes</p>
                        <p class="text-sm text-gray-700">{{ $parcel->notes }}</p>
                    </div>
                @endif
            </div>

            <!-- Parcel Photos (Alpine Lightbox) -->
            <div x-data="{ imgModal: false, imgSrc: '', imgDesc: '' }" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/80 flex items-center gap-3">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <h3 class="text-lg font-bold text-gray-900 tracking-tight">Inspection Photos</h3>
                </div>
                <div class="p-6">
                    @if($parcel->photos && $parcel->photos->count() > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach($parcel->photos as $photo)
                                <div class="group relative aspect-square bg-gray-100 rounded-xl overflow-hidden cursor-pointer shadow-sm border border-gray-200"
                                     @click="imgModal = true; imgSrc = '{{ asset('storage/' . $photo->file_path) }}'; imgDesc = {{ json_encode($photo->caption) }}">
                                    <img src="{{ asset('storage/' . $photo->file_path) }}" alt="{{ $photo->caption }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-sm font-medium text-gray-500">No inspection photos have been uploaded for this package yet.</p>
                        </div>
                    @endif
                </div>

                <!-- Lightbox Modal -->
                <template x-teleport="body">
                    <div x-show="imgModal" x-transition.opacity.duration.300ms class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-sm" style="display: none;">
                        <button @click="imgModal = false" class="absolute top-6 right-6 text-white/70 hover:text-white focus:outline-none transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                        <div class="max-w-4xl w-full flex flex-col items-center">
                            <img :src="imgSrc" class="max-h-[80vh] w-auto rounded-lg shadow-2xl" @click.away="imgModal = false">
                            <p x-show="imgDesc" x-text="imgDesc" class="mt-4 text-white text-center text-lg font-medium"></p>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Right Column: Status Timeline -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-28">
                <h3 class="text-lg font-bold text-gray-900 tracking-tight border-b border-gray-100 pb-4 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Parcel History
                </h3>
                
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @foreach($parcel->statusLogs()->orderBy('created_at', 'desc')->get() as $log)
                            <li>
                                <div class="relative pb-8">
                                    @if(!$loop->last)
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white
                                                {{ $loop->first ? 'bg-indigo-600' : 'bg-gray-200' }}
                                            ">
                                                <div class="w-3 h-3 {{ $loop->first ? 'bg-indigo-100' : 'bg-gray-400' }} rounded-full"></div>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm font-bold {{ $loop->first ? 'text-gray-900' : 'text-gray-600' }}">
                                                    {{ ucwords(str_replace('_', ' ', $log->status)) }}
                                                </p>
                                                @if($log->note)
                                                    <p class="text-sm text-gray-500 mt-1">{{ $log->note }}</p>
                                                @endif
                                            </div>
                                            <div class="text-right text-xs whitespace-nowrap font-medium {{ $loop->first ? 'text-indigo-600' : 'text-gray-400' }}">
                                                <time datetime="{{ $log->created_at }}">{{ $log->created_at->format('M j\n h:i A') }}</time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
