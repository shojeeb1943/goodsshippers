<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CalculateStorageFeesJob implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(\App\Services\StorageFeeService $feeService): void
    {
        // Find parcels that have been in storage for more than 10 days
        // and are not yet shipped.
        $parcels = \App\Models\Parcel::whereNotNull('storage_started_at')
            ->whereIn('status', ['arrived', 'stored'])
            ->where('storage_started_at', '<', now()->subDays(10))
            ->get();

        foreach ($parcels as $parcel) {
            $fee = $feeService->calculateFee($parcel);

            if ($fee > 0) {
                // Find an open, standalone draft invoice for the user
                $invoice = \App\Models\Invoice::firstOrCreate(
                    [
                        'user_id' => $parcel->user_id,
                        'status' => 'draft',
                        'shipment_id' => null,
                        'order_id' => null,
                    ],
                    [
                        'invoice_number' => 'TMP', // Will be updated below
                        'total_amount' => 0,
                    ]
                );

                if ($invoice->invoice_number === 'TMP') {
                    $invoice->update([
                        'invoice_number' => 'INV-' . str_pad($invoice->id, 6, '0', STR_PAD_LEFT),
                    ]);
                }

                // Upsert the line item for this specific parcel
                $invoice->items()->updateOrCreate(
                    [
                        'description' => 'Storage Fee for Parcel Tracking #' . $parcel->tracking_number,
                    ],
                    [
                        'quantity' => 1,
                        'unit_price' => $fee,
                        'total' => $fee,
                    ]
                );

                // Update the invoice total amount
                $invoice->update([
                    'total_amount' => $invoice->items()->sum('total')
                ]);
            }
        }
    }
}
