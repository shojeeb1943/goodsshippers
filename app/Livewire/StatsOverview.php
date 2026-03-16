<?php

namespace App\Livewire;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Orders', \App\Models\Order::whereIn('status', ['pending', 'processing', 'quote_sent'])->count())
                ->description('Active purchase orders')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('info'),
            Stat::make('Total Revenue', '৳' . number_format(\App\Models\Invoice::where('status', 'paid')->sum('total_amount'), 2))
                ->description('Paid invoices total')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Active Shipments', \App\Models\Shipment::whereIn('status', ['in_transit', 'customs_clearance', 'out_for_delivery'])->count())
                ->description('Shipments in transit')
                ->descriptionIcon('heroicon-m-truck')
                ->color('warning'),
            Stat::make('Open Tickets', \App\Models\Ticket::where('status', 'open')->count())
                ->description('Pending support items')
                ->descriptionIcon('heroicon-m-lifebuoy')
                ->color('danger'),
        ];
    }
}
