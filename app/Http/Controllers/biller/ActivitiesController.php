<?php

namespace App\Http\Controllers\biller;

use App\Http\Controllers\Controller;
use App\Models\bill\BillReading;
use App\Models\bill\Billing;
use App\Models\bill\BillingDetails;
use App\Models\CommencementProposal;
use App\Models\Company;
use App\Models\LeaseProposal;
use App\Models\UtilitiesModel;
use App\Models\UtilitiesReading;
use App\Models\UtilitiesSelected;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\IsEmpty;
use function PHPUnit\Framework\isEmpty;

class ActivitiesController extends Controller
{
    public function index()
    {
        return view('biller.reading.index');
    }

    public function lists(Request $request)
    {
        $company = Company::with([
            'proposals.billing',
            'proposals.utilities.util_desc',
        ])
            ->whereHas('proposals.billing', function ($query) use ($request) {
                $query->where('date_end', 'like', "{$request->date}%")
                    ->orWhere(function ($q) use ($request) {
                        $q->whereNull('date_end')
                            ->where('date_start', 'like', "{$request->date}%");
                    })
                    ->where('is_prepared', Billing::PREPARED);
            })
            ->get();

        foreach ($company as $companyItem) {
            foreach ($companyItem->proposals as $proposal) {
                foreach ($proposal->utilities as $utility) {
                    $utility->readings = UtilitiesReading::where('utility_id', $utility->utility_id)
                        ->where('proposal_id', $proposal->id)
                        ->get();

                    if ($utility->readings->isEmpty()) {
                        $utility->readings = null;
                    }
                }
            }
        }

        return response()->json($company);
    }

    public function utilityLists(Request $request)
    {
        $proposals = LeaseProposal::with([
            'utilities.util_desc',
            'billing',
            'utilities.util_read' => function ($query) use ($request) {
                $query->where('proposal_id', $request->proposal_id);
            }
        ])
            ->where('id', $request->proposal_id)
            ->first();

        return response()->json($proposals);
    }

    public function reading(Request $request)
    {
        $utility = UtilitiesReading::where([
            ['proposal_id', $request->prop_id],
            ['utility_id', $request->id]
        ])->first();
        return response()->json($utility);
    }

    public function prepare(Request $request)
    {
        $find = UtilitiesReading::where('bill_id', $request->bill_id)
            ->where('date_reading', $request->date_reading)
            ->where('utility_id', $request->utility_id)->first();
        $bill = Billing::find($request->bill_id);

        $response = [];
        if (!empty($find)) {
            if ($find->prepare == 1) {
                $response = [
                    'status' => 'danger',
                    'message' => 'Utility Already Prepared'
                ];
            } else if ($find->prepare == 2) {
                $response = [
                    'status' => 'danger',
                    'message' => 'Utility Already Prepared, Waiting for Payment'
                ];
            } else {
                $reading = $find->update([
                    'present_reading' => $request->present_reading,
                    'previous_reading' => $request->previous_reading,
                    'present_reading_date' => $request->present_reading_date,
                    'previous_reading_date' => $request->previous_reading_date,
                    'consumption' => $request->consumption,
                    'utility_price' => $request->total_reading_charge,
                    'total_reading' => $request->total_reading_charge,
                    'date_reading' => $request->date_reading,
                    'prepare' => 1,
                ]);

                if ($reading) {
                    // $bill->amount = $bill->amount + $request->total_reading_charge;
                    // $bill->total_amount = $bill->total_amount + $request->total_reading_charge;

                    $bill->save();
                    $response = [
                        'status' => 'success',
                        'message' => 'Reading Prepared Successfully'
                    ];
                } else {
                    $response = [
                        'status' => 'danger',
                        'message' => 'Reading Not Prepared'
                    ];
                }
            }
        } else {
            UtilitiesReading::create([
                'utility_id' => $request->utility_id,
                'proposal_id' => $request->proposal_id,
                'bill_id' => $request->bill_id,
                'present_reading' => $request->present_reading,
                'previous_reading' => $request->previous_reading,
                'present_reading_date' => $request->present_reading_date,
                'previous_reading_date' => $request->previous_reading_date,
                'consumption' => $request->consumption,
                'utility_price' => $request->total_reading_charge,
                'total_reading' => $request->total_reading_charge,
                'date_reading' => $request->date_reading,
                'prepare' => 1,
            ]);

            // $bill->amount = $bill->amount + $request->total_reading_charge;
            // $bill->total_amount = $bill->total_amount + $request->total_reading_charge;

            $bill->save();
            
            $response = [
                'status' => 'success',
                'message' => 'Utilities Reading Prepared Successfully'
            ];
        }
        return response()->json($response);
    }

    public function save(Request $request)
    {
        $bill_ids = $request->input('bill_id', []);
        $data = [];
        foreach ($bill_ids as $id) {
            $bill = Billing::find($id);
            $billingRecords = UtilitiesReading::where('bill_id', $id)->get();
            if ($billingRecords->isEmpty()) {
                $data[] = [
                    'status' => 'warning',
                    'message' => "No record found for Bill ID $id."
                ];
                continue;
            }

            foreach ($billingRecords as $billing) {
                if ($billing->prepare == 0) {
                    $data[] = [
                        'status' => 'danger',
                        'message' => "Reading for Bill ID $id is not prepared."
                    ];
                } else if ($billing->prepare == 2) {
                    $data[] = [
                        'status' => 'warning',
                        'message' => "Reading for Bill ID $id is already prepared."
                    ];
                } else {
                    $billing->update(['prepare' => 2]);
                    $bill->amount = $bill->amount + $billing->total_reading;
                    $bill->total_amount = $bill->total_amount + $billing->total_reading;
                    $bill->save();

                    $utility_name = UtilitiesModel::find($billing->utility_id)->utility_name;

                    BillingDetails::create([
                        'billing_id' => $bill->id,
                        'bill_no' => $bill->billing_uid,
                        'transaction_id' => rand(10000, 99999) . '-' . $bill->billing_uid,
                        // 'total_sales' => null,
                        'amount' => $billing->total_reading,
                        // 'reference_num' => $request->ref_num ?? null,
                        // 'payment_option' => $request->payment_method,
                        // 'date_from' => $bill->date_start,
                        'date_to' => $bill->date_end,
                        'remarks' => 'Reading for ' . $utility_name . 'on' . Carbon::now() . ' - ' . $billing->date_reading,
                        'status' => 0,
                        'is_paid' => 0
                    ]);

                    // BillReading::create([
                        
                    // ]);
                    
                    // BillReading::create([
                    //     'reading_id' => $billing->id,
                    //     'bill_id' => $billing->bill_id,
                    //     'utility_id' => $billing->utility_id,
                    //     'present_reading' => $billing->present_reading,
                    //     'previous_reading' => $billing->previous_reading,
                    //     'present_reading_date' => $billing->present_reading_date,
                    //     'previous_reading_date' => $billing->previous_reading_date,
                    //     'consumption' => $billing->consumption,
                    //     'utility_price' => $billing->utility_price,
                    //     'total_reading' => $billing->total_reading,
                    //     'date_reading' => $billing->date_reading,
                    //     'status' => 1,
                    // ]);

                    $data[] = [
                        'status' => 'success',
                        'message' => "Reading for Bill ID $id has been updated and saved."
                    ];
                }
            }
        }
        return response()->json($data);
    }
}
