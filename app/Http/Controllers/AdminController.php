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
        $all = Amenities::all();
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
}
