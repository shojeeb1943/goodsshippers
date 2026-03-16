<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = auth()->user()->shipments()->with('shippingMode')->latest()->paginate(10);
        return view('shipments.index', compact('shipments'));
    }

    public function show(Shipment $shipment)
    {
        if ($shipment->user_id !== auth()->id()) {
            abort(403);
        }

        $shipment->load('warehouse', 'shippingMode', 'parcels', 'invoices', 'statusLogs.actor');
        return view('shipments.show', compact('shipment'));
    }
}
