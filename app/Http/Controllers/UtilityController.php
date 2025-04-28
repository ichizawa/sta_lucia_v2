<?php

namespace App\Http\Controllers;

use App\Models\UtilitiesModel;
use Illuminate\Http\Request;

class UtilityController extends Controller
{

    public function adminUtility()
    {
        $all = UtilitiesModel::orderBy('id', 'desc')->get();
        return view('admin.utility', compact('all'));
    }

    public function adminAddUtility(Request $request){
        $utilities = UtilitiesModel::create([
            'utility_name' => $request->utility_name,
            'utility_type' => $request->utility_type,
            'utility_description' => $request->utility_description,
            'utility_price' => $request->utility_price,
        ]);

        return back()->with('success', 'Utility added successfully');
    }

    public function deleteUtility(Request $request){
     
        $utility = UtilitiesModel::find($request->id);

        if ($utility){
            $utility->delete();
             return response()->json(['message', 'Utility successfully deleted']);
        }
        else{
            return response()->json(['message' => 'Utility not Found'], 404);
        }
    }
}
