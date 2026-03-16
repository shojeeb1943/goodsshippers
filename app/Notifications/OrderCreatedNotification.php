<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Notifications\Channels\SmsChannel;
use App\Models\Order;

class OrderCreatedNotification extends Notification implements ShouldQueue
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
                    ->subject('Order Request Received - ' . config('app.name'))
                    ->greeting('Hello ' . $notifiable->name . ',')
                    ->line('Your Shop For Me request has been received.')
                    ->line('Our team will review your requested items and provide a quote shortly.')
                    ->action('View Order', url('/orders/' . $this->order->id))
                    ->line('Thank you for choosing GoossShippers!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'order_created',
            'order_id' => $this->order->id,
            'message' => 'Your Shop For Me request has been received.',
        ];
    }

    public function toSms(object $notifiable): string
    {
        return "Your GoossShippers request has been received. We will review & quote it shortly.";
    }
}
