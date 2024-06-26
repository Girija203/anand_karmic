<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification
{
    use Queueable;

    private $orderData;
    private $order_no;

    public function __construct($orderData,$order_no)
    {
        $this->orderData = $orderData;
        $this->order_no = $order_no;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('New contact message received.')
            ->line('Name: ' . $this->orderData['name'])
            ->line('Email: ' . $this->orderData['email'])
            ->line('Order_no: ' . $this->order_no);
    }

    public function toArray($notifiable)
    {
        return [
            'name' => $this->orderData['name'],
            'email' => $this->orderData['email'],
            'order_no' => $this->order_no,
            'user_id' => $notifiable->id,
        ];
    }
}
