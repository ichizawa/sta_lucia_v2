<?php
// app/Events/AwardNoticeEvent.php

namespace App\Events;

use App\Models\AwardNotice;
use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use App\Models\LeasableInfoModel;
use Carbon\Carbon;

class AwardNoticeEvent implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    /** @var AwardNotice */
    public $notice;

    public function __construct(AwardNotice $notice)
    {
        $this->notice = $notice;
    }

    public function broadcastOn()
    {
        // This matches the JS: `pusher.subscribe('award-channel')`
        return new Channel('award-notices');
    }

    public function broadcastAs()
    {
        // This matches the JS: `channel.bind('notice-updated', …)`
         return 'award.notice.updated';
    }

    public function broadcastWith(): array
    {
     $data = AwardNotice::join('proposal', 'award_notice.proposal_id', '=', 'proposal.id')
        ->join('company', 'proposal.tenant_id', '=', 'company.owner_id')
        ->where('award_notice.id', $this->notice->id)
        ->select([
            'award_notice.created_at',
            'award_notice.status',
            'company.company_name',
            'company.tenant_type',
        ])
        ->first();

    return [
        'id'                      => $this->notice->id,
        'company_name'            => $data->company_name,
        'tenant_type'             => $data->tenant_type,
        'award_notice_created_at' => Carbon::parse($data->created_at)
                                        ->format('F j, Y'),
        'award_notice_status'     => $data->status,
    ];
    }
}
