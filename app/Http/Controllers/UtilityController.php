<?php

namespace App\Http\Controllers;

use App\Events\UtilityEvent;
use App\Models\bill\Billing;
use App\Models\UtilitiesModel;
use App\Models\UtilitiesReading;
use App\Models\Company;
use App\Models\LeaseProposal;
use App\Models\bill\BillingDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UtilityController extends Controller
{


    public function index()
    {
        return view('utility.reading');
    }

//     public function lists(Request $request)
// {
//     $date = $request->query('date');
//     // fetch your companies + proposals for that $date
//     $companies = Company::with(['proposals' => function($q) use ($date) {
//         $q->whereMonth('created_at', Carbon::parse($date)->month);
//     }])->get();

//     return response()->json($companies);
// }


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

    // public function utilityLists(Request $request)
    // {
    //     $proposals = LeaseProposal::with([
    //         'utilities.util_desc',
    //         'billing',
    //         'utilities.util_read' => function ($query) use ($request) {
    //             $query->where('proposal_id', $request->proposal_id);
    //         }
    //     ])
    //         ->where('id', $request->proposal_id)
    //         ->first();

    //     return response()->json($proposals);
    // }
    // in UtilityController.php

public function utilityLists(Request $request)
{
    $proposal = LeaseProposal::with([
        'utilities.util_desc',
        'billing',
    ])
    ->where('id', $request->proposal_id)
    ->first();

    if (! $proposal) {
        return response()->json([
            'utilities' => [],
            'billing'   => null
        ]);
    }
    foreach ($proposal->utilities as $utility) {
        $utility->util_read = UtilitiesReading::where('utility_id', $utility->id)
            ->where('proposal_id', $proposal->id)
            ->first();
    }

    // 3) Return exactly what your JavaScript expects:
    //    • data.utilities  = array of utilities (each has `util_desc` + now `util_read`)
    //    • data.billing    = the billing model
    return response()->json([
        'utilities' => $proposal->utilities,
        'billing'   => $proposal->billing,
    ]);
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
            }
            else if ($billing->prepare == 2) {
                $status = 2;
            }
            else {
                // Mark this reading as “saved/processed”:
                $billing->update(['prepare' => 2]);

                // Update the bill’s debit/total_amount:
                $bill->debit = $bill->debit + $billing->total_reading;
                $bill->change = 0;
                $bill->total_amount = $bill->total_amount + $billing->total_reading;

                // ←––––––––––––––––––––––––––––––––––––––––––––––––––––
                // Change is_reading from “1” to “2” here so JS will show
                // both “Prepared” and “All have readings.”
                // ←––––––––––––––––––––––––––––––––––––––––––––––––––––
                $bill->is_reading = 2;
                $bill->save();

                // Create the billing detail record, etc.
                $utility_name = UtilitiesModel::find($billing->utility_id)->utility_name;
                BillingDetails::create([
                    'billing_id'    => $bill->id,
                    'bill_no'       => $bill->billing_uid,
                    'transaction_id'=> rand(10000, 99999) . '-' . $bill->billing_uid,
                    'debit'         => $billing->total_reading,
                    'credit'        => 0,
                    'change'        => 0,
                    'date_to'       => $bill->date_end,
                    'remarks'       => 'Reading for '
                                       . $utility_name
                                       . ' on '
                                       . Carbon::now()
                                       . ' - '
                                       . $billing->date_reading,
                    'status'        => 0,
                    'is_paid'       => 0,
                ]);

                $status = 1;
            }
        }
    }

    // (Return the JSON response exactly as you had it)
    if ($status == 1) {
        $data = [
            'status'  => 'success',
            'message' => "Reading for Bill has been updated and saved."
        ];
    }
    // … (rest of your existing logic)
    return response()->json($data);
}

    public function dashboard()
    {
        // any data you need can be loaded here. For example:
        $totalUtilities = UtilitiesModel::count();

        // return a new Blade view at resources/views/admin/utility-dashboard.blade.php
        return view('utility.dashboard', [
            'totalUtilities' => $totalUtilities,
            // … send anything else your dashboard needs …
        ]);
    }

    public function adminUtility()
    {
        $all = UtilitiesModel::orderBy('id', 'asc')->get();
        return view('admin.utility', compact('all'));
    }

    public function adminAddUtility(Request $request)
    {
        $utilities = UtilitiesModel::create([
            'utility_name' => $request->utility_name,
            'utility_type' => $request->utility_type,
            'utility_description' => $request->utility_description,
            'utility_price' => $request->utility_price,
        ]);

        if ($utilities) {
            event(new UtilityEvent($utilities));
        }

        return back()->with('success', 'Utility added successfully');
    }

    public function deleteUtility(Request $request)
    {

        $utility = UtilitiesModel::find($request->id);

        if ($utility) {
            $utility->delete();
            event(new UtilityEvent($utility));
            return response()->json(['message', 'Utility successfully deleted']);
        } else {
            return response()->json(['message' => 'Utility not Found'], 404);
        }
    }
}
