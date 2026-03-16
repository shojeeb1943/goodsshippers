<?php

namespace App\Observers;

use App\Models\Parcel;

class ParcelObserver
{
    /**
     * Handle the Parcel "created" event.
     */
    public function created(Parcel $parcel): void
    {
        $parcel->statusLogs()->create([
            'status' => $parcel->status,
            'note' => 'Parcel intake recorded (' . $parcel->tracking_number . ').',
            'actor_id' => auth()->id(),
        ]);
    }

    /**
     * Handle the Parcel "updated" event.
     */
    public function updated(Parcel $parcel): void
    {
        if ($parcel->isDirty('status')) {
            $parcel->statusLogs()->create([
                'status' => $parcel->status,
                'note' => 'Parcel status changed to ' . str_replace('_', ' ', $parcel->status) . '.',
                'actor_id' => auth()->id(),
            ]);
        }
    }
}
