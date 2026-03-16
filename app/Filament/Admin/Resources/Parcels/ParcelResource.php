<?php

namespace App\Filament\Admin\Resources\Parcels;

use App\Filament\Admin\Resources\Parcels\Pages\CreateParcel;
use App\Filament\Admin\Resources\Parcels\Pages\EditParcel;
use App\Filament\Admin\Resources\Parcels\Pages\ListParcels;
use App\Filament\Admin\Resources\Parcels\Schemas\ParcelForm;
use App\Filament\Admin\Resources\Parcels\Tables\ParcelsTable;
use App\Models\Parcel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParcelResource extends Resource
{
    protected static ?string $model = Parcel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getGloballySearchableAttributes(): array
    {
        return ['tracking_number', 'user.name'];
    }

    public static function form(Schema $schema): Schema
    {
        return ParcelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ParcelsTable::configure($table);
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
            'index' => ListParcels::route('/'),
            'create' => CreateParcel::route('/create'),
            'edit' => EditParcel::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
