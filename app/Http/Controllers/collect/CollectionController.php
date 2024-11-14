<?php

namespace App\Http\Controllers\collect;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\BillingDetails;
use App\Models\ChargesSelected;
use App\Models\Company;
use App\Models\LeaseProposal;
use App\Models\UtilitiesSelected;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index(){
        return view('collect.dashboard');
    }

    public function collect(){
        $billing = Billing::all();
        $bill_details = BillingDetails::all();
        $proposal = LeaseProposal::all();
        $company = Company::all();
        $extra_charges = ChargesSelected::join('charges', 'extra_charges_selected.charge_id', '=', 'charges.id')
        ->select('charges.*', 'extra_charges_selected.lease_id')->get();
        $extra_utilities = UtilitiesSelected::join('utilities', 'utilities_selected.utility_id', '=', 'utilities.id')
        ->select('utilities.*', 'utilities_selected.lease_id')->get();

        $proposal->map(function ($proposals) use ($company, $extra_charges, $extra_utilities) {
            $matching_charges = $extra_charges->filter(function ($charges) use ($proposals) {
                return $charges->lease_id == $proposals->id;
            });
            $matching_utilities = $extra_utilities->filter(function ($utilities) use ($proposals) {
                return $utilities->lease_id == $proposals->id;
            });
            $company->map(function ($company) use ($proposals) {
                return $company->owner_id = $proposals->id;
            });

            $proposals->charges = $matching_charges;
            $proposals->utilities = $matching_utilities;
            $proposals->company = $company;

            return $proposals;
        });
        
        $billing->map(function ($billings) use ($bill_details, $proposal) {
           $matching_bill_details = $bill_details->filter(function ($bill_details) use ($billings) {
               return $billings->id == $bill_details->billing_id;
           });
           $matching_proposal = $proposal->filter(function ($proposal) use ($matching_bill_details) {
               return $matching_bill_details->contains('id', $proposal->id);
           });
           $billings->details = $matching_bill_details;
           $billings->proposal = $matching_proposal;

           return $billings;
        });
        
        return view('collect.collection.index', compact('billing'));
    }
}
