<?php

namespace App\Http\Controllers\client\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientContractReportsController extends Controller
{
    public function index()
    {
        return view('client.reports.contract-reports.index');
    }
}
