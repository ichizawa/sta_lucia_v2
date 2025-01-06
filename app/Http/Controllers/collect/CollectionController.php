<?php

namespace App\Http\Controllers\collect;

use App\Http\Controllers\Controller;
use App\Models\bill\Billing;
use App\Models\bill\BillingDetails;
use App\Models\BillingLedger;
use App\Models\Company;
use App\Models\LeaseProposal;
use App\Models\UtilitiesReading;
use Carbon\Carbon;
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
        $billing_id = LeaseProposal::with(['billing'])->where('tenant_id', $request->id)->get()->first()->billing->id;
        return response()->json(
            // LeaseProposal::with(['billing.bill_details'])->where('tenant_id', $request->id)->get()
            BillingDetails::where('billing_id', $billing_id)->get()
        );
    }

    public function view(Request $request)
    {
        $proposals = LeaseProposal::with(['selected_space.space', 'billing.util_read', 'utilities.util_desc'])
            ->where('tenant_id', $request->id)
            ->get();

        $readings = UtilitiesReading::whereIn('utility_id', $proposals->pluck('utilities.*.utility_id')->flatten())
            ->whereIn('proposal_id', $proposals->pluck('id'))
            ->where('prepare', 2)
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

    public function store(Request $request){
        $bill = Billing::find($request->billing_id);
        $response = [];

        // $response[] = $request->all();
        if($bill){
            if ($bill->is_paid == 1) {
                $response = [
                    'status' => 'danger',
                    'message' => 'Bill already paid',
                    'response' => 404
                ];
            } else {
                if($bill->amount > 0){
                    $bill->is_paid = Billing::PENDING;
                    $bill->amount = $bill->amount - $request->amount_payment;
                    // $bill->is_prepared = Billing::PENDING;
                    // $bill->status = Billing::PENDING;
                    $bill->save();
                }else{
                    $bill->is_paid = Billing::PAID;
                    // $bill->is_prepared = Billing::PENDING;
                    // $bill->status = Billing::PENDING;
                    $bill->save();
                }

                BillingDetails::create([
                    'billing_id' => $request->billing_id,
                    'bill_no' => $request->biller_num,
                    // 'total_sales' => null,
                    'amount' => $request->amount_payment,
                    // 'reference_num' => $request->ref_num ?? null,
                    // 'payment_option' => $request->payment_method,
                    // 'date_from' => $bill->date_start,
                    'date_to' => $bill->date_end,
                    'remarks' => $request->remarks,
                    'status' => 0,
                    'is_paid' => 1
                ]);

                $response = [
                    'status' => 'success',
                    'message' => 'Bill paid successfully',
                    'response' => 200
                ];
            }
        }else{
            $response = [
                'status' => 'danger',
                'message' => 'Billing not found',
                'response' => 404
            ];
        }

        return response()->json($response);
    }

}
