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
use App\Models\UtilitiesModel;
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
        return redirect()->route('login');
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
        $all = Amenities::orderBy('id', 'desc')->get();
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
            $ameneties->delete();
            return response()->json(['message', 'Utility successfully deleted']);
        } else {
            return response()->json(['message' => 'Utility not Found'], 404);
        }
    }

    public function adminActivityLog()
    {
        return view('admin.activity-log');
    }
    public function updateAmenities(Request $request, $id)
    {
        $amenity = Amenities::find($id);
        if ($amenity) {
            $amenity->update([
                'amenity_name' => $request->amenity_name,
            ]);
            return back()->with('success', 'Amenity updated successfully');
        }
        return back()->with('error', 'Amenity not found');
    }
    public function updateUtility(Request $request, $id)
    {
        $utility = UtilitiesModel::find($id);
        if ($utility) {
            $utility->update([
                'utility_name' => $request->utility_name,
                'utility_type' => $request->utility_type,
                'utility_description' => $request->utility_description,
                'utility_price' => $request->utility_price,
            ]);
            return back()->with('success', 'Utility updated successfully');
        }
        return back()->with('error', 'Utility not found');
    }
}
