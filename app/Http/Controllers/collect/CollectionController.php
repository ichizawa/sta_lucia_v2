<?php

namespace App\Http\Controllers\collect;

use App\Http\Controllers\Controller;
use App\Models\bill\Billing;
use App\Models\BillingLedger;
use App\Models\Company;
use App\Models\LeaseProposal;
use App\Models\UtilitiesReading;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        return view('collect.dashboard');
    }

    public function collect()
    {
        return view('collect.collection.index', [
            'bill' => Company::with(['proposals.billing'])->get(),
        ]);
    }

    public function get(Request $request)
    {
        // return response()->json(
        //     LeaseProposal::with(['billing'])->where('id', $request->id)->get()
        // );
        //for ledger
        return response()->json(
            LeaseProposal::with(['billing'])->where('tenant_id', $request->id)->get()
        );
    }

    public function view(Request $request)
    {
        $proposals = LeaseProposal::with(['selected_space.space', 'billing.util_read', 'utilities.util_desc'])
            ->where('tenant_id', $request->id)
            ->get();

        $readings = UtilitiesReading::whereIn('utility_id', $proposals->pluck('utilities.*.utility_id')->flatten())
            ->whereIn('proposal_id', $proposals->pluck('id'))
            ->get()
            ->groupBy('utility_id');

        foreach ($proposals as $proposal) {
            foreach ($proposal->utilities as $utility) {
                $utility->reading = $readings->get($utility->utility_id, collect())->firstWhere('proposal_id', $proposal->id);

                if (!$utility->reading) {
                    $utility->reading = null;
                }
            }
        }

        return response()->json($proposals);

    }

}
