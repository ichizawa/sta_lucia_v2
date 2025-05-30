<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SpaceEvent
{
     use Dispatchable, SerializesModels;

    public $space;

    public function __construct($space)
    {
        $this->space = $space;
    }

    public function broadcastOn()
    {
        return new Channel('space-channel');
    }

    public function broadcastAs()
    {
        return 'space-updated';
    }

    public function broadcastWith(): array
    {

        $this->space->load('owner', 'leasableInfo', 'utilities', 'amenities');

        return [
            'space' => $this->space,
        ];
    }
}
