<?php

namespace App\Filament\Admin\Resources\Parcels\Pages;

use App\Filament\Admin\Resources\Parcels\ParcelResource;
use Filament\Resources\Pages\CreateRecord;

class CreateParcel extends CreateRecord
{
    protected static string $resource = ParcelResource::class;

    protected function afterCreate(): void
    {
        /** @var \App\Models\Parcel $parcel */
        $parcel = $this->record;

        // Ensure the parcel has an arrival date and storage start set if not already
        if (!$parcel->arrival_date) {
            $parcel->update([
                'arrival_date' => now(),
                'storage_started_at' => now(),
            ]);
        } elseif (!$parcel->storage_started_at) {
            $parcel->update(['storage_started_at' => now()]);
        }

        // Notify user
        if ($parcel->user) {
            $parcel->user->notify(new \App\Notifications\ParcelArrivedNotification($parcel));
        }
    }
}
