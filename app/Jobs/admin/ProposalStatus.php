<?php

namespace App\Jobs\admin;

use App\Services\StatusService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProposalStatus implements ShouldQueue
{
    use Queueable;

    protected $proposal;
    /**
     * Create a new job instance.
     */
    public function __construct($proposal)
    {
        $this->proposal = $proposal;
    }

    /**
     * Execute the job.
     */
    public function handle(StatusService $email_proposal): void
    {
        $this->proposal->load('owner', 'representative', 'company');
        $email_proposal->notify_proposal($this->proposal);
    }
}
