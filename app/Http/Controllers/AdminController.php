<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Billing;
use App\Models\BillingDetails;
use App\Models\ChargesSelected;
use App\Models\Company;
use App\Models\LeaseProposal;
use App\Models\UtilitiesSelected;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminIndex()
    {
        if (Auth::check()) {
            return view('admin.dashboard');
        }
        return redirect()->route('auth.login');
    }

    public function adminSettings()
    {
        return view('admin.settings');
    }

    public function adminReports()
    {
        return view('admin.reports');
    }

    public function adminAmenities()
    {
        $all = Amenities::where('status', 0)->get();
        return view('admin.amenities', compact('all'));
    }

    public function adminSubmitAmenities(Request $request)
    {
        Amenities::create([
            'amenity_name' => $request->amenity_name,
            'amenity_status' => 0
        ]);
        return back()->with('success', 'Amenities added successfully');
    }

    public function deleteAmenities(Request $request)
    {
        $ameneties = Amenities::find($request->id);

        if ($ameneties) {
            $ameneties->status = 1;
            $ameneties->save();

            return response()->json(['message', 'Amenities successfully deleted']);
        } else {
            return response()->json(['message' => 'Amenities not Found'], 404);
        }
    }

    public function adminBillingPeriods(){
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
        return view('admin.bill.bill', compact('billing'));
    }
}
