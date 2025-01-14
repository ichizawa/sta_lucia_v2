<?php

namespace App\Http\Controllers\collect;

use App\Http\Controllers\Controller;
use App\Models\bill\BillingDetails;
use App\Models\LeaseProposal;
use Illuminate\Http\Request;

class CollectionLedgerController extends Controller
{
    public function collect_index(Request $request){
        $billing_id = LeaseProposal::with(['billing'])->where('id', $request->id)->get()->first()->billing->id;
        return response()->json(
            BillingDetails::where('billing_id', $billing_id)->orderByDesc('id')->get()
        );
    }
}
