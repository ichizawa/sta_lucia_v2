<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\LeasableInfoModel;
use App\Models\LeaseProposal;
use App\Models\Space;
use App\Http\Controllers\client\SpaceController;
use Auth;
use Illuminate\Http\Request;

class ClientProposalController extends Controller
{
    //
    public function index()
    {
        $proposal = LeaseProposal::join('company', 'proposal.tenant_id', '=', 'company.owner_id')
        ->join('representative', 'proposal.tenant_id', '=', 'representative.owner_id')
        ->join('owner', 'proposal.tenant_id', '=', 'owner.id')
        ->select(
            'proposal.*',
            'company.company_name',
            'company.company_address',
            'proposal.bussiness_nature',
            'representative.rep_fname',
            'representative.rep_lname',
            'representative.rep_position',
            'owner.owner_mobile',
            'owner.id as owner_id',
            'owner.owner_email'
        )
        ->orderBy('proposal.id', 'desc')
        ->get();

        // $proposal = LeaseProposal::join('company', 'proposal.tenant_id', '=', 'company.owner_id')
        //     ->select('company.company_name', 'proposal.status', 'proposal.id', 'company.owner_id', 'proposal.tenant_id', 'company.tenant_type')
        //     ->orderBy('proposal.id', 'desc')
        //     ->get();
        $spaces_proposal = LeasableInfoModel::join('space', 'leasable_space.space_id', '=', 'space.id')
            ->select('leasable_space.owner_id', 'leasable_space.proposal_id', 'space.*')
            ->get();

        $proposal->map(function ($proposals) use ($spaces_proposal) {
            $matching_space_proposals = $spaces_proposal->filter(function ($space) use ($proposals) {
                return $space->proposal_id == $proposals->id;
            });
            $proposals->space_selected = $matching_space_proposals;

            return $proposals;
        });

    return view('client.proposals.proposal-table', compact('proposal'));

        // $user_email = Auth::user()->email;
        // $proposals = LeasableInfoModel::join('proposal', 'leasable_space.proposal_id', '=', 'proposal.id')
        // ->join('space', 'leasable_space.space_id', '=', 'space.id')
        // ->join('representative', 'leasable_space.owner_id', '=', 'representative.owner_id')
        // ->select(
        //     'proposal.*',
        //     'space.space_name',
        //     'space.space_area'
        // )
        // ->where('representative.rep_email', $user_email)
        // ->get();
        $space = Space::join('leasable_space', 'space.id', '=', 'leasable_space.space_id')
        ->leftJoin('representative', 'leasable_space.owner_id', '=', 'representative.owner_id')
        ->select('space.*', 'leasable_space.status', 'leasable_space.owner_id', 'representative.rep_fname', 'representative.rep_lname')
        ->orderBy('leasable_space.id', direction: 'desc')
        ->get();
    // dd($space); die();
        return view('client.proposals.proposal-table', compact('proposals', 'space'));
    }

 //    $space = Space::join('leasable_space', 'space.id', '=', 'leasable_space.space_id')
    //         ->leftJoin('representative', 'leasable_space.owner_id', '=', 'representative.owner_id')
    //         ->select('space.*', 'leasable_space.status', 'leasable_space.owner_id', 'representative.rep_fname', 'representative.rep_lname')
    //         ->orderBy('leasable_space.id', direction: 'desc')
    //         ->get();
    //     // dd($space); die();
    //     return view('admin.leases.leases-information', compact('space'));
}
