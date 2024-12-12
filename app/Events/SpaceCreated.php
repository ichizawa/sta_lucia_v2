<?php

namespace App\Events;

use App\Models\Space;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SpaceCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $space;
    public function __construct(Space $space)
    {
        $this->space = $space;
        Log::info('SpaceCreated event dispatched', ['space' => $space]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [new Channel('spaces')];
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->space->id,
            'space_name' => $this->space->space_name,
            'store_type' => $this->space->store_type,
            'space_area' => $this->space->space_area,
            'property_code' => $this->space->property_code,
            'space_type' => $this->space->space_type,
            'status' => $this->space->status ? 'Unavailable' : 'Available',
            'space_tag' => $this->space->space_tag == 1 ? 'Available' : ($this->space->space_tag == 2 ? 'Unavailable' : 'Reserved')
        ];
    }
}
