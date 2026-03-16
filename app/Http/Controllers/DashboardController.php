<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Parcel;
use App\Models\Shipment;
use App\Models\StatusLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $activeOrdersCount = $user->orders()->whereNotIn('status', ['delivered', 'cancelled', 'rejected'])->count();
        $parcelsCount = $user->parcels()->whereNotIn('status', ['shipped', 'delivered'])->count();
        $activeShipmentsCount = $user->shipments()->whereNotIn('status', ['delivered'])->count();
        
        $unpaidInvoices = $user->invoices()->whereIn('status', ['draft', 'sent'])->get();
        $unpaidAmount = $unpaidInvoices->sum('total_amount');
        $unpaidCount = $unpaidInvoices->count();

        // Get unified recent activity timeline
        $recentActivity = StatusLog::where(function($query) use ($user) {
                // Order logs
                $query->where('loggable_type', Order::class)
                      ->whereIn('loggable_id', $user->orders()->select('id'));
            })
            ->orWhere(function($query) use ($user) {
                // Parcel logs
                $query->where('loggable_type', Parcel::class)
                      ->whereIn('loggable_id', $user->parcels()->select('id'));
            })
            ->orWhere(function($query) use ($user) {
                // Shipment logs
                $query->where('loggable_type', Shipment::class)
                      ->whereIn('loggable_id', $user->shipments()->select('id'));
            })
            ->with(['loggable'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'activeOrdersCount', 'parcelsCount', 'activeShipmentsCount', 
            'unpaidCount', 'unpaidAmount', 'recentActivity'
        ));
    }
}
