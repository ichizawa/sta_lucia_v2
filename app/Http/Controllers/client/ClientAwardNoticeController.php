<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\AwardNotice;
use App\Models\Representative;
use Auth;
use Illuminate\Http\Request;

class ClientAwardNoticeController extends Controller
{
    //
    public function index()
    {
        $email = Auth::user()->email;
        $owner_id = Representative::where('rep_email', $email)->pluck('owner_id')->first();
        $awardnotice = AwardNotice::join('proposal', 'award_notice.proposal_id', '=', 'proposal.id')
        ->join('company', 'proposal.tenant_id', '=', 'company.owner_id')
        ->where('proposal.tenant_id', $owner_id)->get();
        // dd($awardnotice); die();
        return view('client.award-notice.award-notice-table', compact('awardnotice'));
    }
}
