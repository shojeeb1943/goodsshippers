<?php

namespace App\Filament\Admin\Resources\Invoices\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InvoiceItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('description')->label('Description'),
                TextEntry::make('quantity')->label('Qty'),
                TextEntry::make('unit_price')->label('Unit Price')->money('BDT'),
                TextEntry::make('total')->label('Total')->money('BDT'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('description')->label('Description'),
                TextColumn::make('quantity')->label('Qty'),
                TextColumn::make('unit_price')->label('Unit Price')->money('BDT'),
                TextColumn::make('total')->label('Total')->money('BDT'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('description')->label('Description')->required(),
                TextInput::make('quantity')->label('Quantity')->numeric()->default(1),
                TextInput::make('unit_price')->label('Unit Price')->numeric(),
            ]);
    }
}
