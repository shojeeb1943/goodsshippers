<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->parcels()->with('warehouse');

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('tracking_number', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%')
                    ->orWhere('courier', 'like', '%'.$request->search.'%');
            });
        }

        $parcels = $query->latest()->paginate(10);

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
