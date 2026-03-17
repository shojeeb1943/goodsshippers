@extends('layouts.public')

@section('title', 'FAQ – Frequently Asked Questions')
@section('meta_description', 'Find answers to common questions about shipping rates, warehouse addresses, customs duty, and more.')

@section('head')
<style type="text/tailwindcss">
    .faq-card {
        @apply bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 rounded-2xl p-6 shadow-xl transition-all hover:shadow-2xl hover:-translate-y-1;
    }
</style>
@endsection

@section('content')
    <!-- Hero -->
    <section class="bg-primary py-20 px-4">
        <div class="max-w-4xl mx-auto text-center space-y-8">
            <h1 class="text-4xl md:text-5xl font-black text-white">How can we help you today?</h1>
            <div class="relative max-w-2xl mx-auto">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                <input class="w-full h-16 pl-14 pr-6 rounded-2xl bg-white text-slate-900 border-none focus:ring-4 focus:ring-accent/30 text-lg shadow-2xl" placeholder="Search for shipping rates, warehouse locations, tracking..." type="text" />
            </div>
            <div class="flex flex-wrap justify-center gap-3">
                <span class="text-slate-300 text-sm">Popular:</span>
                <a class="text-white text-sm bg-white/10 px-3 py-1 rounded-full hover:bg-white/20 transition-colors" href="{{ route('calculator') }}">Shipping Calculator</a>
                <a class="text-white text-sm bg-white/10 px-3 py-1 rounded-full hover:bg-white/20 transition-colors" href="{{ route('warehouses.usa') }}">USA Warehouse</a>
                <a class="text-white text-sm bg-white/10 px-3 py-1 rounded-full hover:bg-white/20 transition-colors" href="{{ route('how-it-works') }}">Duty Rates</a>
            </div>
        </div>
    </section>

    <!-- Category Cards -->
    <section class="relative z-10 max-w-7xl mx-auto px-4 -mt-10 mb-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="faq-card group cursor-pointer hover:-translate-y-1 shadow-xl">
                <div class="w-12 h-12 bg-accent/10 rounded-xl flex items-center justify-center text-accent mb-4 group-hover:bg-accent group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined">local_shipping</span>
                </div>
                <h3 class="font-bold text-lg mb-2">Shipping & Rates</h3>
                <p class="text-sm text-slate-500">Calculate costs and understand air vs sea shipping modes.</p>
            </div>
            <div class="faq-card group cursor-pointer hover:-translate-y-1 shadow-xl">
                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-4 group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined">warehouse</span>
                </div>
                <h3 class="font-bold text-lg mb-2">Warehouse Info</h3>
                <p class="text-sm text-slate-500">Addresses for USA, UK, and Malaysia warehouse hubs.</p>
            </div>
            <div class="faq-card group cursor-pointer hover:-translate-y-1 shadow-xl">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600 mb-4 group-hover:bg-green-600 group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined">security</span>
                </div>
                <h3 class="font-bold text-lg mb-2">Insurance & Duty</h3>
                <p class="text-sm text-slate-500">How customs duty and cargo insurance work for you.</p>
            </div>
            <div class="faq-card group cursor-pointer hover:-translate-y-1 shadow-xl">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600 mb-4 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined">account_circle</span>
                </div>
                <h3 class="font-bold text-lg mb-2">My Account</h3>
                <p class="text-sm text-slate-500">Managing your profile, tracking orders and support tickets.</p>
            </div>
        </div>
    </section>

    <!-- FAQ Accordion -->
    <section class="max-w-4xl mx-auto px-4 mb-20">
        <h2 class="text-3xl font-black text-primary dark:text-white mb-10">Frequently Asked Questions</h2>
        <div class="space-y-4" id="faq-accordion">
            @foreach([
                ['How long does shipping take from the USA to Bangladesh?', 'Air shipping typically takes 10-15 business days from our NJ warehouse. Sea shipping takes approximately 45-60 days. These estimates include processing and clearing customs.', true],
                ['What items are prohibited from international shipping?', 'Prohibited items include flammable liquids, explosives, narcotics, firearms, and perishable food items. Please check our full prohibited list for more details.', false],
                ['How is the chargeable weight calculated?', 'We charge based on whichever is greater: actual weight or volumetric weight. Volumetric weight is calculated as (Length x Width x Height in cm) / 5000.', false],
                ['Can I consolidate packages from multiple orders?', 'Yes! Consolidation is one of our key services. We store your packages for up to 30 days (USA), 30 days (UK), and 14 days (Malaysia) at no extra charge, then ship them together to save you money.', false],
                ['How do I get a warehouse address?', 'Simply register for a free account and you\'ll instantly receive your unique suite ID and warehouse address for our USA, UK, and Malaysia hubs.', false],
                ['Do you offer insurance for my shipments?', 'Yes, we offer optional cargo insurance for a small fee. We strongly recommend it for high-value items like electronics and jewelry.', false],
                ['How do I track my shipment?', 'Log into your dashboard to see real-time tracking information. You\'ll also receive automated email/SMS notifications at each major milestone.', false],
                ['What payment methods do you accept?', 'We accept bKash, Nagad, Rocket, bank transfer, and major credit/debit cards for all transactions.', false],
            ] as $i => $faq)
            <div class="border border-slate-200 dark:border-slate-800 rounded-xl overflow-hidden">
                <button class="faq-btn w-full flex items-center justify-between p-6 bg-white dark:bg-slate-900 text-left hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors" data-target="faq-{{ $i }}">
                    <span class="font-bold text-lg text-primary dark:text-white">{{ $faq[0] }}</span>
                    <span class="material-symbols-outlined text-slate-400 transition-transform {{ $faq[2] ? 'rotate-180' : '' }}">expand_more</span>
                </button>
                <div id="faq-{{ $i }}" class="{{ $faq[2] ? '' : 'hidden' }} px-6 py-4 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-800">
                    <p class="text-slate-600 dark:text-slate-400">{{ $faq[1] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Still Have Questions -->
    <section class="bg-slate-100 dark:bg-slate-800/50 py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-6">
                    <h2 class="text-3xl font-black text-primary dark:text-white">Still have questions?</h2>
                    <p class="text-slate-600 dark:text-slate-400 text-lg">Our dedicated support team is here to help you with any inquiries about your shipments, rates, or account management.</p>
                    <div class="grid sm:grid-cols-2 gap-4 pt-4">
                        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm">
                            <span class="material-symbols-outlined text-accent mb-3">support_agent</span>
                            <h4 class="font-bold mb-1">Live Support</h4>
                            <p class="text-sm text-slate-500">Chat with us live from 9 AM to 6 PM (BD Time).</p>
                        </div>
                        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm">
                            <span class="material-symbols-outlined text-primary dark:text-accent mb-3">mail</span>
                            <h4 class="font-bold mb-1">Email Ticket</h4>
                            <p class="text-sm text-slate-500">Average response time is less than 24 hours.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl shadow-xl border border-slate-100 dark:border-slate-800">
                    <h3 class="text-xl font-bold mb-6">Popular Articles</h3>
                    <ul class="space-y-4">
                        @foreach([
                            'How to use our USA Warehouse address?',
                            'Understanding Customs Duty in Bangladesh',
                            'Step-by-step: Creating your first shipment',
                            'Payment methods and currency conversion',
                        ] as $article)
                        <li>
                            <a class="flex items-center gap-3 text-slate-700 dark:text-slate-300 hover:text-accent transition-colors" href="#">
                                <span class="material-symbols-outlined text-slate-400 text-sm">article</span>
                                {{ $article }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact') }}" class="block w-full mt-8 py-4 border-2 border-primary/10 rounded-xl font-bold hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors text-center">Contact Support</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.faq-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const target = document.getElementById(btn.dataset.target);
            const icon = btn.querySelector('.material-symbols-outlined');
            target.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });
    });
</script>
@endsection
