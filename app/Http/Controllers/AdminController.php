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
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function adminIndex()
    {
        if (Auth::check()) {
            return view('admin.dashboard');
        }
        return redirect()->route('login');
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

    public function adminNoticesReports()
    {
        return view('admin.reports.notice_reports');
    }
    public function adminTenantSalesReports()
    {
        return view('admin.reports.tenant_sales_reports');
    }
    public function adminSpaceLeasesReports()
    {
        return view('admin.reports.space_leases_reports');
    }
    public function adminPermitReports()
    {
        return view('admin.reports.permit_reports');
    }
    public function adminContractReports()
    {
        return view('admin.reports.contract_reports');
    }
    public function adminSettings()
    {
        return view('admin.settings.settings');
    }
    public function adminInbox()
    {
        return view('admin.inbox.inbox');
    }
    public function adminUsers()
    {
        $users = User::all();
        return view('admin.users.users', compact('users'));
    }


    public function adminSubmitUser(Request $request)
{
    $userId = $request->input('id');

    try {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                $userId
                    ? Rule::unique('users', 'email')->ignore($userId)
                    : 'unique:users,email',
            ],
            'type' => 'required|string|max:255',
            'status' => 'required|boolean',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'username' => [
                'required',
                'string',
                'max:255',
                $userId
                    ? Rule::unique('users', 'username')->ignore($userId)
                    : 'unique:users,username',
            ],
            'password' => $userId ? 'nullable|string|min:8' : 'required|string|min:8',
        ]);

        $user = $userId ? User::findOrFail($userId) : new User();

        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->address = $validatedData['address'];
        $user->phone = $validatedData['phone'];
        $user->email = $validatedData['email'];
        $user->type = $validatedData['type'];
        $user->status = $validatedData['status'];

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->back()->with('success', $userId ? 'User updated successfully.' : 'User added successfully.');
    } catch (ValidationException $e) {
        $errorMessage = collect($e->validator->errors()->all())->first();
        return redirect()->back()->with('error', $errorMessage)->withInput();
    }
}

    public function adminDeleteUser(Request $request)
    {
        $user = User::find($request->id);

        if ($user) {
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'User not found.'
        ]);
    }

    public function getUserDetails(Request $request)
    {
        $user = User::findOrFail($request->id);
        return response()->json($user);
    }

}
