<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        return view('tracking.index');
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $request->validate(['tracking_number' => 'required|string|max:255']);
        $trackingNumber = $request->input('tracking_number');

        // Look for shipment first
        $shipment = \App\Models\Shipment::with(['statusLogs' => function($q) { $q->orderBy('created_at', 'desc'); }])
            ->where('shipment_number', $trackingNumber)
            ->first();

        if ($shipment) {
            return view('tracking.index', ['entity' => $shipment, 'type' => 'Shipment', 'tracking_number' => $trackingNumber]);
        }

        // Look for parcel
        $parcel = \App\Models\Parcel::with(['statusLogs' => function($q) { $q->orderBy('created_at', 'desc'); }])
            ->where('tracking_number', $trackingNumber)
            ->first();

        if ($parcel) {
            return view('tracking.index', ['entity' => $parcel, 'type' => 'Parcel', 'tracking_number' => $trackingNumber]);
        }

        return redirect()->route('tracking.index')->with('error', 'No shipment or parcel found with that tracking number.');
    }
}
