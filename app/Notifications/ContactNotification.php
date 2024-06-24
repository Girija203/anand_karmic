<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactNotification extends Notification
{
    use Queueable;

    private $notifyData;

    public function __construct($notifyData)
    {
        $this->notifyData = $notifyData;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('New contact message received.')
            ->line('Name: ' . $this->notifyData['name'])
            ->line('Email: ' . $this->notifyData['email'])
            ->line('Message: ' . $this->notifyData['message']);
    }

    public function toArray($notifiable)
    {
        return [
            'name' => $this->notifyData['name'],
            'email' => $this->notifyData['email'],
            'message' => $this->notifyData['message'],
            'user_id' => $notifiable->id,
        ];
    }
}
