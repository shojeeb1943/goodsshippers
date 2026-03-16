<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsChannel
{
    /**
     * Send the given notification.
     */
    public function send($notifiable, Notification $notification): void
    {
        if (!method_exists($notification, 'toSms')) {
            return;
        }

        $message = $notification->toSms($notifiable);
        $phone = $notifiable->routeNotificationFor('sms', $notification) ?? $notifiable->phone;

        if (!$phone || !$message) {
            return;
        }

        $url = env('SMS_GATEWAY_URL');
        $apiKey = env('SMS_GATEWAY_API_KEY');
        $senderId = env('SMS_SENDER_ID', 'GoossShippers');

        if (!$url || !$apiKey) {
            Log::warning('SMS Gateway config missing. Message not sent.', ['phone' => $phone]);
            return;
        }

        try {
            // Adaptive payload for common BD SMS APIs (e.g., bdbulksms)
            $response = Http::asForm()->post($url, [
                'api_key' => $apiKey,
                'senderid' => $senderId,
                'number' => $phone,
                'message' => $message,
            ]);

            if (!$response->successful()) {
                Log::error('SMS sending failed', ['response' => $response->body()]);
            }
        } catch (\Exception $e) {
            Log::error('SMS sending exception', ['error' => $e->getMessage()]);
        }
    }
}
