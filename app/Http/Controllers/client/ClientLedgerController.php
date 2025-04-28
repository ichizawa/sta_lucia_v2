<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\bill\BillingDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientLedgerController extends Controller
{
    public function index()
    {
        // $ledgerData = BillingDetails::all();
        // return view('client.ledger.ledger-table', compact('ledgerData'));
        return view('client.ledger.ledger-table');
    }
}
