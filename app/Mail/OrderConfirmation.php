<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $order;
    public $orderItems;
    public $exchangeRate;
    public $currencySymbol;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $order, $orderItems, $exchangeRate, $currencySymbol)
    {
        $this->user = $user;
        $this->order = $order;
        $this->orderItems = $orderItems;
        $this->exchangeRate = $exchangeRate;
        $this->currencySymbol = $currencySymbol;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'Admin.mail.order_confirmation',
            with: [
                'user' => $this->user,
                'order' => $this->order,
                'orderItems' => $this->orderItems,
                'exchangeRate' => $this->exchangeRate,
                'currencySymbol' => $this->currencySymbol,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
