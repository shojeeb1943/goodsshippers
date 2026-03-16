<?php

namespace App\Actions;

use App\Models\Order;
use Exception;

class ApproveQuote
{
    /**
     * Customer approves the quote and status changes to quote_approved.
     */
    public function execute(Order $order): Order
    {
        if ($order->status !== 'quote_sent') {
            throw new Exception("Cannot approve an order that doesn't have a pending quote.");
        }

        $order->update(['status' => 'quote_approved']);

        // Status log is automatically tracked via the Observer

        return $order;
    }
}
