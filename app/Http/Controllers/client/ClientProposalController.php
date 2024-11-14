<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\LeasableInfoModel;
use App\Models\LeaseProposal;
use Auth;
use Illuminate\Http\Request;

class ClientProposalController extends Controller
{
    //
    public function index()
    {
        $user_email = Auth::user()->email;
        $proposals = LeasableInfoModel::join('proposal', 'leasable_space.proposal_id', '=', 'proposal.id')
        ->join('space', 'leasable_space.space_id', '=', 'space.id')
        ->join('representative', 'leasable_space.owner_id', '=', 'representative.owner_id')
        ->select(
            'proposal.*',
            'space.space_name',
            'space.space_area'
        )
        ->where('representative.rep_email', $user_email)
        ->get();
        return view('client.proposals.proposal-table', compact('proposals'));
    }
}
