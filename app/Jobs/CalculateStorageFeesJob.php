<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

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
                DB::transaction(function () use ($parcel, $fee) {
                    // Lock the row to prevent concurrent invoice creation for same user
                    $invoice = \App\Models\Invoice::where([
                        'user_id'     => $parcel->user_id,
                        'status'      => 'draft',
                        'shipment_id' => null,
                        'order_id'    => null,
                    ])->lockForUpdate()->first();

                    if (! $invoice) {
                        $invoice = \App\Models\Invoice::create([
                            'user_id'        => $parcel->user_id,
                            'status'         => 'draft',
                            'shipment_id'    => null,
                            'order_id'       => null,
                            'invoice_number' => 'TMP',
                            'total_amount'   => 0,
                        ]);

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
                            'quantity'   => 1,
                            'unit_price' => $fee,
                            'total'      => $fee,
                        ]
                    );

                    // Update the invoice total amount
                    $invoice->update([
                        'total_amount' => $invoice->items()->sum('total'),
                    ]);
                });
            }
        }
    }
}
