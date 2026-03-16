<x-app-layout>
    <x-slot name="header">Invoice #{{ $invoice->invoice_number }}</x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('invoices.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
                <svg class="mr-2 w-5 h-5 flex-shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Invoices
            </a>
            
            <span class="px-4 py-1.5 inline-flex text-sm font-bold rounded-full shadow-sm
                {{ in_array($invoice->status, ['draft', 'sent']) ? 'bg-rose-100 text-rose-700 border border-rose-200' : '' }}
                {{ $invoice->status === 'paid' ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' : '' }}
                {{ str_starts_with($invoice->status, 'cancel') ? 'bg-gray-100 text-gray-700 border border-gray-200' : '' }}
            ">
                {{ ucwords(str_replace('_', ' ', $invoice->status)) }}
            </span>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header -->
            <div class="bg-indigo-900 text-white px-8 py-10 flex flex-col sm:flex-row justify-between items-start gap-6 pattern-dots">
                <div>
                    <h1 class="text-3xl font-black tracking-tight flex items-center gap-3">
                        <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        GoossShippers
                    </h1>
                    <p class="text-indigo-200 text-sm mt-2 font-medium">B2C Logistics & Forwarding Platform</p>
                </div>
                <div class="text-left sm:text-right">
                    <p class="text-indigo-200 text-sm uppercase tracking-widest font-bold mb-1">Invoice</p>
                    <p class="text-2xl font-bold">{{ $invoice->invoice_number }}</p>
                    <p class="text-indigo-200 text-sm mt-2">Issued: {{ $invoice->created_at->format('M j, Y') }}</p>
                    @if($invoice->due_date)
                        <p class="text-rose-300 text-sm font-semibold">Due: {{ \Carbon\Carbon::parse($invoice->due_date)->format('M j, Y') }}</p>
                    @endif
                </div>
            </div>

            <!-- Customer & References -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 px-8 py-8 border-b border-gray-100">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Billed To</p>
                    <p class="text-base font-bold text-gray-900">{{ $invoice->user->name }}</p>
                    <p class="text-sm text-gray-600 mt-1">Suite ID: <span class="font-bold text-indigo-600">{{ $invoice->user->warehouse_suite_id }}</span></p>
                    <p class="text-sm text-gray-600 mt-1">{{ $invoice->user->email }}</p>
                    @if($invoice->user->phone)
                        <p class="text-sm text-gray-600 mt-1">{{ $invoice->user->phone }}</p>
                    @endif
                </div>
                <div class="sm:text-right">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">References</p>
                    @if($invoice->order_id)
                        <p class="text-sm text-gray-600">Order: <a href="{{ route('orders.show', $invoice->order_id) }}" class="font-bold text-indigo-600 hover:underline">#{{ $invoice->order_id }}</a></p>
                    @endif
                    @if($invoice->shipment_id)
                        <p class="text-sm text-gray-600 mt-1">Shipment: <a href="{{ route('shipments.show', $invoice->shipment_id) }}" class="font-bold text-indigo-600 hover:underline">{{ $invoice->shipment->shipment_number ?? $invoice->shipment_id }}</a></p>
                    @endif
                </div>
            </div>

            <!-- Items Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-8 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-8 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Qty</th>
                            <th scope="col" class="px-8 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Unit Price</th>
                            <th scope="col" class="px-8 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 border-b border-gray-100">
                        @foreach($invoice->items as $item)
                        <tr class="hover:bg-gray-50/50">
                            <td class="px-8 py-5">
                                <p class="text-sm font-bold text-gray-900">{{ $item->description }}</p>
                            </td>
                            <td class="px-8 py-5 text-center text-sm font-medium text-gray-600">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-8 py-5 text-right text-sm text-gray-600">
                                {{ number_format($item->unit_price, 2) }}
                            </td>
                            <td class="px-8 py-5 text-right text-sm font-bold text-gray-900">
                                {{ number_format($item->total, 2) }} BDT
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Totals & Payment -->
            <div class="px-8 py-8 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-8">
                <div class="max-w-sm">
                    @if(in_array($invoice->status, ['draft', 'sent']))
                        <div class="bg-white p-5 rounded-xl border border-indigo-100 shadow-sm">
                            <h4 class="text-sm font-bold text-gray-900 mb-2">Secure Online Payment</h4>
                            <p class="text-xs text-gray-500 mb-4">Pay instantly using bKash, SSLCommerz, cards, or mobile banking.</p>
                            <form action="{{ route('payment.initiate', $invoice) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-sm shadow-indigo-200 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Pay {{ number_format($invoice->total_amount, 2) }} BDT Now
                                </button>
                            </form>
                        </div>
                    @elseif($invoice->status === 'paid')
                        <div class="bg-emerald-50 rounded-lg p-4 border border-emerald-100 flex items-start gap-3 justify-center">
                            <svg class="w-6 h-6 text-emerald-500 text-center" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <p class="text-sm font-bold text-emerald-900">Invoice Paid</p>
                                <p class="text-xs text-emerald-700 mt-1">Thank you for your payment.</p>
                                @if($invoice->paid_at)
                                    <p class="text-xs text-emerald-600 font-semibold mt-1">Received on {{ \Carbon\Carbon::parse($invoice->paid_at)->format('M j, Y h:i A') }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                <div class="w-full sm:w-auto text-right space-y-3">
                    <div class="flex justify-between sm:justify-end items-center gap-8">
                        <span class="text-sm font-medium text-gray-500">Subtotal:</span>
                        <span class="text-base font-semibold text-gray-900">{{ number_format($invoice->items->sum('total'), 2) }} BDT</span>
                    </div>
                    <div class="w-full h-px bg-gray-200"></div>
                    <div class="flex justify-between sm:justify-end items-center gap-8">
                        <span class="text-base font-bold text-gray-900">Total Amount:</span>
                        <span class="text-3xl font-black text-indigo-700">{{ number_format($invoice->total_amount, 2) }} BDT</span>
                    </div>
                </div>
            </div>
            
            <!-- Bank Transfer Details Option -->
            @if(in_array($invoice->status, ['draft', 'sent']))
                <div class="px-8 py-6 bg-white border-t border-gray-100">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-gray-500 mb-3">Or Pay by Manual Bank Transfer</h4>
                    <p class="text-sm text-gray-600 leading-relaxed max-w-2xl">
                        Please transfer the exact amount to <strong>City Bank Limited (Account: 1234 5678 9000, Branch: Gulshan)</strong>. Use <span class="font-bold text-gray-900">{{ $invoice->invoice_number }}</span> as the transfer reference and reply to the invoice notification email with your payment slip.
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
