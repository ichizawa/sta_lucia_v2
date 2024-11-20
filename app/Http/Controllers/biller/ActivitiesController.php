<?php

namespace App\Http\Controllers\biller;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\BillingDetails;
use App\Models\Company;
use App\Models\LeaseProposal;
use App\Models\UtilitiesSelected;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function index(){
        $bills = Billing::all();
        $companies = Company::all();
        $proposals = LeaseProposal::all();

        $bills->map(function ($bill) use ($companies, $proposals) {
            $matching_proposal = $proposals->firstWhere('id', $bill->proposal_id);
            $matching_company = $companies->firstWhere('owner_id', $matching_proposal->tenant_id ?? null);
            $bill->proposal = $matching_proposal;
            $bill->company = $matching_company;

            return $bill;
        });
        return view('biller.reading.index');
    }

    public function lists(Request $request){
        $date = $request->date;

        $bills = Billing::all();
        $billing_details = BillingDetails::where('date_to', $date)->get();
        $companies = Company::all();
        $proposals = LeaseProposal::all();

        $billing_details->map(function ($billing_detail) use ($bills, $companies, $proposals) {
            $matching_bill = $bills->firstWhere('id', $billing_detail->billing_id);
            $matching_proposal = $proposals->firstWhere('id', $matching_bill->proposal_id ?? null);
            $matching_company = $companies->firstWhere('owner_id', $matching_proposal->tenant_id ?? null);

            $billing_detail->bill = $matching_bill;
            $billing_detail->proposal = $matching_proposal;
            $billing_detail->company = $matching_company;

            return $billing_detail;
        });

        return response()->json($billing_details);
    }

    public function utilityLists(Request $request){
        $bills = Billing::all();
        $billing_details = BillingDetails::where('billing_id', $request->id)->get();
        $companies = Company::all();
        $proposals = LeaseProposal::all();
        $utilities = UtilitiesSelected::join('utilities', 'utilities_selected.utility_id', '=', 'utilities.id')->get();

        $billing_details->map(function ($billing_detail) use ($bills, $companies, $proposals, $utilities) {
            $matching_bill = $bills->firstWhere('id', $billing_detail->billing_id);
            $matching_proposal = $proposals->firstWhere('id', $matching_bill->proposal_id ?? null);
            $matching_company = $companies->firstWhere('owner_id', $matching_proposal->tenant_id ?? null);
            $matching_utilities = $utilities->where('lease_id', $matching_bill->proposal_id ?? null);

            $billing_detail->bill = $matching_bill;
            $billing_detail->proposal = $matching_proposal;
            $billing_detail->company = $matching_company;
            $billing_detail->proposal->utilities = $matching_utilities;

            return $billing_detail;
        });

        return response()->json($billing_details);
    }
}
