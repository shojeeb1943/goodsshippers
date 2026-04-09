<?php

namespace App\Filament\Admin\Resources\Parcels\Pages;

use App\Filament\Admin\Resources\Parcels\ParcelResource;
use App\Models\Parcel;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;

class EditParcel extends EditRecord
{
    protected static string $resource = ParcelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('log_arrival')
                ->label('Log Arrival')
                ->visible(fn (Parcel $record): bool => $record->status === null || $record->status === 'arrived'
                )
                ->form([
                    DatePicker::make('arrival_date')
                        ->label('Arrival Date')
                        ->default(now()->toDateString())
                        ->required(),
                    Select::make('condition')
                        ->label('Condition')
                        ->options([
                            'new' => 'New',
                            'used' => 'Used',
                            'damaged' => 'Damaged',
                        ])
                        ->default('new')
                        ->required(),
                    TextInput::make('notes')
                        ->label('Notes'),
                ])
                ->action(function (array $data, Parcel $record) {
                    $record->update([
                        'status' => 'arrived',
                        'arrival_date' => $data['arrival_date'],
                        'condition' => $data['condition'],
                        'notes' => $data['notes'],
                        'storage_started_at' => now(),
                    ]);
                    $this->success();
                }),
            Action::make('update_dimensions')
                ->label('Update Weight/Dimensions')
                ->visible(fn (Parcel $record): bool => in_array($record->status, ['arrived', 'stored'])
                )
                ->form([
                    TextInput::make('weight')
                        ->label('Weight (kg)')
                        ->numeric()
                        ->step(0.01)
                        ->required(),
                    TextInput::make('length')
                        ->label('Length (cm)')
                        ->numeric()
                        ->step(0.01),
                    TextInput::make('width')
                        ->label('Width (cm)')
                        ->numeric()
                        ->step(0.01),
                    TextInput::make('height')
                        ->label('Height (cm)')
                        ->numeric()
                        ->step(0.01),
                ])
                ->fillForm(fn (Parcel $record): array => [
                    'weight' => $record->weight,
                    'length' => $record->length,
                    'width' => $record->width,
                    'height' => $record->height,
                ])
                ->action(function (array $data, Parcel $record) {
                    $record->update($data);
                    $this->success();
                }),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
