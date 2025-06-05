<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BillerEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $date;
    public array $proposalIds;

    /**
     * @param  string  $date
     * @param  int[]   $proposalIds
     */
    public function __construct(string $date, array $proposalIds)
    {
        $this->date        = $date;
        $this->proposalIds = $proposalIds;
    }

    /**
     * Broadcast on both a per‐period channel and a global channel.
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('biller-period.' . $this->date),
            new Channel('biller-period'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'billing-updated';
    }

    public function broadcastWith(): array
    {
        return [
            'date'        => $this->date,
            'proposalIds' => $this->proposalIds,
        ];
    }
}
