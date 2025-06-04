<?php

namespace App\Http\Controllers\client\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientTenantSalesReportsController extends Controller
{
    public function index()
    {
        return view('client.reports.tenant-sales-reports.index');
    }
}
