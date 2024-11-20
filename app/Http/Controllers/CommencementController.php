<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\CommencementProposal;
use App\Models\LeaseProposal;
use Illuminate\Http\Request;

class CommencementController extends Controller
{
    public function index(){
        $proposal = LeaseProposal::join('company', 'proposal.tenant_id', '=', 'company.owner_id')
        ->join('commencement_proposals', 'proposal.id', '=', 'commencement_proposals.proposal_id')
        ->select('proposal.id', 'proposal.created_at', 'proposal.proposal_uid', 'company.store_name', 'commencement_proposals.commencement_date')
        ->get();
        return view('admin.commencement.commencement-table', compact('proposal'));
    }

    public function commencementUpdate(Request $request){
        $propid = $request->input('prop_num', []);
        // $date = new \DateTime($request->comm_date);
        // $date->modify('+1 months');
        // $commencement = $date->format('Y-m');
        foreach($propid as $prop){
            CommencementProposal::where('proposal_id', $prop)->update([
                'commencement_date' => $request->comm_date
            ]);
            Billing::create([
                'proposal_id' => $prop,
                'date_start' => $request->comm_date,
                'date_end' => null,
                'status' => 0
            ]);
        }
        return response()->json(['status' => 'success', 'message' => 'Commencement date updated successfully']);
    }
}
