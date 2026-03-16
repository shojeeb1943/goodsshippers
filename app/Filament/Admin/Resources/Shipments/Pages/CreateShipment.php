<?php

namespace App\Filament\Admin\Resources\Shipments\Pages;

use App\Filament\Admin\Resources\Shipments\ShipmentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateShipment extends CreateRecord
{
    protected static string $resource = ShipmentResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $action = app(\App\Actions\CreateShipment::class);

        return $action->execute(
            userId: $data['user_id'],
            warehouseId: $data['warehouse_id'],
            shippingModeId: $data['shipping_mode_id'],
            parcelIds: $data['parcel_ids'] ?? [],
            notes: $data['notes'] ?? null
        );
    }
}
