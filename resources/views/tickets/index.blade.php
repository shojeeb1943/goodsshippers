<x-app-layout>
    <x-slot name="header">Support Tickets</x-slot>

    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h3 class="text-lg font-bold text-gray-900 tracking-tight">Your Help Requests</h3>
            <p class="text-sm text-gray-500 mt-1">Get assistance with your orders, parcels, or shipments.</p>
        </div>
        <a href="{{ route('tickets.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent font-bold rounded-lg text-white bg-accent hover:bg-accent/90 shadow-sm shadow-accent/30 transition-all">
            <svg class="w-5 h-5 mr-2 -ml-1 text-indigo-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Open New Ticket
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($tickets->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50/80">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Subject</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Last Activity</th>
                            <th scope="col" class="relative px-6 py-4">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($tickets as $ticket)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $ticket->subject }}</div>
                                    <div class="text-xs text-gray-500 mt-0.5">Ticket #{{ $ticket->id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full 
                                        {{ $ticket->status === 'open' ? 'bg-indigo-100 text-indigo-700' : '' }}
                                        {{ $ticket->status === 'in_progress' ? 'bg-amber-100 text-amber-700' : '' }}
                                        {{ $ticket->status === 'resolved' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                        {{ $ticket->status === 'closed' ? 'bg-gray-100 text-gray-700' : '' }}
                                    ">
                                        {{ ucwords(str_replace('_', ' ', $ticket->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">
                                    {{ $ticket->updated_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('tickets.show', $ticket) }}" class="text-indigo-600 hover:text-indigo-900 inline-flex items-center gap-1 group">
                                        View Thread
                                        <svg class="w-4 h-4 opacity-0 -ml-2 group-hover:opacity-100 group-hover:ml-0 transition-all font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-16 px-6">
                <div class="bg-indigo-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-5 border border-indigo-100">
                    <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">No active tickets</h3>
                <p class="mt-2 text-base text-gray-500 max-w-sm mx-auto">Have a question or issue? Open a ticket and our team will get back to you shortly.</p>
                <div class="mt-8">
                    <a href="{{ route('tickets.create') }}" class="inline-flex items-center px-5 py-3 border border-transparent shadow-sm shadow-accent/30 text-sm font-bold rounded-lg text-white bg-accent hover:bg-accent/90 transition-colors">
                        Create your first ticket
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
