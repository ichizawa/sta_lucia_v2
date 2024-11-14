<?php

namespace App\Http\Controllers\biller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function index(){
        return view('biller.invoices.invoices');
    }
}
