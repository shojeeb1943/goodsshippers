<x-app-layout>
    <x-slot name="header">Open Support Ticket</x-slot>

    <div class="max-w-3xl">
        <div class="mb-6">
            <a href="{{ route('tickets.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
                <svg class="mr-2 w-5 h-5 flex-shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Tickets
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 sm:p-10">
            <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="subject" class="block text-sm font-bold text-gray-700 mb-1.5">Subject *</label>
                        <input type="text" name="subject" id="subject" required class="block w-full border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-3 px-4" placeholder="Briefly describe the issue">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-bold text-gray-700 mb-1.5">Detailed Message *</label>
                        <textarea name="message" id="message" rows="6" required class="block w-full border-gray-300 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-3 px-4" placeholder="Provide as much detail as possible..."></textarea>
                    </div>

                    <div>
                        <label for="attachment" class="block text-sm font-bold text-gray-700 mb-1.5">Attachment (Optional)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl transition-colors hover:border-indigo-400 group">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-indigo-400 font-normal transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="attachment" class="relative cursor-pointer bg-white rounded-md font-bold text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="attachment" name="attachment" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="inline-flex justify-center items-center px-8 py-3.5 border border-transparent text-base font-black rounded-xl shadow-lg shadow-accent/30 text-white bg-accent hover:bg-accent/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent transition-all hover:-translate-y-0.5">
                            Create Ticket
                            <svg class="ml-2 -mr-1 w-5 h-5 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
