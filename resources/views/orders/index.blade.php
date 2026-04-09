<x-app-layout>
    <x-slot name="header">My Orders (Shop For Me)</x-slot>

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h3 class="text-lg font-bold text-gray-900 tracking-tight">Your Purchase Requests</h3>
            <p class="text-sm text-gray-500 mt-1">Manage and track your Shop For Me requests.</p>
        </div>
        <a href="{{ route('orders.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent font-bold rounded-lg text-white bg-accent hover:bg-accent/90 shadow-sm shadow-accent/30 transition-colors">
            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            New Request
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($orders->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/80">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Items</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="relative px-6 py-4">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    #{{ $order->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $order->created_at->format('M j, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $order->items->count() }} item(s)
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full 
                                        {{ str_starts_with($order->status, 'cancelled') || str_starts_with($order->status, 'reject') ? 'bg-rose-100 text-rose-700' : '' }}
                                        {{ str_starts_with($order->status, 'quote') ? 'bg-amber-100 text-amber-700' : '' }}
                                        {{ in_array($order->status, ['pending', 'processing']) ? 'bg-indigo-100 text-indigo-700' : '' }}
                                        {{ $order->status === 'delivered' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                    ">
                                        {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900 inline-flex items-center gap-1 group">
                                        View Details
                                        <svg class="w-4 h-4 opacity-0 -ml-2 group-hover:opacity-100 group-hover:ml-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if(method_exists($orders, 'links'))
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-16 px-6">
                <div class="bg-indigo-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-5">
                    <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">No requests yet</h3>
                <p class="mt-2 text-base text-gray-500 max-w-sm mx-auto">You haven't submitted any Shop For Me requests. We'll buy products from overseas on your behalf.</p>
                <div class="mt-8">
                    <a href="{{ route('orders.create') }}" class="inline-flex items-center px-5 py-3 border border-transparent shadow-sm shadow-accent/30 text-sm font-bold rounded-lg text-white bg-accent hover:bg-accent/90 transition-colors">
                        Create your first request
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
