@extends('layouts.public')

@section('title', 'Checkout')
@section('meta_description', 'Complete your shipment request securely. Review your order and submit for processing.')

@section('content')
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-black text-primary dark:text-white mb-10">Checkout</h1>
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Form -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Delivery Info -->
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm">
                        <h2 class="text-xl font-bold text-primary dark:text-white mb-6">Delivery Information</h2>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Full Name</label>
                                <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 p-3 focus:ring-accent" placeholder="John Doe" type="text" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Phone Number</label>
                                <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 p-3 focus:ring-accent" placeholder="+880 1234 567890" type="tel" />
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Address Line 1</label>
                                <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 p-3 focus:ring-accent" placeholder="House 7, Road 3, Block A" type="text" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">City</label>
                                <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 p-3 focus:ring-accent" placeholder="Dhaka" type="text" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Postal Code</label>
                                <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 p-3 focus:ring-accent" placeholder="1213" type="text" />
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Method -->
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm">
                        <h2 class="text-xl font-bold text-primary dark:text-white mb-6">Shipping Method</h2>
                        <div class="space-y-4">
                            <label class="flex items-center justify-between p-4 border-2 border-primary rounded-xl cursor-pointer">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="shipping" class="accent-primary" checked />
                                    <div>
                                        <p class="font-bold">✈️ Air Freight</p>
                                        <p class="text-sm text-slate-500">10-15 business days</p>
                                    </div>
                                </div>
                                <span class="font-bold text-primary">$14/kg</span>
                            </label>
                            <label class="flex items-center justify-between p-4 border border-slate-200 dark:border-slate-700 rounded-xl cursor-pointer hover:border-primary transition-colors">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="shipping" class="accent-primary" />
                                    <div>
                                        <p class="font-bold">🚢 Sea Freight</p>
                                        <p class="text-sm text-slate-500">45-60 business days</p>
                                    </div>
                                </div>
                                <span class="font-bold text-slate-600">$4.5/kg</span>
                            </label>
                        </div>
                    </div>

                    <!-- Payment -->
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm">
                        <h2 class="text-xl font-bold text-primary dark:text-white mb-6">Payment Method</h2>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
                            @foreach(['bKash','Nagad','Rocket','Bank Transfer'] as $method)
                            <label class="border-2 {{ $loop->first ? 'border-primary' : 'border-slate-200 dark:border-slate-700' }} rounded-xl p-4 text-center cursor-pointer hover:border-primary transition-colors">
                                <input type="radio" name="payment" class="sr-only" {{ $loop->first ? 'checked' : '' }} />
                                <span class="text-sm font-bold">{{ $method }}</span>
                            </label>
                            @endforeach
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Account / Reference Number</label>
                                <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 p-3 focus:ring-accent" placeholder="01XXXXXXXXX" type="text" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Transaction ID</label>
                                <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 p-3 focus:ring-accent" placeholder="8XYZ12345" type="text" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div>
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm sticky top-24">
                        <h2 class="text-xl font-bold text-primary dark:text-white mb-6">Order Summary</h2>
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Chargeable Weight</span>
                                <span class="font-semibold">2.5 kg</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Shipping (Air)</span>
                                <span class="font-semibold">$35.00</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Consolidation</span>
                                <span class="text-green-600 font-semibold">FREE</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Handling Fee</span>
                                <span class="font-semibold">$2.50</span>
                            </div>
                        </div>
                        <div class="border-t border-slate-100 dark:border-slate-800 pt-6">
                            <div class="flex justify-between items-center mb-8">
                                <span class="font-bold text-lg">Total</span>
                                <span class="text-3xl font-black text-primary dark:text-accent">$37.50</span>
                            </div>
                            <button class="w-full py-4 bg-accent text-white font-bold rounded-xl hover:bg-accent/90 transition-all shadow-lg shadow-accent/20 text-lg">
                                Confirm Order
                            </button>
                            <p class="text-xs text-slate-400 text-center mt-4">By placing this order you agree to our <a class="underline" href="#">Terms of Service</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
