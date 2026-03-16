<x-app-layout>
    <x-slot name="header">My Invoices</x-slot>

    <div class="mb-6">
        <h3 class="text-lg font-bold text-gray-900 tracking-tight">Billing & Payments</h3>
        <p class="text-sm text-gray-500 mt-1">View and pay your pending invoices for orders and shipments.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($invoices->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/80">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Invoice No.</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Amount Due</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="relative px-6 py-4">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($invoices as $invoice)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p class="text-sm font-bold text-gray-900">{{ $invoice->invoice_number }}</p>
                                    @if($invoice->order_id)
                                        <p class="text-xs text-gray-500 mt-0.5">Order #{{ $invoice->order_id }}</p>
                                    @elseif($invoice->shipment_id)
                                        <p class="text-xs text-gray-500 mt-0.5">Shipment #{{ $invoice->shipment->shipment_number ?? $invoice->shipment_id }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $invoice->created_at->format('M j, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ in_array($invoice->status, ['draft', 'sent']) ? 'text-rose-600' : 'text-gray-900' }}">
                                    {{ number_format($invoice->total_amount, 2) }} BDT
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full 
                                        {{ in_array($invoice->status, ['draft', 'sent']) ? 'bg-rose-100 text-rose-700' : '' }}
                                        {{ $invoice->status === 'paid' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                        {{ str_starts_with($invoice->status, 'cancel') ? 'bg-gray-100 text-gray-700' : '' }}
                                    ">
                                        {{ ucwords(str_replace('_', ' ', $invoice->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('invoices.show', $invoice) }}" class="text-indigo-600 hover:text-indigo-900 inline-flex items-center gap-1 group">
                                        {{ in_array($invoice->status, ['draft', 'sent']) ? 'Pay Now' : 'View Details' }}
                                        <svg class="w-4 h-4 opacity-0 -ml-2 group-hover:opacity-100 group-hover:ml-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if(method_exists($invoices, 'links'))
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $invoices->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-16 px-6">
                <div class="bg-indigo-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-5 border border-indigo-100">
                    <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">No invoices yet</h3>
                <p class="mt-2 text-base text-gray-500 max-w-sm mx-auto">When your parcels incur fees or a shipment is dispatched, invoices will be generated here.</p>
            </div>
        @endif
    </div>
</x-app-layout>
