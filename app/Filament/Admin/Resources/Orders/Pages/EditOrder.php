<?php

namespace App\Filament\Admin\Resources\Orders\Pages;

use App\Actions\SendQuote;
use App\Filament\Admin\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('send_quote')
                ->label('Send Quote')
                ->visible(fn (Order $record): bool => in_array($record->status, ['product_requested'])
                )
                ->form([
                    Repeater::make('quoted_items')
                        ->label('Quoted Prices')
                        ->schema([
                            TextInput::make('item_id')->hidden(),
                            TextInput::make('product_name')->disabled()->label('Product'),
                            TextInput::make('quantity')->disabled()->label('Qty'),
                            TextInput::make('quoted_price')
                                ->label('Quoted Price (BDT)')
                                ->numeric()
                                ->prefix('৳')
                                ->required(),
                        ])
                        ->columns(3)
                        ->afterStateUpdated(function ($state, callable $set) {
                            $items = [];
                            foreach ($state as $item) {
                                $items[$item['item_id']] = $item['quoted_price'];
                            }
                            $set('quoted_items_map', $items);
                        }),
                ])
                ->action(function (array $data, Order $record) {
                    $quotedItems = $data['quoted_items_map'] ?? [];

                    $itemsWithPrices = [];
                    foreach ($record->items as $item) {
                        if (isset($quotedItems[$item->id])) {
                            $itemsWithPrices[$item->id] = $quotedItems[$item->id];
                        }
                    }

                    if (empty($itemsWithPrices)) {
                        $this->failure();

                        return;
                    }

                    app(SendQuote::class)->execute($record, $itemsWithPrices);

                    $this->success();
                })
                ->fillForm(fn (Order $record): array => [
                    'quoted_items' => $record->items->map(fn ($item) => [
                        'item_id' => $item->id,
                        'product_name' => $item->product_name,
                        'quantity' => $item->quantity,
                        'quoted_price' => $item->quoted_price ?? 0,
                    ])->toArray(),
                ]),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
