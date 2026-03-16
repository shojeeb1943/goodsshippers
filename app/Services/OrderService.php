<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
// use App\Notifications\OrderCreatedNotification; // To be implemented

class OrderService
{
    /**
     * Create a new "Shop For Me" order with its items.
     *
     * @param array $data Assumes 'notes' and 'items' array
     * @param User $user
     * @return Order
     */
    public function create(array $data, User $user): Order
    {
        return DB::transaction(function () use ($data, $user) {
            $order = $user->orders()->create([
                'status' => 'pending',
                'notes'  => $data['notes'] ?? null,
            ]);

            foreach ($data['items'] as $item) {
                $order->items()->create([
                    'product_url'  => $item['product_url'],
                    'product_name' => $item['product_name'],
                    'quantity'     => $item['quantity'] ?? 1,
                    // quoted_price is null until staff provides a quote
                ]);
            }

            // TODO: Dispatch OrderCreatedNotification
            // $user->notify(new OrderCreatedNotification($order));

            return $order;
        });
    }
}
