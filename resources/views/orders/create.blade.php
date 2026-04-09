<x-app-layout>
    <x-slot name="header">New Shop For Me Request</x-slot>

    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <form action="{{ route('orders.store') }}" method="POST" x-data="orderForm()">
                @csrf
                
                <div class="mb-8 border-b border-gray-100 pb-5">
                    <h3 class="text-xl font-bold text-gray-900 tracking-tight">What do you want us to buy?</h3>
                    <p class="text-sm text-gray-500 mt-2">Provide the links to the products you want. We will review and provide a comprehensive quote including shipping and service fees.</p>
                </div>

                <!-- Alpine Loop for Items -->
                <div class="space-y-5">
                    <template x-for="(item, index) in items" :key="item.id">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-start bg-gray-50/50 p-5 rounded-xl border border-gray-200 relative group transition-colors hover:bg-white hover:border-indigo-200 hover:shadow-sm">
                            <!-- Product URL -->
                            <div class="md:col-span-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Product URL *</label>
                                <input type="url" :name="`items[${index}][product_url]`" x-model="item.url" required class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-2.5 px-3" placeholder="https://amazon.com/example...">
                            </div>
                            
                            <!-- Product Name / Description -->
                            <div class="md:col-span-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Product Name / Options *</label>
                                <input type="text" :name="`items[${index}][product_name]`" x-model="item.name" required class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-2.5 px-3" placeholder="E.g. iPhone 15 Pro, Black">
                            </div>

                            <!-- Quantity -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Quantity *</label>
                                <input type="number" :name="`items[${index}][quantity]`" x-model="item.qty" required min="1" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-2.5 px-3">
                            </div>

                            <!-- Remove Button -->
                            <button type="button" @click="removeItem(item.id)" x-show="items.length > 1" class="absolute -top-3 -right-3 bg-white text-red-500 rounded-full p-2 shadow border border-red-100 hover:bg-red-50 hover:text-red-600 transition-colors opacity-0 group-hover:opacity-100 z-10" title="Remove item">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    </template>
                </div>

                <div class="mt-5">
                    <button type="button" @click="addItem" class="inline-flex items-center px-4 py-2 border border-dashed border-gray-300 shadow-sm text-sm font-medium rounded-lg text-indigo-700 bg-indigo-50 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <svg class="w-5 h-5 mr-1.5 -ml-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Add Another Item
                    </button>
                </div>

                <div class="mt-8 border-t border-gray-100 pt-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Additional Notes (Optional)</label>
                    <textarea name="notes" rows="3" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm py-3 px-3" placeholder="Any specific instructions? E.g. 'Please discard shoe boxes to save weight'"></textarea>
                </div>

                <div class="mt-8 pt-4 flex flex-col-reverse sm:flex-row justify-end gap-3 sm:gap-4">
                    <a href="{{ route('orders.index') }}" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-sm font-bold rounded-lg shadow-sm shadow-accent/30 text-white bg-accent hover:bg-accent/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent transition-colors">
                        Submit Request
                        <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Alpine.js Component logic -->
    <script>
        function orderForm() {
            return {
                items: [
                    { id: Date.now(), url: '', name: '', qty: 1 }
                ],
                addItem() {
                    this.items.push({ id: Date.now(), url: '', name: '', qty: 1 });
                },
                removeItem(id) {
                    this.items = this.items.filter(item => item.id !== id);
                }
            }
        }
    </script>
</x-app-layout>
