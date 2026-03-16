<x-app-layout>
    <x-slot name="header">My Parcels</x-slot>

    <div class="mb-6">
        <h3 class="text-lg font-bold text-gray-900 tracking-tight">Parcels at Warehouse</h3>
        <p class="text-sm text-gray-500 mt-1">Track the received packages under your Suite ID.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($parcels->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/80">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tracking / Carrier</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Location</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Arrival Date</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="relative px-6 py-4">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($parcels as $parcel)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm font-semibold text-gray-900">{{ $parcel->tracking_number }}</p>
                                    @if($parcel->weight)
                                        <p class="text-xs text-gray-500 mt-0.5">Weight: {{ $parcel->weight }} kg</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center text-sm text-gray-900">
                                        <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $parcel->warehouse->name ?? 'Unknown' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $parcel->arrival_date ? \Carbon\Carbon::parse($parcel->arrival_date)->format('M j, Y') : 'Pending' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full 
                                        {{ in_array($parcel->status, ['arrived', 'stored']) ? 'bg-indigo-100 text-indigo-700' : '' }}
                                        {{ $parcel->status === 'damaged' ? 'bg-rose-100 text-rose-700' : '' }}
                                        {{ $parcel->status === 'ready_for_shipment' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                        {{ $parcel->status === 'shipped' ? 'bg-blue-100 text-blue-700' : '' }}
                                    ">
                                        {{ ucwords(str_replace('_', ' ', $parcel->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('parcels.show', $parcel) }}" class="text-indigo-600 hover:text-indigo-900 inline-flex items-center gap-1 group">
                                        View Details
                                        <svg class="w-4 h-4 opacity-0 -ml-2 group-hover:opacity-100 group-hover:ml-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if(method_exists($parcels, 'links'))
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $parcels->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-16 px-6">
                <div class="bg-indigo-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-5 border border-indigo-100">
                    <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">No parcels received</h3>
                <p class="mt-2 text-base text-gray-500 max-w-sm mx-auto">When your packages arrive at our warehouse, they will be cataloged and displayed here.</p>
                <div class="mt-8 p-4 bg-gray-50 rounded-xl inline-block text-left text-sm max-w-md mx-auto border border-gray-100">
                    <p class="font-bold text-gray-700 mb-1">Make sure you are using your Suite ID!</p>
                    <p class="text-gray-500">Your forwarding Suite ID is <span class="font-black text-indigo-600">{{ auth()->user()->warehouse_suite_id }}</span>. Append this to your shipping addresses so we can identify your packages.</p>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
