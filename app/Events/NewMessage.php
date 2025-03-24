<?php

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessage implements ShouldBroadcast
{
    use InteractsWithSockets;

    public function __construct(public string $message, public int $roomId) {}

    public function broadcastOn()
    {
        return new Channel("chat.{$this->roomId}");
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }
}


