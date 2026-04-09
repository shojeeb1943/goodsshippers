@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')
@section('page-subtitle', 'Here\'s what\'s happening with your business today.')

@section('content')
<div class="space-y-6">

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
        {{-- Total Users --}}
        <div class="stat-card group hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-slate-500 font-medium mb-1">Total Users</p>
                    <p class="text-3xl font-black text-slate-800">{{ number_format($stats['total_users']) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-blue-600">group</span>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-1 text-xs text-brand-green font-semibold">
                <span class="material-symbols-outlined text-sm">trending_up</span>
                Registered customers
            </div>
        </div>

        {{-- Total Orders --}}
        <div class="stat-card group hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-slate-500 font-medium mb-1">Total Orders</p>
                    <p class="text-3xl font-black text-slate-800">{{ number_format($stats['total_orders']) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-amber-600">shopping_bag</span>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-1 text-xs text-slate-400 font-semibold">
                <span class="material-symbols-outlined text-sm">receipt</span>
                All time orders
            </div>
        </div>

        {{-- Pending Shipments --}}
        <div class="stat-card group hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-slate-500 font-medium mb-1">Pending Shipments</p>
                    <p class="text-3xl font-black text-slate-800">{{ number_format($stats['pending_shipments']) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-orange-500">local_shipping</span>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-1 text-xs text-orange-500 font-semibold">
                <span class="material-symbols-outlined text-sm">schedule</span>
                Awaiting dispatch
            </div>
        </div>

        {{-- Open Tickets --}}
        <div class="stat-card group hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-slate-500 font-medium mb-1">Open Tickets</p>
                    <p class="text-3xl font-black text-slate-800">{{ number_format($stats['open_tickets']) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-purple-600">support_agent</span>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-1 text-xs {{ $stats['open_tickets'] > 5 ? 'text-red-500' : 'text-slate-400' }} font-semibold">
                <span class="material-symbols-outlined text-sm">{{ $stats['open_tickets'] > 5 ? 'warning' : 'check_circle' }}</span>
                {{ $stats['open_tickets'] > 5 ? 'Needs attention' : 'All clear' }}
            </div>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-800">Recent Orders</h2>
                <p class="text-xs text-slate-400 mt-0.5">Latest 8 orders across all users</p>
            </div>
            <a href="#" class="text-sm font-semibold text-brand-blue hover:text-brand-orange transition-colors inline-flex items-center gap-1">
                View all <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left">
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">#Order</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs text-slate-500">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-brand-blue/10 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-brand-blue text-sm">person</span>
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-700 text-sm">{{ $order->user->name ?? 'Unknown' }}</p>
                                    <p class="text-xs text-slate-400">{{ $order->user->email ?? '' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-500 text-xs">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = [
                                    'pending'   => 'bg-amber-100 text-amber-700',
                                    'approved'  => 'bg-blue-100 text-blue-700',
                                    'shipped'   => 'bg-purple-100 text-purple-700',
                                    'delivered' => 'bg-green-100 text-green-700',
                                    'rejected'  => 'bg-red-100 text-red-700',
                                ];
                                $colorClass = $statusColors[$order->status ?? 'pending'] ?? 'bg-slate-100 text-slate-600';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $colorClass }}">
                                {{ ucfirst($order->status ?? 'pending') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="inline-flex items-center gap-1 text-xs font-semibold text-brand-blue hover:text-brand-orange transition-colors">
                                View <span class="material-symbols-outlined text-xs">open_in_new</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                            <span class="material-symbols-outlined text-4xl block mb-2">inbox</span>
                            No orders yet
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ([
            ['icon' => 'person_add', 'label' => 'Add User', 'color' => 'blue', 'bg' => 'bg-blue-50 text-blue-600'],
            ['icon' => 'add_shopping_cart', 'label' => 'New Order', 'color' => 'amber', 'bg' => 'bg-amber-50 text-amber-600'],
            ['icon' => 'receipt', 'label' => 'Create Invoice', 'color' => 'green', 'bg' => 'bg-green-50 text-green-600'],
            ['icon' => 'support', 'label' => 'View Tickets', 'color' => 'purple', 'bg' => 'bg-purple-50 text-purple-600'],
        ] as $action)
        <a href="#" class="stat-card flex flex-col items-center justify-center py-6 gap-3 hover:shadow-md transition-all hover:-translate-y-0.5 text-center">
            <div class="w-12 h-12 rounded-2xl {{ $action['bg'] }} flex items-center justify-center">
                <span class="material-symbols-outlined">{{ $action['icon'] }}</span>
            </div>
            <span class="text-sm font-semibold text-slate-700">{{ $action['label'] }}</span>
        </a>
        @endforeach
    </div>

</div>
@endsection
