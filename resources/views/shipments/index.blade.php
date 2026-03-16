<x-app-layout>
    <x-slot name="header">My Shipments</x-slot>

    <div class="mb-6">
        <h3 class="text-lg font-bold text-gray-900 tracking-tight">Consolidated Shipments</h3>
        <p class="text-sm text-gray-500 mt-1">Track the packages we are forwarding to you.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($shipments->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/80">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Shipment No.</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Shipping Mode</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Parcels</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="relative px-6 py-4">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($shipments as $shipment)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm font-bold text-gray-900">{{ $shipment->shipment_number }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Chargeable: <span class="font-semibold">{{ $shipment->chargeable_weight }} kg</span></p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center text-sm font-semibold text-gray-700">
                                        {{ $shipment->shippingMode->name ?? 'N/A' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $shipment->parcels->count() }} item(s)
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full 
                                        {{ in_array($shipment->status, ['processing', 'customs_clearance']) ? 'bg-amber-100 text-amber-700' : '' }}
                                        {{ $shipment->status === 'in_transit' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $shipment->status === 'out_for_delivery' ? 'bg-indigo-100 text-indigo-700' : '' }}
                                        {{ $shipment->status === 'delivered' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                    ">
                                        {{ ucwords(str_replace('_', ' ', $shipment->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('shipments.show', $shipment) }}" class="text-indigo-600 hover:text-indigo-900 inline-flex items-center gap-1 group">
                                        View Details
                                        <svg class="w-4 h-4 opacity-0 -ml-2 group-hover:opacity-100 group-hover:ml-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if(method_exists($shipments, 'links'))
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $shipments->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-16 px-6">
                <div class="bg-indigo-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-5 border border-indigo-100">
                    <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">No shipments yet</h3>
                <p class="mt-2 text-base text-gray-500 max-w-sm mx-auto">When we consolidate and ship your parcels from our warehouse to you, they will appear here.</p>
            </div>
        @endif
    </div>
</x-app-layout>
