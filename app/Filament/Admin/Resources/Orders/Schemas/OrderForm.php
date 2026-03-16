<?php

namespace App\Filament\Admin\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('status')
                    ->options([
            'product_requested' => 'Product requested',
            'quote_sent' => 'Quote sent',
            'quote_approved' => 'Quote approved',
            'quote_rejected' => 'Quote rejected',
            'order_purchased' => 'Order purchased',
            'cancelled' => 'Cancelled',
        ])
                    ->default('product_requested')
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
