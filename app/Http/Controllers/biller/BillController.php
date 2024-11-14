<?php

namespace App\Http\Controllers\biller;

use App\Http\Controllers\Controller;
use App\Models\AwardNotice;
use App\Models\Billing;
use App\Models\Company;
use App\Models\Contracts;
use App\Models\LeaseProposal;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index(){
        return view('biller.dashboard');
    }

    public function bill(){
        return view('biller.period.billing-period');
    }

    public function contractLists(Request $request){
        // $proposal = LeaseProposal::join('award_notice', 'proposal.id', '=', 'award_notice.proposal_id')
        // ->join('contracts', 'award_notice.id', '=', 'contracts.award_notice_id')
        // ->join('company', 'proposal.tenant_id', '=', 'company.owner_id')
        // ->select('proposal.id', 'proposal.commencement', 'proposal.proposal_uid', 'award_notice.status as award_notice_status', 'contracts.status as contract_status',
        // 'company.acc_id', 'company.company_name', 'company.store_name')
        // ->where('proposal.commencement', $request->date)
        // ->get();
        $proposal = LeaseProposal::join('award_notice', 'proposal.id', '=', 'award_notice.proposal_id')
        ->join('contracts', 'award_notice.id', '=', 'contracts.award_notice_id')
        ->join('company', 'proposal.tenant_id', '=', 'company.owner_id')
        ->select(
            'proposal.*',
            'award_notice.status as award_notice_status',
            'contracts.status as contract_status',
            'company.acc_id',
            'company.company_name',
            'company.store_name'
        )
        ->where('proposal.commencement', $request->date)
        ->get();

        $bill = Billing::join('bill_details', 'billing.id', '=', 'bill_details.billing_id')->get();

        $proposal->map(function ($proposals) use ($bill) {
           $matching_bill_details = $bill->filter(function ($bill_details) use ($proposals) {
               return $bill_details->billing_id == $proposals->id;
           });

           $proposals->bill_details = $matching_bill_details;

           return $proposals;
        });
        return response()->json($proposal);
    }

    public function prepare(Request $request){
        dd($request->all()); die();
    }
}
