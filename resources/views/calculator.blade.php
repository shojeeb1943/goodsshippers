@extends('layouts.public')

@section('title', 'Shipping Cost Calculator')
@section('meta_description', 'Calculate your exact shipping cost from USA, UK, or Malaysia to Bangladesh before you buy.')

@section('content')
    <!-- Hero -->
    <section class="bg-primary py-16 text-white text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-black mb-4">Shipping Cost Calculator</h1>
            <p class="text-slate-300 text-lg">Get an instant estimate based on weight, dimensions, and your destination.</p>
        </div>
    </section>

    <!-- Calculator -->
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-4">
        <div class="flex flex-col-reverse gap-8 lg:grid lg:grid-cols-3 lg:gap-12">
                <!-- Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-8 border border-slate-100 dark:border-slate-800 shadow-sm">
                        <h2 class="text-2xl font-bold text-primary dark:text-white mb-8">Package Details</h2>
                        <form id="calc-form" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">From (Warehouse)</label>
                                    <select id="warehouse" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-accent focus:border-accent p-3">
                                        <option value="usa">🇺🇸 USA (New Jersey)</option>
                                        <option value="uk">🇬🇧 UK (London)</option>
                                        <option value="malaysia">🇲🇾 Malaysia (Kuala Lumpur)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Shipping Method</label>
                                    <select id="method" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-accent focus:border-accent p-3">
                                        <option value="air">✈️ Air Freight</option>
                                        <option value="sea">🚢 Sea Freight</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Product Type</label>
                                <select class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-accent focus:border-accent p-3">
                                    <option>Electronics</option>
                                    <option>Clothing & Fashion</option>
                                    <option>Health & Beauty</option>
                                    <option>Books & Media</option>
                                    <option>Home & Garden</option>
                                    <option>General Goods</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Actual Weight (kg)</label>
                                <input id="weight" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-accent focus:border-accent p-3" placeholder="e.g. 2.5" type="number" min="0.1" step="0.1" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Dimensions (cm) — for volumetric weight</label>
                                <div class="grid grid-cols-3 gap-2 sm:gap-4">
                                    <div>
                                        <input id="length" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-accent p-3" placeholder="Length" type="number" min="1" />
                                    </div>
                                    <div>
                                        <input id="width" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-accent p-3" placeholder="Width" type="number" min="1" />
                                    </div>
                                    <div>
                                        <input id="height" class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-accent p-3" placeholder="Height" type="number" min="1" />
                                    </div>
                                </div>
                                <p class="text-xs text-slate-400 mt-2">Volumetric formula: (L × W × H) ÷ 5000 = kg</p>
                            </div>
                            <button type="button" id="calculate-btn" class="w-full bg-accent text-white font-bold py-4 rounded-lg hover:brightness-110 transition-all shadow-lg shadow-accent/20">
                                Calculate Shipping Cost
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Result -->
                <div class="space-y-6">
                    <!-- Estimate Card -->
                    <div id="result-card" class="bg-white dark:bg-slate-900 rounded-2xl p-8 border-2 border-dashed border-slate-200 dark:border-slate-800 shadow-sm text-center hidden">
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">Estimated Cost</p>
                        <p id="result-price" class="text-5xl font-black text-primary dark:text-white mb-1">--</p>
                        <p id="result-label" class="text-slate-500 text-sm mb-6">USD (approx)</p>
                        <div class="grid grid-cols-2 gap-4 text-left mb-6">
                            <div class="bg-slate-50 dark:bg-slate-800 p-3 rounded-lg">
                                <p class="text-xs text-slate-500">Chargeable Weight</p>
                                <p id="chargeable-weight" class="font-bold">--</p>
                            </div>
                            <div class="bg-slate-50 dark:bg-slate-800 p-3 rounded-lg">
                                <p class="text-xs text-slate-500">Rate/kg</p>
                                <p id="rate-per-kg" class="font-bold">--</p>
                            </div>
                        </div>
                        <a href="{{ route('register') }}" class="block w-full py-3 bg-primary text-white font-bold rounded-lg hover:bg-primary/90">Create Account & Ship</a>
                    </div>

                    <!-- Info -->
                    <div class="bg-primary/5 dark:bg-slate-800/50 rounded-2xl p-6">
                        <h4 class="font-bold text-primary dark:text-white mb-4">Rate Card</h4>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between"><span>🇺🇸 USA Air</span><span class="font-bold">$14/kg</span></div>
                            <div class="flex justify-between"><span>🇺🇸 USA Sea</span><span class="font-bold">$4.5/kg</span></div>
                            <div class="flex justify-between"><span>🇬🇧 UK Air</span><span class="font-bold">£11/kg</span></div>
                            <div class="flex justify-between"><span>🇬🇧 UK Sea</span><span class="font-bold">£3.5/kg</span></div>
                            <div class="flex justify-between"><span>🇲🇾 MY Air</span><span class="font-bold">RM 35/kg</span></div>
                            <div class="flex justify-between"><span>🇲🇾 MY Sea</span><span class="font-bold">RM 12/kg</span></div>
                        </div>
                    </div>

                    <div class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-2xl p-6 text-sm text-amber-800 dark:text-amber-200">
                        <p class="font-bold mb-2">⚠️ Note</p>
                        <p>Estimates are approximate. Final cost may vary based on customs, packaging, and actual conditions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    const rates = {
        usa: { air: 14, sea: 4.5, currency: 'USD' },
        uk: { air: 11, sea: 3.5, currency: 'GBP' },
        malaysia: { air: 35, sea: 12, currency: 'MYR' },
    };

    document.getElementById('calculate-btn').addEventListener('click', () => {
        const warehouse = document.getElementById('warehouse').value;
        const method = document.getElementById('method').value;
        const weight = parseFloat(document.getElementById('weight').value) || 0;
        const l = parseFloat(document.getElementById('length').value) || 0;
        const w = parseFloat(document.getElementById('width').value) || 0;
        const h = parseFloat(document.getElementById('height').value) || 0;

        const volumetric = (l * w * h) / 5000;
        const chargeable = Math.max(weight, volumetric) || 0;
        const rate = rates[warehouse][method];
        const total = (chargeable * rate).toFixed(2);

        document.getElementById('result-card').classList.remove('hidden');
        document.getElementById('result-price').textContent = `${rates[warehouse].currency} ${total}`;
        document.getElementById('chargeable-weight').textContent = chargeable.toFixed(2) + ' kg';
        document.getElementById('rate-per-kg').textContent = `${rates[warehouse].currency} ${rate}`;
    });
</script>
@endsection
