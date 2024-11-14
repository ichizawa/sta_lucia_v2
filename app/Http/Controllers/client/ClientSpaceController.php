<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientSpaceController extends Controller
{
    //
    public function index()
    {
        return view('client.spaces.space-table');
    }
}
