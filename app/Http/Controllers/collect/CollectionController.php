<?php

namespace App\Http\Controllers\collect;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\BillingDetails;
use App\Models\ChargesSelected;
use App\Models\Company;
use App\Models\LeaseProposal;
use App\Models\UtilitiesSelected;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index(){
        return view('collect.dashboard');
    }

    public function collect(){
        $bill = Billing::all();
        $bill_details = BillingDetails::all();
        
        return view('collect.collection.index');
    }
}
