<?php

namespace App\Jobs;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProcessPaymentWebhookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function handle(): void
    {
        $payload = $this->payload;
        
        // Log the payload for debugging
        Log::info('SSLCommerz Webhook Received', $payload);

        if (!isset($payload['status']) || $payload['status'] !== 'VALID') {
            return;
        }

        $invoiceId = $payload['value_a'] ?? null;
        if (!$invoiceId) {
            Log::error('Payment Webhook Missing Invoice ID');
            return;
        }

        $invoice = Invoice::find($invoiceId);
        if (!$invoice || $invoice->status === 'paid') {
            return; // Already paid or invalid
        }

        // Optional: Call SSLCommerz Order Validation API to verify the hash and transaction
        // Skipping full validation implementation for brevity, relying on standard webhook trust for MVP.
        $storeId = config('services.sslcommerz.store_id');
        $storePassword = config('services.sslcommerz.store_password');
        $valId = $payload['val_id'] ?? null;
        $isLive = config('services.sslcommerz.is_live', false);
        
        if ($valId) {
            $url = $isLive 
                ? 'https://securepay.sslcommerz.com/validator/api/validationserverAPI.php' 
                : 'https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php';

            $response = Http::timeout(10)->retry(2, 100)->get($url, [
                'val_id' => $valId,
                'store_id' => $storeId,
                'store_passwd' => $storePassword,
                'v' => 1,
                'format' => 'json'
            ]);

            $result = $response->json();

            if ($response->successful() && isset($result['status']) && $result['status'] === 'VALID' && $result['amount'] >= $invoice->total_amount) {
                // Mark invoice as paid
                $invoice->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                ]);

                // Notify User
                // $invoice->user->notify(new PaymentConfirmedNotification($invoice));
            } else {
                Log::warning('SSLCommerz Validation Failed', ['response' => $result]);
            }
        }
    }
}
