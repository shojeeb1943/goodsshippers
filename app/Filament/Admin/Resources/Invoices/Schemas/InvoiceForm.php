<?php

namespace App\Filament\Admin\Resources\Invoices\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class InvoiceForm
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
                Select::make('order_id')
                    ->relationship('order', 'id')
                    ->searchable()
                    ->nullable(),
                Select::make('shipment_id')
                    ->relationship('shipment', 'shipment_number')
                    ->searchable()
                    ->nullable(),
                TextInput::make('invoice_number')
                    ->disabled()
                    ->hiddenOn('create')
                    ->dehydrated(false),
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'sent' => 'Sent',
                        'paid' => 'Paid',
                        'cancelled' => 'Cancelled'
                    ])
                    ->default('draft')
                    ->required(),
                TextInput::make('total_amount')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(false)
                    ->helperText('Summed automatically from line items.'),
                DatePicker::make('due_date'),
                DateTimePicker::make('paid_at'),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),

                \Filament\Forms\Components\Section::make('Line Items')
                    ->schema([
                        \Filament\Forms\Components\Repeater::make('items')
                            ->relationship('items')
                            ->schema([
                                TextInput::make('description')->required(),
                                TextInput::make('quantity')
                                    ->numeric()
                                    ->default(1)
                                    ->required(),
                                TextInput::make('unit_price')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                            ])
                            ->columns(3)
                            ->addActionLabel('Add Item')
                    ]),
            ]);
    }
}
