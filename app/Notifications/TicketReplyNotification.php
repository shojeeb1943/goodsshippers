<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Ticket;

class TicketReplyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Ticket $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New Reply to your Ticket: ' . $this->ticket->subject)
                    ->greeting('Hello ' . $notifiable->name . ',')
                    ->line('Our staff has replied to your support ticket.')
                    ->action('View Ticket', url('/tickets/' . $this->ticket->id))
                    ->line('Thank you!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'ticket_reply',
            'ticket_id' => $this->ticket->id,
            'message' => 'Staff replied to your ticket: ' . $this->ticket->subject,
        ];
    }
}
