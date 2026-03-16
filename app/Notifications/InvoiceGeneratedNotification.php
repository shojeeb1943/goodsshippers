<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Invoice;

class InvoiceGeneratedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Invoice $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Invoice Available - ' . config('app.name'))
                    ->greeting('Hello ' . $notifiable->name . ',')
                    ->line('A new invoice (' . $this->invoice->invoice_number . ') has been generated for your recent activity.')
                    ->line('Total amount due: ' . number_format($this->invoice->total_amount, 2) . ' BDT.')
                    ->action('Pay Invoice', url('/invoices/' . $this->invoice->id))
                    ->line('Thank you!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'invoice_generated',
            'invoice_id' => $this->invoice->id,
            'message' => 'New invoice ' . $this->invoice->invoice_number . ' is available.',
        ];
    }
}
