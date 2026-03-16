<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    public function index()
    {
        $parcels = auth()->user()->parcels()->with('warehouse')->latest()->paginate(10);
        return view('parcels.index', compact('parcels'));
    }

    public function show(Parcel $parcel)
    {
        if ($parcel->user_id !== auth()->id()) {
            abort(403);
        }

        $parcel->load('warehouse', 'photos', 'statusLogs.actor');
        return view('parcels.show', compact('parcel'));
    }
}
