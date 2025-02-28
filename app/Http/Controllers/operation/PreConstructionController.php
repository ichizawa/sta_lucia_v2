<?php

namespace App\Http\Controllers\operation;

use App\Http\Controllers\Controller;
use App\Models\LeaseProposal;
use App\Models\Owner;
use Illuminate\Http\Request;

class PreConstructionController extends Controller
{
    public function index()
    {
        return view('operations.pre_construction');
    }

    public function tenantLists(Request $request)
    {
        $query = Owner::select('owner.id', 'company.acc_id', 'company.company_name')
            ->join('company', 'owner.id', '=', 'company.owner_id')->get();

        return response()->json($query);
        // return response()->json(
        //     Owner::select('owner.id', 'company.acc_id', 'company.company_name')
        //         ->join('company', 'owner.id', '=', 'company.owner_id')
        //         ->get()
        // );
    }

    public function contractLists(Request $request){
        return response()->json(
            LeaseProposal::select('proposal_uid', 'id', 'tenant_id', 'created_at', 'end_contract')->where('tenant_id', $request->id)->get()
        );
    }
}
