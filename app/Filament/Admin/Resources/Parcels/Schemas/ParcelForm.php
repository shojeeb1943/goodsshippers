<?php

namespace App\Filament\Admin\Resources\Parcels\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ParcelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('warehouse_id')
                    ->relationship('warehouse', 'name')
                    ->required(),
                TextInput::make('tracking_number')
                    ->required(),
                TextInput::make('weight')
                    ->numeric()
                    ->suffix('kg')
                    ->default(null),
                TextInput::make('length')
                    ->numeric()
                    ->suffix('cm')
                    ->default(null),
                TextInput::make('width')
                    ->numeric()
                    ->suffix('cm')
                    ->default(null),
                TextInput::make('height')
                    ->numeric()
                    ->suffix('cm')
                    ->default(null),
                TextInput::make('condition')
                    ->default(null),
                Select::make('status')
                    ->options([
                        'arrived' => 'Arrived',
                        'stored' => 'Stored',
                        'ready_for_shipment' => 'Ready for shipment',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                    ])
                    ->default('arrived')
                    ->required(),
                DatePicker::make('arrival_date')
                    ->default(now()),
                DateTimePicker::make('storage_started_at')
                    ->nullable(),
                // FileUpload configuration for Parcel photos
                \Filament\Forms\Components\Repeater::make('photos')
                    ->relationship('photos') // Expects a 'photos' relation on Parcel
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('file_path')
                            ->image()
                            ->directory('parcels')
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('caption')
                            ->maxLength(255),
                    ])
                    ->columnSpanFull()
                    ->addActionLabel('Add Photo'),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
