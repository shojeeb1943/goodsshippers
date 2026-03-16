<?php

namespace App\Actions;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;
// use App\Notifications\InvoiceGeneratedNotification; // To be implemented

class GenerateInvoice
{
    /**
     * Generate a draft invoice for a Shipment.
     */
    public function forShipment(Shipment $shipment, array $lineItems = []): Invoice
    {
        return DB::transaction(function () use ($shipment, $lineItems) {
            $invoice = Invoice::create([
                'user_id' => $shipment->user_id,
                'shipment_id' => $shipment->id,
                'status' => 'draft',
                'total_amount' => 0,
            ]);

            $invoice->update([
                'invoice_number' => 'INV-' . str_pad($invoice->id, 6, '0', STR_PAD_LEFT),
            ]);

            $total = 0;
            if (empty($lineItems)) {
                // Default placeholder items
                $lineItems = [
                    ['description' => 'Freight Charges (Chargeable Weight: ' . $shipment->chargeable_weight . ' kg)', 'quantity' => 1, 'unit_price' => 0],
                    ['description' => 'Handling Fee', 'quantity' => 1, 'unit_price' => 0],
                ];
            }

            foreach ($lineItems as $item) {
                $itemTotal = ($item['quantity'] ?? 1) * ($item['unit_price'] ?? 0);
                $invoice->items()->create([
                    'description' => $item['description'],
                    'quantity' => $item['quantity'] ?? 1,
                    'unit_price' => $item['unit_price'] ?? 0,
                    'total' => $itemTotal,
                ]);
                $total += $itemTotal;
            }

            $invoice->update(['total_amount' => $total]);

            return $invoice;
        });
    }

    /**
     * Generate a draft invoice for a Shop For Me Order.
     */
    public function forOrder(Order $order): Invoice
    {
        return DB::transaction(function () use ($order) {
            $invoice = Invoice::create([
                'user_id' => $order->user_id,
                'order_id' => $order->id,
                'status' => 'draft',
                'total_amount' => 0,
            ]);

            $invoice->update([
                'invoice_number' => 'INV-' . str_pad($invoice->id, 6, '0', STR_PAD_LEFT),
            ]);

            $total = 0;
            foreach ($order->items as $orderItem) {
                $itemTotal = $orderItem->quantity * ($orderItem->quoted_price ?? 0);
                $invoice->items()->create([
                    'description' => $orderItem->product_name,
                    'quantity' => $orderItem->quantity,
                    'unit_price' => $orderItem->quoted_price ?? 0,
                    'total' => $itemTotal,
                ]);
                $total += $itemTotal;
            }

            // Add standard service fee placeholder
            $invoice->items()->create([
                'description' => 'Service Fee (Shop For Me)',
                'quantity' => 1,
                'unit_price' => 0,
                'total' => 0,
            ]);

            $invoice->update(['total_amount' => $total]);

            return $invoice;
        });
    }
}
