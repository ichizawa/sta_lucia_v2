<?php
namespace App\Services;

use App\Mail\admin\SendAwardNoticeUpdate;
use App\Mail\admin\SendRegistrationUpdate;
use Log;
use Mail;

class StatusService
{
    public function notify_proposal($proposal){
        return Mail::to($proposal->representative->rep_email)->send(new SendRegistrationUpdate($proposal));
    }

    public function notify_award_notice($award_notice){
        return Mail::to($award_notice->proposal->representative->rep_email)->send(new SendAwardNoticeUpdate($award_notice));
    }

    public function notify_commencement($commencement){
        // return Mail::to($commencement)->send()
    }
}