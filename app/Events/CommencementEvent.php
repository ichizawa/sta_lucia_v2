<?php

namespace App\Events;

use App\Models\LeaseProposal;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommencementEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var \App\Models\LeaseProposal */
    public $proposal;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\LeaseProposal  $proposal
     */
    public function __construct(LeaseProposal $proposal)
    {
        $this->proposal = $proposal;
    }

    /**
     * The name of the channel on which to broadcast.
     */
    public function broadcastOn()
    {
        // We’ll use a public channel named “commencement-channel”
        return new Channel('commencement-channel');
    }

    /**
     * The name of the event as seen by Pusher JS.
     */
    public function broadcastAs()
    {
        return 'commencement-updated';
    }

    /**
     * Data payload sent to JS. We only need the proposal ID,
     * and the newly set commencement_date if needed.
     */
    public function broadcastWith()
    {
        // We assume the related CommencementProposal record was already created/updated.
        $comm = $this->proposal->commencement_proposal;

        return [
            'proposal_id'        => $this->proposal->id,
            'proposal_uid'       => $this->proposal->proposal_uid,
            'tenant_name'        => $this->proposal->company->store_name,
            'created_at'         => $this->proposal->created_at->format('F d, Y'),
            'commencement_date'  => $comm
                ? $comm->commencement_date->format('F Y')
                : null,
        ];
    }
}
