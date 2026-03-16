<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Notifications\Channels\SmsChannel;
use App\Models\Order;

class QuoteSentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database', SmsChannel::class];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Action Required: Quote Provided - ' . config('app.name'))
                    ->greeting('Hello ' . $notifiable->name . ',')
                    ->line('Our team has provided a quote for your recent Shop For Me order.')
                    ->line('Please review the quote and approve it so we can proceed with your purchase.')
                    ->action('Review & Approve Quote', url('/orders/' . $this->order->id))
                    ->line('Thank you!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'quote_sent',
            'order_id' => $this->order->id,
            'message' => 'A quote has been provided for your order. Please review it.',
        ];
    }

    public function toSms(object $notifiable): string
    {
        return "GoossShippers: We provided a quote for your Shop For Me order. Please login to review and approve.";
    }
}
