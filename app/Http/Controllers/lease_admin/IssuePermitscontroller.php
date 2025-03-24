<?php

namespace App\Http\Controllers\lease_admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\LeaseProposal;
use Illuminate\Http\Request;

class IssuePermitscontroller extends Controller
{
    public function permits_index(){
        $tenants = Company::all();
        return view('lease-admin.issue-permits.issue-permits', compact('tenants'));
    }

    public function get_contracts(Request $request){
        return response()->json(
            LeaseProposal::select('proposal_uid', 'id', 'tenant_id', 'created_at', 'end_contract')->where('tenant_id', $request->id)->get()
        );
    }
}
