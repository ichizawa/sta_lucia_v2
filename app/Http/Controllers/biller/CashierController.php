<?php

namespace App\Http\Controllers\biller;

use App\Http\Controllers\Controller;
use App\Models\AwardNotice;
use App\Models\Billing;
use App\Models\BillingDetails;
use App\Models\BillingLedger;
use App\Models\ChargesSelected;
use App\Models\Company;
use App\Models\Contracts;
use App\Models\LeasableInfoModel;
use App\Models\LeaseProposal;
use App\Models\Owner;
use App\Models\Space;
use App\Models\UtilitiesSelected;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        $proposals = LeaseProposal::all();
        $awardnotices = AwardNotice::all();
        $contract = Contracts::all();
        $companies = Company::all();
        $utilities_selected = UtilitiesSelected::join('utilities', 'utilities_selected.utility_id', '=', 'utilities.id')->get();
        $charges_selected = ChargesSelected::join('charges', 'extra_charges_selected.charge_id', '=', 'charges.id')->get();

        $spaces = Space::join('leasable_space', 'space.id', '=', 'leasable_space.space_id')->get();

        $bill = Billing::join('bill_details', 'billing.id', '=', 'bill_details.billing_id')->get();

        $companies->map(function ($company) use ($proposals, $awardnotices, $contract, $utilities_selected, $charges_selected, $spaces, $bill) {
            $matching_proposal_company = $proposals->filter(function ($proposal) use ($company) {
                return $company->owner_id == $proposal->tenant_id;
            });

            $matching_awardnotice_proposal = $awardnotices->filter(function ($awardnotice) use ($matching_proposal_company) {
                return $matching_proposal_company->contains('id', $awardnotice->proposal_id);
            });

            $matching_spaces_proposal = $spaces->filter(function ($space) use ($matching_proposal_company) {
                return $matching_proposal_company->contains('id', $space->proposal_id);
            });

            $matching_contract_proposal = $contract->filter(function ($contract) use ($matching_awardnotice_proposal) {
                return $matching_awardnotice_proposal->contains('id', $contract->award_notice_id);
            });

            $matching_selected_utilities = $utilities_selected->filter(function ($utility) use ($matching_awardnotice_proposal) {
                return $matching_awardnotice_proposal->contains('id', $utility->lease_id);
            });

            $matching_selected_charges = $charges_selected->filter(function ($charge) use ($matching_awardnotice_proposal) {
                return $matching_awardnotice_proposal->contains('id', $charge->lease_id);
            });

            $matchibng_bill = $bill->filter(function ($bills) use ($matching_awardnotice_proposal) {
                return $matching_awardnotice_proposal->contains('id', $bills->proposal_id);
            });

            $company->proposals = $matching_proposal_company;
            $company->leases = $matching_spaces_proposal;
            $company->award_notices = $matching_awardnotice_proposal;
            $company->contracts = $matching_contract_proposal;
            $company->utilities = $matching_selected_utilities;
            $company->charges = $matching_selected_charges;
            $company->bills = $matchibng_bill;

            return $company;
        });

        
        return view('biller.cashier.index', compact('companies'));
    }

    public function prepare(Request $request){
        $bill = [
            'proposal_id' => $request->contract_id,
            'tenant_id' => $request->tenant_id,
            'status' => 0
        ];
        $bill_insert = Billing::create($bill);

        $bill_details = [
            'billing_id' => $bill_insert->id,
            'bill_no' => $request->bill_num,
            'total_sales' => $request->sales,
            'brent' => $request->brent,
            'total_brent' => $request->total_brent,
            'mgr' => $request->mgr,
            'total_mgr' => $request->total_mgr,
            'amount_payable' => $request->payable_rent,
            'total_amount_payable' => $request->total_amount_payable,
            'date_from' => $request->dateFrom,
            'date_to' => $request->dateTo,
            'remarks' => $request->remarks ?? null,
        ];
        $bill_detail_insert = BillingDetails::create($bill_details);
        BillingLedger::create([
            'proposal_id' => $request->contract_id,
            'tenant_id' => $request->tenant_id,
            'billing_id' => $bill_insert->id,
            'bill_no' => $request->bill_num,
            'total_sales' => $request->sales,
            'brent' => $request->brent,
            'total_brent' => $request->total_brent,
            'mgr' => $request->mgr,
            'total_mgr' => $request->total_mgr,
            'amount_payable' => $request->payable_rent,
            'total_amount_payable' => $request->total_amount_payable,
            'date_from' => $request->dateFrom,
            'date_to' => $request->dateTo,
            'remarks' => $request->remarks ?? null,
        ]);
        return response()->json($bill_detail_insert);
    }

    public function ledger(Request $request){
        $data = BillingLedger::where('tenant_id', $request->acc_uid)->get();
        return response()->json($data);
    }
}
