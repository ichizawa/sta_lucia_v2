<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientContractController extends Controller
{
    //
    public function index(){
        return view('client.contracts.contracts-table');
    }
}
