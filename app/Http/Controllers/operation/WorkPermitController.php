<?php

namespace App\Http\Controllers\operation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkPermitController extends Controller
{
    public function index()
    {
        return view('operations.work_permit');
    }
}
