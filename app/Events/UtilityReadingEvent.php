<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UtilityReadingEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $utility;

    public function __construct($utility)
    {
        $this->utility = $utility;
    }

    public function broadcastOn()
    {
        return new Channel('utilityreading-channel');
    }

    public function broadcastAs()
    {
        return 'my-utilityreading';
    }

     public function broadcastWith()
    {
        return [
            'proposal_id'  => $this->utility['proposal_id'],
            'date_reading' => $this->utility['date_reading'],
        ];
    }
}
