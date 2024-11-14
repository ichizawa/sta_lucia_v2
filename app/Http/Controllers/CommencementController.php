<?php

namespace App\Http\Controllers;

use App\Models\LeaseProposal;
use Illuminate\Http\Request;

class CommencementController extends Controller
{
    public function index(){
        $proposal = LeaseProposal::join('company', 'proposal.tenant_id', '=', 'company.owner_id')->get();
        return view('admin.commencement.commencement-table', compact('proposal'));
    }
}
