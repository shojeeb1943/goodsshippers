<?php

namespace App\Filament\Admin\Resources\Orders\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('product_name')->label('Product'),
                TextEntry::make('product_url')->label('URL')->url(),
                TextEntry::make('quantity')->label('Quantity'),
                TextEntry::make('quoted_price')
                    ->label('Quoted Price')
                    ->money('BDT'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product_name')->label('Product'),
                TextColumn::make('quantity')->label('Qty'),
                TextColumn::make('quoted_price')
                    ->label('Quoted Price')
                    ->money('BDT'),
            ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('product_name')->label('Product Name'),
                TextInput::make('product_url')->label('Product URL'),
                TextInput::make('quantity')->label('Quantity')->numeric(),
                TextInput::make('quoted_price')->label('Quoted Price')->numeric(),
                TextInput::make('notes')->label('Notes'),
            ]);
    }
}
