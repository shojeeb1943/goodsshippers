<?php

namespace App\Observers;

use App\Models\Shipment;

class ShipmentObserver
{
    /**
     * Handle the Shipment "created" event.
     */
    public function created(Shipment $shipment): void
    {
        $shipment->statusLogs()->create([
            'status' => $shipment->status,
            'note' => 'Shipment created (' . $shipment->shipment_number . ').',
            'actor_id' => auth()->id(),
        ]);
    }

    /**
     * Handle the Shipment "updated" event.
     */
    public function updated(Shipment $shipment): void
    {
        if ($shipment->isDirty('status')) {
            $shipment->statusLogs()->create([
                'status' => $shipment->status,
                'note' => 'Shipment status changed to ' . str_replace('_', ' ', $shipment->status) . '.',
                'actor_id' => auth()->id(),
            ]);
        }
    }
}
