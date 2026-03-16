<?php

namespace App\Filament\Admin\Resources\ShippingModes\Pages;

use App\Filament\Admin\Resources\ShippingModes\ShippingModeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditShippingMode extends EditRecord
{
    protected static string $resource = ShippingModeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
