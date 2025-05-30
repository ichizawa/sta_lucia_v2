<?php

namespace App\Events;
use App\Models\Owner;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public Owner $owner;

    /**
     * Create a new event instance.
     */
     public function __construct(Owner $owner)
    {
        $this->owner = $owner;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
     public function broadcastOn(): Channel
    {
        // public channel “tenants”
        return new Channel('tenants');
    }
     public function broadcastAs(): string
    {
        return 'tenant.added';
    }
    public function broadcastWith(): array
    {
        return [
            'id'           => $this->owner->id,
            'full_name'    => $this->owner->owner_fname.' '.$this->owner->owner_lname,
            'company_count'=> $this->owner->companies->count(),
            // add whatever else you need on the JS side…
        ];
    }

}
