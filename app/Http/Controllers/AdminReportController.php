<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Parcel;
use App\Models\Shipment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', '30');

        $startDate = Carbon::now()->subDays((int) $period);

        $revenue = Invoice::where('status', 'paid')
            ->where('created_at', '>=', $startDate)
            ->sum('total_amount');

        $revenueByMonth = Invoice::where('status', 'paid')
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->selectRaw('SUM(total_amount) as total, MONTH(created_at) as month')
            ->groupBy('month')
            ->pluck('total', 'month');

        $shipmentVolume = Shipment::where('created_at', '>=', $startDate)->count();

        $shipmentsByStatus = Shipment::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $shipmentsByWarehouse = Shipment::with('warehouse')
            ->where('created_at', '>=', $startDate)
            ->get()
            ->groupBy('warehouse_id')
            ->map(fn ($group) => $group->count());

        $topUsers = User::withCount('orders')
            ->orderByDesc('orders_count')
            ->limit(10)
            ->get();

        $recentShipments = Shipment::with(['user', 'warehouse', 'shippingMode'])
            ->latest()
            ->limit(10)
            ->get();

        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalParcels = Parcel::count();

        return view('admin.reports', compact(
            'revenue',
            'revenueByMonth',
            'shipmentVolume',
            'shipmentsByStatus',
            'shipmentsByWarehouse',
            'topUsers',
            'recentShipments',
            'totalUsers',
            'totalOrders',
            'totalParcels',
            'period'
        ));
    }
}
