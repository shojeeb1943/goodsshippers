<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Jobs\ProcessPaymentWebhookJob;

class PaymentController extends Controller
{
    /**
     * Initiate an SSLCommerz payment for a given invoice.
     */
    public function initiate(Invoice $invoice)
    {
        abort_if($invoice->user_id !== auth()->id(), 403);

        if ($invoice->status === 'paid') {
            return redirect()->route('dashboard')->with('error', 'This invoice is already paid.');
        }

        $storeId = config('services.sslcommerz.store_id');
        $storePassword = config('services.sslcommerz.store_password');
        $isLive = config('services.sslcommerz.is_live', false);
        
        $url = $isLive 
            ? 'https://securepay.sslcommerz.com/gwprocess/v4/api.php' 
            : 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php';

        $postData = [
            'store_id' => $storeId,
            'store_passwd' => $storePassword,
            'total_amount' => $invoice->total_amount,
            'currency' => 'BDT',
            'tran_id' => $invoice->invoice_number . '_' . uniqid(),
            'success_url' => route('payment.success'),
            'fail_url' => route('payment.fail'),
            'cancel_url' => route('payment.cancel'),
            'ipn_url' => route('payment.ipn'),
            'cus_name' => $invoice->user->name,
            'cus_email' => $invoice->user->email,
            'cus_phone' => $invoice->user->phone ?? '01000000000',
            'cus_add1' => 'Dhaka',
            'cus_city' => 'Dhaka',
            'cus_country' => 'Bangladesh',
            'shipping_method' => 'NO',
            'product_name' => 'Logistics Services',
            'product_category' => 'Logistics',
            'product_profile' => 'non-physical-goods',
            'value_a' => $invoice->id, // Pass invoice ID
        ];

        $response = Http::asForm()->post($url, $postData);
        $result = $response->json();

        if ($response->successful() && isset($result['status']) && $result['status'] === 'SUCCESS') {
            return redirect()->away($result['GatewayPageURL']);
        }

        return redirect()->route('dashboard')->with('error', 'Failed to initiate payment gateway.');
    }

    public function success(Request $request)
    {
        // Simple success handling here, IPN handles the actual DB status
        ProcessPaymentWebhookJob::dispatch($request->all());
        return redirect()->route('dashboard')->with('success', 'Payment successful. We are verifying your transaction.');
    }

    public function fail(Request $request)
    {
        return redirect()->route('dashboard')->with('error', 'Payment failed.');
    }

    public function cancel(Request $request)
    {
        return redirect()->route('dashboard')->with('warning', 'Payment was cancelled.');
    }

    public function ipn(Request $request)
    {
        ProcessPaymentWebhookJob::dispatch($request->all());
        return response()->json(['status' => 'success']);
    }
}
