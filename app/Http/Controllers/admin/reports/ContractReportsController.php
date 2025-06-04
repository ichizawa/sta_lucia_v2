<?php

namespace App\Http\Controllers\admin\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContractReportsController extends Controller
{
    public function adminContractReports(){
        return view('admin.reports.contract-reports.index');
    }
}
