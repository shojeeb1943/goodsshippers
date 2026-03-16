<?php

namespace App\Filament\Admin\Resources\ShippingModes\Pages;

use App\Filament\Admin\Resources\ShippingModes\ShippingModeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListShippingModes extends ListRecords
{
    protected static string $resource = ShippingModeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
