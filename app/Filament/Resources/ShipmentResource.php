<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShipmentResource\Pages;
use App\Models\Shipment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ShipmentResource extends Resource
{
    protected static ?string $model = Shipment::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Operations';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),
            Forms\Components\Select::make('warehouse_id')
                ->relationship('warehouse', 'name')
                ->required(),
            Forms\Components\Select::make('shipping_mode_id')
                ->relationship('shippingMode', 'name')
                ->required(),
            Forms\Components\TextInput::make('shipment_number')->disabled(),
            Forms\Components\Select::make('status')
                ->options(Shipment::STATUSES)
                ->required(),
            Forms\Components\TextInput::make('actual_weight')->numeric()->suffix('kg'),
            Forms\Components\TextInput::make('volumetric_weight')->numeric()->suffix('kg')->disabled(),
            Forms\Components\TextInput::make('chargeable_weight')->numeric()->suffix('kg')->disabled(),
            Forms\Components\Textarea::make('notes')->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('shipment_number')->searchable(),
                Tables\Columns\TextColumn::make('user.name')->searchable(),
                Tables\Columns\TextColumn::make('shippingMode.name'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray'    => 'created',
                        'warning' => 'in_transit',
                        'info'    => 'customs_clearance',
                        'primary' => 'out_for_delivery',
                        'success' => 'delivered',
                    ]),
                Tables\Columns\TextColumn::make('chargeable_weight')->suffix(' kg'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options(Shipment::STATUSES),
                Tables\Filters\SelectFilter::make('warehouse')->relationship('warehouse', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListShipments::route('/'),
            'create' => Pages\CreateShipment::route('/create'),
            'edit'   => Pages\EditShipment::route('/{record}/edit'),
        ];
    }
}
