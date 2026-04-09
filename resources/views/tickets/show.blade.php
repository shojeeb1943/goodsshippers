<x-app-layout>
    <x-slot name="header">Ticket #{{ $ticket->id }} - {{ $ticket->subject }}</x-slot>

    <div class="mb-6 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <a href="{{ route('tickets.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
            <svg class="mr-2 w-5 h-5 flex-shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Tickets
        </a>
        <div class="flex items-center gap-3">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Status:</span>
            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full 
                {{ $ticket->status === 'open' ? 'bg-indigo-100 text-indigo-700' : '' }}
                {{ $ticket->status === 'in_progress' ? 'bg-amber-100 text-amber-700' : '' }}
                {{ $ticket->status === 'resolved' ? 'bg-emerald-100 text-emerald-700' : '' }}
                {{ $ticket->status === 'closed' ? 'bg-gray-100 text-gray-700' : '' }}
            ">
                {{ ucwords(str_replace('_', ' ', $ticket->status)) }}
            </span>
        </div>
    </div>

    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Message Thread -->
        <div class="space-y-6">
            @foreach($ticket->messages as $message)
                <div class="flex flex-col {{ $message->sender_id === auth()->id() ? 'items-end' : 'items-start' }}">
                    <div class="flex items-center gap-2 mb-1.5 {{ $message->sender_id === auth()->id() ? 'flex-row-reverse' : 'flex-row' }}">
                        <span class="text-xs font-bold text-gray-900">{{ $message->sender->name }}</span>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tight">{{ $message->created_at->format('M j, h:i A') }}</span>
                    </div>
                    
                    <div class="max-w-[85%] sm:max-w-[70%] rounded-2xl p-4 shadow-sm border
                        {{ $message->sender_id === auth()->id() 
                           ? 'bg-indigo-600 text-white border-indigo-500 rounded-tr-none' 
                           : 'bg-white text-gray-800 border-gray-100 rounded-tl-none' }}">
                        <p class="text-sm leading-relaxed whitespace-pre-line">{{ $message->message }}</p>
                        
                        @if($message->attachment_path)
                            <div class="mt-4 pt-3 border-t {{ $message->sender_id === auth()->id() ? 'border-indigo-500/50' : 'border-gray-50' }}">
                                <a href="{{ asset('storage/' . $message->attachment_path) }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-bold {{ $message->sender_id === auth()->id() ? 'text-indigo-100 hover:text-white' : 'text-indigo-600 hover:text-indigo-800' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                    View Attachment
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @if($ticket->status !== 'closed')
            <!-- Reply Form -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <form action="{{ route('tickets.reply', $ticket) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="message" class="block text-sm font-bold text-gray-700 mb-2">Write a Reply</label>
                        <textarea name="message" id="message" rows="4" required class="block w-full border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-3 px-4" placeholder="Your message..."></textarea>
                    </div>

                    <div class="mt-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="w-full sm:w-auto">
                            <label class="inline-flex items-center px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-100 transition-colors">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                <span class="text-xs font-bold text-gray-600">Attach File</span>
                                <input type="file" name="attachment" class="hidden">
                            </label>
                            <p class="text-[10px] text-gray-400 mt-1 sm:ml-1">Max 10MB (Img, PDF)</p>
                        </div>
                        
                        <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-8 py-2.5 border border-transparent text-sm font-black rounded-xl shadow-md shadow-accent/30 text-white bg-accent hover:bg-accent/90 focus:outline-none transition-all">
                            Send Reply
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                <h4 class="text-lg font-bold text-gray-900">This ticket is closed</h4>
                <p class="text-sm text-gray-500 max-w-sm mx-auto mt-1">Further replies are disabled. If you still need help, please open a new ticket.</p>
            </div>
        @endif
    </div>
</x-app-layout>
