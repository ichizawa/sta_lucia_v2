<?php

namespace App\Http\Controllers;

use App\Models\bill\Billing;
use App\Models\CommencementProposal;
use App\Models\LeaseProposal;
use Illuminate\Http\Request;

class CommencementController extends Controller
{
    public function index()
    {
        $proposal = LeaseProposal::join('company', 'proposal.tenant_id', '=', 'company.owner_id')
            ->join('commencement_proposals', 'proposal.id', '=', 'commencement_proposals.proposal_id')
            ->select('proposal.id', 'proposal.created_at', 'proposal.proposal_uid', 'company.store_name', 'commencement_proposals.commencement_date')
            ->get();
        return view('admin.commencement.commencement-table', compact('proposal'));
    }

    public function commencementUpdate(Request $request)
    {
        $propid = $request->input('prop_num', []);
        $data = [];

        foreach ($propid as $prop) {
            $billingExists = Billing::where('proposal_id', $prop)->exists();

            if (!$billingExists) {
                CommencementProposal::where('proposal_id', $prop)->update([
                    'commencement_date' => $request->comm_date
                ]);

                Billing::create([
                    'proposal_id' => $prop,
                    'date_start' => $request->comm_date,
                    'date_end' => null,
                    'remarks' => null,
                    'is_prepared' => 0,
                    'is_paid' => 0,
                    'status' => 0
                ]);

                $data[] = [
                    'status' => 'success',
                    'message' => "Commencement date and billing created successfully for proposal ID $prop."
                ];
            } else {
                $data[] = [
                    'status' => 'error',
                    'message' => "Billing already exists for proposal ID $prop."
                ];
            }
        }

        return response()->json($data);

    }
}
