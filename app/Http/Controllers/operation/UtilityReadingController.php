<?php

namespace App\Http\Controllers\operation;

use App\Http\Controllers\Controller;
use App\Models\bill\Billing;
use App\Models\bill\BillingDetails;
use App\Models\Company;
use App\Models\LeaseProposal;
use App\Models\UtilitiesModel;
use App\Models\UtilitiesReading;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UtilityReadingController extends Controller
{
    public function index()
    {
        return view('operations.reading');
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
                    $bill->is_reading = 2;
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
            $bill->is_reading = 2;
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
        $status = 0;

        foreach ($bill_ids as $id) {
            $bill = Billing::find($id);
            $billingRecords = UtilitiesReading::where('bill_id', $id)->get();
            if ($billingRecords->isEmpty()) {
                $status = 4;
                continue;
            }

            foreach ($billingRecords as $billing) {
                if ($billing->prepare == 0) {
                    $status = 3;
                } else if ($billing->prepare == 2) {
                    $status = 2;
                } else {
                    $billing->update(['prepare' => 2]);
                    $bill->debit = $bill->debit + $billing->total_reading;
                    $bill->change = 0;
                    $bill->total_amount = $bill->total_amount + $billing->total_reading;
                    $bill->is_reading = 1;
                    $bill->save();

                    $utility_name = UtilitiesModel::find($billing->utility_id)->utility_name;

                    BillingDetails::create([
                        'billing_id' => $bill->id,
                        'bill_no' => $bill->billing_uid,
                        'transaction_id' => rand(10000, 99999) . '-' . $bill->billing_uid,
                        // 'total_sales' => null,
                        'debit' => $billing->total_reading,
                        'credit' => 0,
                        'change' => 0,
                        // 'reference_num' => $request->ref_num ?? null,
                        // 'payment_option' => $request->payment_method,
                        // 'date_from' => $bill->date_start,
                        'date_to' => $bill->date_end,
                        'remarks' => 'Reading for ' . $utility_name . ' on ' . Carbon::now() . ' - ' . $billing->date_reading,
                        'status' => 0,
                        'is_paid' => 0
                    ]);

                    // BillReading::create([

                    // ]);

                    $status = 1;
                }
            }
        }

        if ($status == 1) {
            $data = [
                'status' => 'success',
                'message' => "Reading for Bill has been updated and saved."
            ];
        } else if ($status == 2) {
            $data = [
                'status' => 'warning',
                'message' => "Reading for Bill is already prepared."
            ];
        } else if ($status == 3) {
            $data = [
                'status' => 'danger',
                'message' => "Reading for Bill is not prepared."
            ];
        } else if ($status == 4) {
            $data = [
                'status' => 'warning',
                'message' => "No record found for Bill"
            ];
        } else {
            $data = [
                'status' => 'danger',
                'message' => "Something went wrong."
            ];
        }

        return response()->json($data);
    }
}
