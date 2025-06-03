<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UtilityEvent implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public $utility;

    public function __construct($utility)
    {
        $this->utility = $utility;
    }

    public function broadcastOn()
    {
        return new Channel('utility-channel');
    }

    public function broadcastAs()
    {
        return 'my-utility';
    }

    public function broadcasWith()
    {
        return [
            'utility' => $this->utility
        ];
    }
}
