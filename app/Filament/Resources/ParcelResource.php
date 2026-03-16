<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParcelResource\Pages;
use App\Models\Parcel;
use App\Models\Warehouse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ParcelResource extends Resource
{
    protected static ?string $model = Parcel::class;
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Operations';
    protected static ?int $navigationSort = 2;

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
            Forms\Components\TextInput::make('tracking_number')->required()->unique(ignoreRecord: true),
            Forms\Components\Select::make('status')
                ->options(Parcel::STATUSES)
                ->required(),
            Forms\Components\TextInput::make('weight')->numeric()->suffix('kg'),
            Forms\Components\TextInput::make('length')->numeric()->suffix('cm'),
            Forms\Components\TextInput::make('width')->numeric()->suffix('cm'),
            Forms\Components\TextInput::make('height')->numeric()->suffix('cm'),
            Forms\Components\TextInput::make('condition'),
            Forms\Components\DatePicker::make('arrival_date'),
            Forms\Components\DateTimePicker::make('storage_started_at'),
            Forms\Components\Textarea::make('notes')->columnSpanFull(),
            Forms\Components\FileUpload::make('photos')
                ->multiple()
                ->image()
                ->directory('parcels')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tracking_number')->searchable(),
                Tables\Columns\TextColumn::make('user.name')->searchable(),
                Tables\Columns\TextColumn::make('user.warehouse_suite_id')->label('Suite ID'),
                Tables\Columns\TextColumn::make('warehouse.name'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'info'    => 'arrived',
                        'warning' => 'stored',
                        'primary' => 'ready_for_shipment',
                        'success' => ['shipped', 'delivered'],
                    ]),
                Tables\Columns\TextColumn::make('weight')->suffix(' kg'),
                Tables\Columns\TextColumn::make('arrival_date')->date(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options(Parcel::STATUSES),
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
            'index'  => Pages\ListParcels::route('/'),
            'create' => Pages\CreateParcel::route('/create'),
            'edit'   => Pages\EditParcel::route('/{record}/edit'),
        ];
    }
}
