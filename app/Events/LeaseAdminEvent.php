<?php

namespace App\Events;

use App\Models\LeaseProposal;
use App\Models\LeasableInfoModel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class LeaseAdminEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var LeaseProposal */
    public $proposal;

    public function __construct(LeaseProposal $proposal)
    {
        $this->proposal = $proposal;
    }


    public function broadcastOn(): array
    {
        return [
            new Channel('lease-admin-channel'),
        ];
    }


    public function broadcastAs(): string
    {
        return 'lease-admin-event';
    }


    public function broadcastWith(): array
    {

        $comm = [
            'id'                => $this->proposal->id,
            'proposal_uid'      => $this->proposal->proposal_uid,
            'tenant_name'       => $this->proposal->company->store_name,
            'date_created'      => Carbon::parse($this->proposal->created_at)->format('F d, Y'),
            'commencement_date' => optional($this->proposal->commencement_proposal)
                                        ->commencement_date
                                        ? Carbon::parse(
                                            $this->proposal->commencement_proposal
                                                         ->commencement_date
                                          )->format('F Y')
                                        : null,
        ];


        $spaces = LeasableInfoModel::join('space', 'leasable_space.space_id', '=', 'space.id')
            ->where('leasable_space.proposal_id', $this->proposal->id)
            ->select('space.property_code', 'space.space_area')
            ->get();

        $propertyCodes   = $spaces->pluck('property_code')->unique()->implode(', ');
        $totalSpaceArea = $spaces->pluck('space_area')->sum();

        $prop = [
            'id'               => $this->proposal->id,
            'company_name'     => $this->proposal->company->company_name,
            'property_codes'   => $propertyCodes,
            'total_space_area' => $totalSpaceArea,
            'tenant_type'      => $this->proposal->company->tenant_type,
            'status'           => $this->proposal->status,
        ];

        return [
            'commencement' => $comm,
            'proposal'     => $prop,
        ];
    }
}
