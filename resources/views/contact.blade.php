@extends('layouts.public')

@section('title', 'Contact Us')
@section('meta_description', 'Get in touch with GoodsShippers for support, tracking help, or partnership inquiries. Our global team is ready to assist.')

@section('content')
    <!-- Hero -->
    <section class="bg-primary text-white py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6">Contact Us</h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto">
                Have questions about your shipment? Our global support team is here to help you move your goods across borders with ease.
            </p>
        </div>
    </section>

    <!-- Contact Cards -->
    <section class="max-w-7xl mx-auto px-4 -mt-12 mb-16">
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-slate-900 p-8 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-800 text-center">
                <div class="w-14 h-14 bg-accent/10 text-accent rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-3xl">support_agent</span>
                </div>
                <h3 class="text-xl font-bold text-primary dark:text-white mb-2">Customer Support</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm mb-4">Immediate help with tracking and orders.</p>
                <a class="text-accent font-bold hover:underline" href="tel:+8801234567890">+880 1234 567890</a>
            </div>
            <div class="bg-white dark:bg-slate-900 p-8 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-800 text-center">
                <div class="w-14 h-14 bg-accent/10 text-accent rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-3xl">mail</span>
                </div>
                <h3 class="text-xl font-bold text-primary dark:text-white mb-2">Email Inquiries</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm mb-4">General queries and partnership requests.</p>
                <a class="text-accent font-bold hover:underline" href="mailto:support@goodsshippers.com">support@goodsshippers.com</a>
            </div>
            <div class="bg-white dark:bg-slate-900 p-8 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-800 text-center">
                <div class="w-14 h-14 bg-accent/10 text-accent rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-3xl">chat</span>
                </div>
                <h3 class="text-xl font-bold text-primary dark:text-white mb-2">Live Chat</h3>
                <p class="text-slate-500 dark:text-slate-400 text-sm mb-4">Available during business hours for quick chat.</p>
                <button class="bg-primary text-white px-6 py-2 rounded-lg font-bold hover:bg-primary/90 transition-all">Start Chat</button>
            </div>
        </div>
    </section>

    <!-- Form + Map -->
    <section class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid lg:grid-cols-2 gap-16">
            <div>
                <h2 class="text-3xl font-bold text-primary dark:text-white mb-8">Send Us a Message</h2>
                <form class="space-y-6" action="#" method="POST">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Full Name</label>
                            <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-accent focus:border-accent" placeholder="John Doe" type="text" name="name" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Email Address</label>
                            <input class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-accent focus:border-accent" placeholder="john@example.com" type="email" name="email" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Subject</label>
                        <select class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-accent focus:border-accent" name="subject">
                            <option>General Inquiry</option>
                            <option>Shipping Quote</option>
                            <option>Tracking Issue</option>
                            <option>Account Support</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700 dark:text-slate-300">Message</label>
                        <textarea class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-accent focus:border-accent" placeholder="How can we help you?" rows="5" name="message"></textarea>
                    </div>
                    <button class="w-full bg-accent hover:bg-accent/90 text-white font-bold py-4 rounded-lg shadow-lg shadow-accent/20 transition-all">
                        Send Message
                    </button>
                </form>
            </div>
            <div class="space-y-12">
                <div>
                    <h2 class="text-3xl font-bold text-primary dark:text-white mb-8">Contact Information</h2>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <span class="material-symbols-outlined text-accent">location_on</span>
                            <div>
                                <h4 class="font-bold text-primary dark:text-white">Dhaka Office</h4>
                                <p class="text-slate-500 dark:text-slate-400 text-sm">Road 12, Banani, Dhaka 1213, Bangladesh</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="material-symbols-outlined text-accent">schedule</span>
                            <div>
                                <h4 class="font-bold text-primary dark:text-white">Support Hours</h4>
                                <p class="text-slate-500 dark:text-slate-400 text-sm">Sunday - Thursday: 10:00 AM - 7:00 PM</p>
                                <p class="text-slate-500 dark:text-slate-400 text-sm">Friday - Saturday: Closed</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="material-symbols-outlined text-accent">call</span>
                            <div>
                                <h4 class="font-bold text-primary dark:text-white">Phone</h4>
                                <p class="text-slate-500 dark:text-slate-400 text-sm">+880 1234 567890</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span class="material-symbols-outlined text-accent">mail</span>
                            <div>
                                <h4 class="font-bold text-primary dark:text-white">Email</h4>
                                <p class="text-slate-500 dark:text-slate-400 text-sm">support@goodsshippers.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-2xl overflow-hidden h-64 bg-slate-200 dark:bg-slate-800 relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="material-symbols-outlined text-6xl text-slate-400">map</span>
                    </div>
                    <img alt="Map Location" class="w-full h-full object-cover opacity-30" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDddwGtxVKeHAgKStRy5HtQh9s96pozHxJvoLbz7AsXMEq4aU3lznUwSI1bmGAQCdpgmr5sNIG-jjpAo7TAqhf5sguZVj0irS6AOisfP-qbuId1xKpqNDrzDXPos-36PwOsCDUlsoUO2s9N1hQXmgn97yLRInM6abFUqSgAxG-We4Cz_sweluXD3F0YcvvIA209KX2YGPp_f9I_rRSxxAxPY2KwWFDIVQcuDGxK5iSSyuo4o-Vavy2ClqVjzhBdhhZAY3OZHIStbUI" />
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Banner -->
    <section class="bg-slate-100 dark:bg-slate-800/50 py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-primary dark:text-white mb-4">Looking for quick answers?</h2>
            <p class="text-slate-600 dark:text-slate-400 mb-8">Check out our frequently asked questions for common shipping inquiries.</p>
            <a class="inline-flex items-center gap-2 px-8 py-3 bg-white dark:bg-slate-900 text-primary dark:text-white border border-slate-200 dark:border-slate-800 font-bold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-all" href="{{ route('faq') }}">
                Visit Help Center
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
    </section>
@endsection
