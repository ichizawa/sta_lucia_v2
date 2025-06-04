<?php

namespace App\Http\Controllers\client\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientAwardNoticeReportsController extends Controller
{
    public function index()
    {
        return view('client.reports.award-notice-reports.index');
    }
}
