<x-app-layout>
    <x-slot name="header">Order Details - #{{ $order->id }}</x-slot>

    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('orders.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
            <svg class="mr-2 w-5 h-5 flex-shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Orders
        </a>
        <span class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full 
            {{ str_starts_with($order->status, 'cancelled') || str_starts_with($order->status, 'reject') ? 'bg-rose-100 text-rose-700' : '' }}
            {{ str_starts_with($order->status, 'quote') ? 'bg-amber-100 text-amber-700' : '' }}
            {{ str_starts_with($order->status, 'pend') || str_starts_with($order->status, 'process') ? 'bg-indigo-100 text-indigo-700' : '' }}
            {{ $order->status === 'delivered' ? 'bg-emerald-100 text-emerald-700' : '' }}
        ">
            {{ ucwords(str_replace('_', ' ', $order->status)) }}
        </span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left: Order Details & Quote -->
        <div class="lg:col-span-2 space-y-8">
            
            @if($order->status === 'quote_sent')
                <div class="bg-amber-50 rounded-2xl border border-amber-200 p-6 flex flex-col md:flex-row items-center justify-between gap-6 shadow-sm">
                    <div>
                        <h4 class="text-lg font-bold text-amber-900 tracking-tight flex items-center gap-2">
                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            Action Required
                        </h4>
                        <p class="text-sm text-amber-800 mt-1 font-medium">We have provided a quote for your requested items. Please review the prices below and approve the quote to proceed with the purchase.</p>
                    </div>
                    <div class="flex flex-shrink-0 gap-3">
                        <form action="{{ route('orders.reject', $order) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 border border-amber-300 text-amber-700 rounded-lg hover:bg-amber-100 font-semibold text-sm transition-colors">Reject</button>
                        </form>
                        <form action="{{ route('orders.approve', $order) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-5 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 font-bold text-sm shadow-sm transition-colors">Approve Quote</button>
                        </form>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/80">
                    <h3 class="text-lg font-bold text-gray-900 tracking-tight">Requested Items</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-white">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Product</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Qty</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Quoted Price</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @php $totalQuote = 0; @endphp
                            @foreach($order->items as $item)
                                @php $totalQuote += ($item->quoted_price * $item->quantity); @endphp
                                <tr>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-semibold text-gray-900">{{ $item->product_name }}</p>
                                        <a href="{{ $item->product_url }}" target="_blank" class="text-xs text-indigo-600 hover:text-indigo-800 truncate block max-w-xs mt-0.5" title="{{ $item->product_url }}">
                                            View Source Link &nearr;
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm text-gray-500 font-medium">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        @if($item->quoted_price !== null)
                                            <span class="text-sm text-gray-900 font-bold">{{ number_format($item->quoted_price, 2) }} <span class="text-xs text-gray-500">BDT</span></span>
                                        @else
                                            <span class="text-xs text-gray-400 font-medium italic">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @if($totalQuote > 0)
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <th scope="row" colspan="2" class="px-6 py-4 text-right text-sm font-bold text-gray-900">Total Estimated Quote:</th>
                                    <td class="px-6 py-4 text-right text-sm font-black text-indigo-700 whitespace-nowrap">{{ number_format($totalQuote, 2) }} BDT</td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
                @if($order->notes)
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Customer Notes</h4>
                        <p class="text-sm text-gray-700 whitespace-pre-line">{{ $order->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right: Status Timeline -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-28">
                <h3 class="text-lg font-bold text-gray-900 tracking-tight border-b border-gray-100 pb-4 mb-6">Status Timeline</h3>
                
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @foreach($order->statusLogs()->orderBy('created_at', 'desc')->get() as $log)
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
