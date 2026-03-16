<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $order->statusLogs()->create([
            'status' => $order->status,
            'note' => 'Order (' . $order->id . ') created.',
            'actor_id' => auth()->id(),
        ]);
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if ($order->isDirty('status')) {
            $order->statusLogs()->create([
                'status' => $order->status,
                'note' => 'Order status changed to ' . str_replace('_', ' ', $order->status) . '.',
                'actor_id' => auth()->id(),
            ]);
        }
    }
}
