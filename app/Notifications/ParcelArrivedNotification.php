<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ParcelArrivedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $parcel;

    /**
     * Create a new notification instance.
     */
    public function __construct(\App\Models\Parcel $parcel)
    {
        $this->parcel = $parcel;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your parcel has arrived at our warehouse!')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Great news! We have received a new parcel for your Suite ID (' . $notifiable->warehouse_suite_id . ').')
            ->line('Tracking Number: ' . $this->parcel->tracking_number)
            ->line('Warehouse: ' . $this->parcel->warehouse->name)
            ->line('Weight: ' . $this->parcel->weight . ' kg')
            ->action('View Parcel Details', route('dashboard'))
            ->line('You can now log in to proceed with shipment creation.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title'      => 'New Parcel Arrived',
            'message'    => 'Tracking: ' . $this->parcel->tracking_number,
            'parcel_id'  => $this->parcel->id,
            'url'        => route('dashboard'), // will be updated when dedicated parcel view exists
        ];
    }
}
