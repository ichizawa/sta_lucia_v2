<?php

namespace App\Events;

use App\Models\bill\Billing;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BillEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The Billing model instance
     *
     * @var \App\Models\bill\Billing
     */
    public $billing;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\bill\Billing  $billing
     * @return void
     */
    public function __construct(Billing $billing)
    {
        $this->billing = $billing;
    }

    /**
     * The name of the event when it’s broadcast.
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'bill.updated';
    }

    /**
     * Channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
{
    return new PrivateChannel('billing-channel');
}

    /**
     * The data to broadcast.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'id'            => $this->billing->id,
            'proposal_id'   => $this->billing->proposal_id,
            'total_amount'  => $this->billing->total_amount,
            'debit'         => $this->billing->debit,
            'credit'        => $this->billing->credit,
            'change'        => $this->billing->change,
            'date_start'    => $this->billing->date_start->toDateString(),
            'date_end'      => $this->billing->date_end?->toDateString(),
            'is_prepared'   => $this->billing->is_prepared,
            'is_reading'    => $this->billing->is_reading,
            'is_paid'       => $this->billing->is_paid,
            'status'        => $this->billing->status,
            'updated_at'    => $this->billing->updated_at->toDateTimeString(),
        ];
    }
}
