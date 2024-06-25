<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderNotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;
    public $order_no;

    public function __construct($name,$order_no)
    {
        $this->name = $name;
        $this->order_no = $order_no;
    }


    public function broadcastOn()
    {
        return new Channel('order_notification');
    }

    public function broadcastAs()
    {
        return 'order';
    }
}
