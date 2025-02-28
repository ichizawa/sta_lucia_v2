<?php

namespace App\Http\Controllers\lease_admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class IssuePermitscontroller extends Controller
{
    public function permits_index(){
        $tenants = Company::all();
        return view('lease-admin.issue-permits.issue-permits', compact('tenants'));
    }
}
