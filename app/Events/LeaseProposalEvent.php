<?php
// app/Events/LeaseProposalEvent.php

namespace App\Events;

use App\Models\LeaseProposal;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\LeasableInfoModel;

class LeaseProposalEvent implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    /** @var LeaseProposal */
    public $proposal;

    public function __construct(LeaseProposal $proposal)
    {
        $this->proposal = $proposal;
    }

    public function broadcastOn()
    {
        return new Channel('lease-channel');
    }

    public function broadcastAs()
    {
        return 'proposal-updated';
    }

   public function broadcastWith(): array
{
    $spaces = LeasableInfoModel::join('space', 'leasable_space.space_id', '=', 'space.id')
        ->where('leasable_space.proposal_id', $this->proposal->id)
        ->select(['space.property_code', 'space.space_area'])
        ->get();

    $propertyCodes   = $spaces->pluck('property_code')->unique()->implode(', ');
    $totalSpaceArea  = $spaces->pluck('space_area')->sum();

    $companyName = optional($this->proposal->company)->company_name;
    $tenantType  = optional($this->proposal->company)->tenant_type;

    return [
        'proposal' => [
            'id'               => $this->proposal->id,
            'company_name'     => $companyName,
            'property_codes'   => $propertyCodes,
            'total_space_area' => $totalSpaceArea,
            'tenant_type'      => $tenantType,
            'status'           => $this->proposal->status,
        ],
    ];
}


}
