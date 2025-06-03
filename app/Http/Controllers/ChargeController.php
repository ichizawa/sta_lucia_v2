<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    public function adminCharges()
    {
        $all = Charge::orderBy('id', 'desc')->get();
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
        $delete = Charge::where('id', $request->id)->delete();

        if(!$delete){
            return response()->json(['success'=> 'Something went wrong']);
        }

        return response()->json(['success'=> 'Charge deleted successfully']);
        // return back()->with('success', 'Charge deleted successfully');
    }
}
