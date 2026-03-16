<?php

namespace App\Filament\Admin\Resources\ShippingModes;

use App\Filament\Admin\Resources\ShippingModes\Pages\CreateShippingMode;
use App\Filament\Admin\Resources\ShippingModes\Pages\EditShippingMode;
use App\Filament\Admin\Resources\ShippingModes\Pages\ListShippingModes;
use App\Filament\Admin\Resources\ShippingModes\Schemas\ShippingModeForm;
use App\Filament\Admin\Resources\ShippingModes\Tables\ShippingModesTable;
use App\Models\ShippingMode;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ShippingModeResource extends Resource
{
    protected static ?string $model = ShippingMode::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ShippingModeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShippingModesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListShippingModes::route('/'),
            'create' => CreateShippingMode::route('/create'),
            'edit' => EditShippingMode::route('/{record}/edit'),
        ];
    }
}
