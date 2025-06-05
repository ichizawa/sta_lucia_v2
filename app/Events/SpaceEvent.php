<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Space;

class SpaceEvent implements ShouldBroadcastNow
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
        $spaceData = Space::join('leasable_space', 'space.id', '=', 'leasable_space.space_id')
            ->select([
                'space.id',
                'space.space_name',
                'space.store_type',
                'space.space_area',
                'space.property_code',
                'space.space_type',
                'leasable_space.status',
                'space.space_tag'
            ])
            ->where('space.id', $this->space->id)
            ->first();

        return [
            'space' => $spaceData,
        ];
    }
}
