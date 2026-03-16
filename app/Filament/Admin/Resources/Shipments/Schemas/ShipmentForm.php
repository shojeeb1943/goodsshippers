<?php

namespace App\Filament\Admin\Resources\Shipments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ShipmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->live() // Trigger updates when user changes
                    ->required(),
                Select::make('warehouse_id')
                    ->relationship('warehouse', 'name')
                    ->required(),
                Select::make('shipping_mode_id')
                    ->relationship('shippingMode', 'name')
                    ->required(),
                
                // Parcel Selector: only show stored parcels belonging to the selected user
                Select::make('parcel_ids')
                    ->label('Attach Parcels')
                    ->multiple()
                    ->options(function (\Filament\Forms\Get $get) {
                        if (!$get('user_id')) {
                            return [];
                        }
                        return \App\Models\Parcel::where('user_id', $get('user_id'))
                            ->where('status', 'stored')
                            ->pluck('tracking_number', 'id');
                    })
                    ->preload()
                    ->dehydrated(false)
                    ->required(),

                // Hide generated fields from the Create form context
                TextInput::make('shipment_number')
                    ->disabled()
                    ->dehydrated(false)
                    ->hiddenOn('create'),
                Select::make('status')
                    ->options([
                        'created' => 'Created',
                        'in_transit' => 'In transit',
                        'customs_clearance' => 'Customs clearance',
                        'out_for_delivery' => 'Out for delivery',
                        'delivered' => 'Delivered',
                    ])
                    ->default('created')
                    ->hiddenOn('create')
                    ->required(),
                TextInput::make('actual_weight')
                    ->numeric()
                    ->suffix('kg')
                    ->disabled()
                    ->hiddenOn('create'),
                TextInput::make('volumetric_weight')
                    ->numeric()
                    ->suffix('kg')
                    ->disabled()
                    ->hiddenOn('create'),
                TextInput::make('chargeable_weight')
                    ->numeric()
                    ->suffix('kg')
                    ->disabled()
                    ->hiddenOn('create'),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
