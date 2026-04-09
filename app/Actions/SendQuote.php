<?php

namespace App\Actions;

use App\Models\Order;
use App\Notifications\QuoteSentNotification;
use Exception;
use Illuminate\Support\Facades\DB;

class SendQuote
{
    /**
     * Update order with quoted prices and change status to quote_sent.
     */
    public function execute(Order $order, array $quotedItems): Order
    {
        if ($order->status !== 'pending') {
            throw new Exception('Only pending orders can receive a quote.');
        }

        return DB::transaction(function () use ($order, $quotedItems) {
            foreach ($quotedItems as $itemId => $price) {
                $order->items()->where('id', $itemId)->update(['quoted_price' => $price]);
            }

            $order->update(['status' => 'quote_sent']);

            $order->user->notify(new QuoteSentNotification($order));

            return $order->fresh();
        });
    }
}
