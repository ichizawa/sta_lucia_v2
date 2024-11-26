<?php

namespace App\Http\Controllers\biller;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\BillingDetails;
use App\Models\CommencementProposal;
use App\Models\Company;
use App\Models\LeaseProposal;
use App\Models\UtilitiesReading;
use App\Models\UtilitiesSelected;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\IsEmpty;
use function PHPUnit\Framework\isEmpty;

class ActivitiesController extends Controller
{
    public function index()
    {
        return view('biller.reading.index');
    }

    public function lists(Request $request)
    {
        $bills = Billing::where('date_end', $request->date)->get();
        $billing_details = BillingDetails::all();
        $companies = Company::all();
        $proposals = LeaseProposal::join('billing', 'billing.proposal_id', '=', 'proposal.id')
            ->where('billing.date_end', $request->date)
            ->select('proposal.id as proposal_id', 'billing.id as bill_id', 'billing.status as bill_status', 'proposal.tenant_id', 'proposal.proposal_uid as contract_uid')
            ->get();

        $companies->map(function ($company) use ($proposals, $billing_details) {
            $matching_proposals = $proposals->where('tenant_id', $company->owner_id);
            $company->proposal = $matching_proposals;
            return $company;
        });

        // $companies->map(function($company) use ($bills, $proposals, $commencements) {
        //     $matchedProposals = $proposals->where('tenant_id', $company->owner_id);
        //     $matchedProposals->map(function ($proposal) use ($bills, $commencements) {
        //         $proposal->bill = $bills->where('proposal_id', $proposal->id);
        //         $proposal->commencement = $commencements->firstWhere('proposal_id', $proposal->id);
        //         return $proposal;
        //     });
        //     $company->proposal = $matchedProposals;
        //     return $company;
        // });
        // $bills->map(function ($bill) use ($billing_details, $companies, $proposals) {
        //     $matching_bill_details = $billing_details->firstWhere('billing_id', operator: $bill->id);
        //     $matching_proposal = $proposals->firstWhere('id', $bill->proposal_id ?? null);
        //     $matching_company = $companies->where('owner_id', $matching_proposal->tenant_id ?? null);

        //     $bill->bill_details = $matching_bill_details;
        //     $bill->proposal = $matching_proposal;
        //     $bill->proposal->company = $matching_company;

        //     return $bill;
        // });

        return response()->json($companies);
    }

    public function utilityLists(Request $request)
    {
        // $bills = Billing::where('id', $request->id)->select('billing.proposal_id', 'billing.status', 'billing.id')->first();
        // $utilities = UtilitiesSelected::join('utilities', 'utilities_selected.utility_id', '=', 'utilities.id')
        // // ->where('lease_id', $bills->proposal_id)
        // ->select('utilities_selected.id as selected_utility_id', 'utilities.utility_name', 'utilities_selected.lease_id')
        // ->get();

        // $match_util = $utilities->where('lease_id', $bills->proposal_id);

        // $bills->utilities = $match_util;

        // return response()->json($bills);

        $bills = Billing::where('id', $request->id)
            ->select('billing.proposal_id', 'billing.status', 'billing.id')
            ->first();

        $utilities = UtilitiesSelected::join('utilities', 'utilities_selected.utility_id', '=', 'utilities.id')
            ->select('utilities_selected.id as selected_utility_id', 'utilities.utility_name', 'utilities_selected.lease_id', 'utilities.utility_price', 'utilities_selected.utility_id')
            ->get();

        $readings = UtilitiesReading::all();

        if ($bills) {
            $matched_utilities = $utilities->where('lease_id', $bills->proposal_id);
            $matched_utilities->each(function ($utility) use ($readings) {
                $utility->reading = $readings->firstWhere('utility_id', $utility->selected_utility_id);
            });
            $bills->utilities = $matched_utilities;
        }

        return response()->json($bills);

    }

    public function reading(Request $request)
    {
        $utilities = UtilitiesSelected::join('utilities', 'utilities_selected.utility_id', '=', 'utilities.id')
            ->where('utilities_selected.id', $request->id)
            ->select('utilities_selected.id as selected_utility_id', 'utilities.utility_name')
            ->first();
        $reading = UtilitiesReading::all();

        $matching_reading = $reading->firstWhere('utility_id', $utilities->selected_utility_id);
        $utilities->reading = $matching_reading;

        return response()->json($utilities);
    }

    public function prepare(Request $request)
    {
        $find = UtilitiesReading::where('bill_id', $request->bill_id)
            ->where('date_reading', $request->date_reading)
            ->where('utility_id', $request->utility_id)->first();
        $response = [];
        if (!empty($find)) {
            if($find->prepare == 1){
                $response = [
                    'status' => 'danger',
                    'message' => 'Utility Already Prepared'
                ];
            }else{
                $reading = UtilitiesReading::create([
                    'utility_id' => $request->utility_id,
                    'bill_id' => $request->bill_id,
                    'present_reading' => $request->present_reading,
                    'previous_reading' => $request->previous_reading,
                    'present_reading_date' => $request->present_reading_date,
                    'previous_reading_date' => $request->previous_reading_date,
                    'consumption' => $request->consumption,
                    'utility_price' => $request->total_reading_charge,
                    'total_reading' => $request->total_reading_charge,
                    'date_reading' => $request->date_reading,
                    'prepare' => 1,
                ]);

                if ($reading) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Reading Prepared Successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'danger',
                        'message' => 'Reading Not Prepared'
                    ];
                }
            }
        } else {
            $response = [
                'status' => 'danger',
                'message' => 'Utility Not Found'
            ];
        }
        return response()->json($response);
    }

    public function save(Request $request){
        return response()->json($request->all());
    }
}
