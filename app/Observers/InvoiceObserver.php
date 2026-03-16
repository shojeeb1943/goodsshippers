<?php

namespace App\Observers;

use App\Models\Invoice;

class InvoiceObserver
{
    /**
     * Handle the Invoice "created" event.
     */
    public function created(Invoice $invoice): void
    {
        $invoice->statusLogs()->create([
            'status' => $invoice->status,
            'note' => 'Invoice created (' . $invoice->invoice_number . ').',
            'actor_id' => auth()->id(),
        ]);
    }

    /**
     * Handle the Invoice "updated" event.
     */
    public function updated(Invoice $invoice): void
    {
        if ($invoice->isDirty('status')) {
            $invoice->statusLogs()->create([
                'status' => $invoice->status,
                'note' => 'Invoice status changed to ' . str_replace('_', ' ', $invoice->status) . '.',
                'actor_id' => auth()->id(),
            ]);
        }
    }
}
