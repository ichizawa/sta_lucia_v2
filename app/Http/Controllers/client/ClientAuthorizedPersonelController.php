<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientAuthorizedPersonelController extends Controller
{
    //
    public function index()
    {
        return view('client.auth-person.auth-person-table');
    }
}
