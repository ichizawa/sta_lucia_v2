<?php

namespace App\Jobs\operation;

use App\Services\StatusService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Log;

class AwardNoticeStatus implements ShouldQueue
{
    use Queueable;

    protected $award_notice;
    /**
     * Create a new job instance.
     */
    public function __construct($award_notice)
    {
        $this->award_notice = $award_notice;
    }

    /**
     * Execute the job.
     */
    public function handle(StatusService $email_award_notice): void
    {
        $this->award_notice->load('proposal.owner', 'proposal.representative', 'proposal.company');
        $email_award_notice->notify_award_notice($this->award_notice);
    }
}
