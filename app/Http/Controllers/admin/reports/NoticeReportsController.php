<?php

namespace App\Http\Controllers\admin\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoticeReportsController extends Controller
{
    public function adminNoticeReports(){
        return view('admin.reports.notice-reports.index');
    }

}
