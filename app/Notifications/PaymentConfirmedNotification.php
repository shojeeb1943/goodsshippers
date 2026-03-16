<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Notifications\Channels\SmsChannel;
use App\Models\Invoice;

class PaymentConfirmedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Invoice $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database', SmsChannel::class];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Payment Confirmed - ' . config('app.name'))
                    ->greeting('Hello ' . $notifiable->name . ',')
                    ->line('Your payment of ' . number_format($this->invoice->total_amount, 2) . ' BDT for Invoice ' . $this->invoice->invoice_number . ' has been successfully received and confirmed.')
                    ->action('View Invoice', url('/invoices/' . $this->invoice->id))
                    ->line('Thank you for choosing GoossShippers!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'payment_confirmed',
            'invoice_id' => $this->invoice->id,
            'message' => 'Payment confirmed for Invoice ' . $this->invoice->invoice_number,
        ];
    }

    public function toSms(object $notifiable): string
    {
        return "GoossShippers: Payment of " . number_format($this->invoice->total_amount, 2) . " BDT for Invoice " . $this->invoice->invoice_number . " has been confirmed. Thank you!";
    }
}
