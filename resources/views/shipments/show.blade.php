<x-app-layout>
    <x-slot name="header">Shipment Details</x-slot>

    <div class="mb-6 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('shipments.index') }}" class="p-2 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h3 class="text-xl font-extrabold text-gray-900 tracking-tight">{{ $shipment->shipment_number }}</h3>
                <p class="text-sm font-medium text-gray-500">Dispatched from {{ $shipment->warehouse->name ?? 'Warehouse' }}</p>
            </div>
        </div>
        <span class="px-4 py-1.5 inline-flex text-sm font-bold rounded-full shadow-sm
            {{ in_array($shipment->status, ['processing', 'customs_clearance']) ? 'bg-amber-100 text-amber-700 border border-amber-200' : '' }}
            {{ $shipment->status === 'in_transit' ? 'bg-blue-100 text-blue-700 border border-blue-200' : '' }}
            {{ $shipment->status === 'out_for_delivery' ? 'bg-indigo-100 text-indigo-700 border border-indigo-200' : '' }}
            {{ $shipment->status === 'delivered' ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : '' }}
        ">
            {{ ucwords(str_replace('_', ' ', $shipment->status)) }}
        </span>
    </div>

    @if($shipment->invoices->count() > 0)
        <!-- Related Invoices Alert -->
        <div class="mb-8">
            @foreach($shipment->invoices as $invoice)
                <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-3 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="bg-indigo-100 p-2 rounded-lg text-indigo-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-indigo-900">Invoice {{ $invoice->invoice_number }}</p>
                            <p class="text-xs font-semibold text-indigo-700 mt-0.5">
                                Status: <span class="uppercase tracking-wider">{{ $invoice->status }}</span> 
                                &bull; Amount: {{ number_format($invoice->total_amount, 2) }} BDT
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('invoices.show', $invoice) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition-colors w-full sm:w-auto">
                        @if(in_array($invoice->status, ['draft', 'sent']))
                            Pay Now
                        @else
                            View Invoice
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Shipment Details -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/80">
                    <h3 class="text-base font-bold text-gray-900 tracking-tight">Shipment Details</h3>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Shipping Mode</p>
                        <p class="text-sm font-bold text-gray-900">{{ $shipment->shippingMode->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Chargeable Weight</p>
                        <p class="text-sm font-bold text-indigo-600">{{ $shipment->chargeable_weight }} kg</p>
                        <p class="text-xs text-gray-500 mt-1">Actual: {{ $shipment->actual_weight }} kg</p>
                        @if($shipment->volumetric_weight)
                            <p class="text-xs text-gray-500">Volumetric: {{ $shipment->volumetric_weight }} kg</p>
                        @endif
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Created On</p>
                        <p class="text-sm font-bold text-gray-900">{{ $shipment->created_at->format('M j, Y') }}</p>
                    </div>
                </div>
                @if($shipment->notes)
                    <div class="px-6 py-5 border-t border-gray-100 bg-gray-50/50">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Notes / Instructions</p>
                        <p class="text-sm text-gray-700">{{ $shipment->notes }}</p>
                    </div>
                @endif
            </div>

            <!-- Parcels Included -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/80">
                    <h3 class="text-base font-bold text-gray-900 tracking-tight flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        Consolidated Packages ({{ $shipment->parcels->count() }})
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tracking / Info</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Weight</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($shipment->parcels as $parcel)
                                <tr>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-gray-900">{{ $parcel->tracking_number }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-600 font-medium">{{ $parcel->weight }} kg</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('parcels.show', $parcel) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-900">View Parcel</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Column: Status Timeline -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-28">
                <h3 class="text-lg font-bold text-gray-900 tracking-tight border-b border-gray-100 pb-4 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Tracking Journey
                </h3>
                
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @foreach($shipment->statusLogs()->orderBy('created_at', 'desc')->get() as $log)
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
