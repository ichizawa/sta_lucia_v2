<?php

namespace App\Http\Controllers\admin\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpaceLeasesReportsController extends Controller
{
    public function adminSpaceLeasesReports()
    {
        return view('admin.reports.space-leases-reports.index');
    }
}
