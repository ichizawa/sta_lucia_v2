<?php

namespace App\Events;

use App\Models\LeaseProposal;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CollectorEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var LeaseProposal */
    public $proposal;

    public function __construct(LeaseProposal $proposal)
    {
        $this->proposal = $proposal;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('collector-channel');
    }

    public function broadcastAs(): string
    {
        return 'collector-updated';
    }

    public function broadcastWith(): array
    {
        return [
            'proposal_id' => $this->proposal->id,
        ];
    }
}
