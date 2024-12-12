<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    public function adminCharges()
    {
        $all = Charge::where('status', 0)->get();
        return view('admin.charge.charges', compact('all'));
    }

    public function adminAddCharges(Request $request)
    {
        $charges = Charge::create([
            'charge_name' => $request->chargename,
            'charge_fee' => $request->chargefee,
            'frequency' => $request->chargefrequency,
        ]);


        return back()->with('success', 'Charge added successfully');
    }

    public function getLeaseCharges()
    {
        $leaseCharges = Charge::get();
        return view('admin.leases.add-proposal', compact('leaseCharges'));
    }

    public function adminDeleteCharges(Request $request)
    {
        // $delete = Charge::where('id', $request->id)->delete();
        // return back()->with('success', 'Charge deleted successfully');

        $delete = Charge::find($request->id);

        if ($delete) {
            $delete->status = 1;
            $delete->save();

            return response()->json(['message' => 'Charges successfully deleted']);
        } else {
            return response()->json(['message' => 'Charges not found'], 404);
        }
    }
}
