<?php

namespace App\Http\Controllers\admin\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantsSalesReportsController extends Controller
{
    public function adminTenantsSalesReports()
    {
        return view('admin.reports.tenants-sales-reports.index');
    }
}
