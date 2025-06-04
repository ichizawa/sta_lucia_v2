<?php

namespace App\Http\Controllers\admin\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermitReportsController extends Controller
{
    public function adminPermitReports(){
        return view('admin.reports.permit-reports.index');
    }
}
