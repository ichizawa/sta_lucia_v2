<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function adminBranch()
    {
        return view('admin.branch');
    }

    public function adminAddBranch(Request $request){
        // User::create([
        //     'name' => $request->branch_name,
        //     'email' => $request->branch_email,
        //     'type' => 'tenant',

        // ]);
        return back()->with('success', 'Branch Added Successfully');
    }
}
