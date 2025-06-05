<?php

namespace App\Events;

use App\Models\Contracts;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContractRenewalEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var \App\Models\Contracts */
    public $contract;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Contracts  $contract
     */
    public function __construct(Contracts $contract)
    {
        $this->contract = $contract;
    }

    /**
     * The name of the channel on which to broadcast.
     *
     * @return \Illuminate\Broadcasting\Channel
     */
    public function broadcastOn()
    {
        // We broadcast on a simple public channel “contract-channel”
        return new Channel('contract-channel');
    }

    /**
     * The name of the event as seen on the JS side.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'contract-renewed';
    }

    /**
     * Optionally, customize the data payload that gets sent to JS.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'contract_id'   => $this->contract->id,
            'company_name'  => $this->contract->company_name,    // if Contracts model has this attribute
            'renewal_term'  => $this->contract->lease_term,      // adjust field names as needed
            'monthly_rent'  => number_format($this->contract->total_rent, 2),
            'due_date'      => date('F, Y', strtotime($this->contract->end_contract)),
            'agreement_date'=> date('F, Y', strtotime($this->contract->commencement)),
        ];
    }
}
