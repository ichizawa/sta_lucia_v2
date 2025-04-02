<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientLedgerController extends Controller
{
    public function index()
    {
        return view('client.ledger.ledger-table');
    }
}
