<?php

namespace App\Http\Controllers\biller;

use App\Http\Controllers\Controller;
use App\Models\AwardNotice;
use App\Models\bill\Billing;
use App\Models\bill\BillingDetails;
use App\Models\BillingLedger;
use App\Models\CommencementProposal;
use App\Models\Company;
use App\Models\Contracts;
use App\Models\LeaseProposal;
use App\Models\UtilitiesReading;
use App\Models\UtilitiesSelected;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        return view('biller.dashboard');
    }

    public function bill()
    {
        return view('biller.bill.billing-index');
    }

    public function contractLists(Request $request)
    {
        $company = Company::with(['proposals.billing'])
            ->whereRelation('proposals.billing', $request->date ? 'date_end' : 'date_start', $request->date)
            ->get();

        return response()->json($company);
    }

    public function prepare(Request $request)
    {
        $bill_ids = $request->input('bill_id', []);
        $date = $request->input('date');

        $latest_uid = Billing::max('id');
        $nextId = $latest_uid ? $latest_uid + 1 : 1;

        $billDate = new \DateTime($date);
        $billDate->modify('+1 month');
        $billing_date = $billDate->format('Y-m');

        $response = [];

        if (!empty($bill_ids)) {
            foreach ($bill_ids as $id) {
                $billing = Billing::find($id);
                if ($billing->is_prepared == Billing::PENDING) {
                    $billing->date_end = $billing_date;
                    $billing->is_prepared = Billing::PREPARED;
                    $billing->status == Billing::PREPARED;
                    $billing->save();

                    $response = [
                        'response' => 200,
                        'status' => 'success',
                        'message' => 'Bill prepared successfully'
                    ];
                } else {
                    $response = [
                        'response' => 400,
                        'status' => 'danger',
                        'message' => 'Bill already prepared'
                    ];
                }
            }
        }else{
            $response = [
                'response' => 400,
                'status' => 'danger',
                'message' => 'No bills to prepare'
            ];
        }
        return back()->with($response);

        // $data = [];
        // $response = [
        //     'response' => 400,
        //     'status' => 'danger',
        //     'message' => 'No bills to prepare',
        // ];
        // if (!empty($bill_ids)) {
        //     foreach ($bill_ids as $bill_id) {
        //         $billing = Billing::find($bill_id);
        //         if (!$billing) {
        //             continue;
        //         }
        //         $bill_num = 'STL-' . rand(10000, 99999) . '-' . $nextId;
        //         if ($billing->status == 0) {
        //             $billing->date_end = $billing_date;
        //             $billing->status = 2;
        //             $billing->save();
        //             BillingDetails::create([
        //                 'billing_id' => $bill_id,
        //                 'bill_no' => $bill_num,
        //                 'date_from' => $date,
        //                 'date_to' => $billing_date,
        //                 'remarks' => null,
        //                 'status' => 0,
        //             ]);
        //             $response = [
        //                 'response' => 200,
        //                 'status' => 'success',
        //                 'message' => 'Bills prepared successfully',
        //             ];
        //         } else if ($billing->status == 1) {
        //             $billnumber = 'STL-' . rand(10000, 99999) . '-' . $nextId;
        //             $billingDetails = BillingDetails::where('billing_id', $bill_id)->get();
        //             foreach ($billingDetails as $detail) {
        //                 $detail->update([
        //                     'bill_no' => $billnumber,
        //                     'date_from' => $date,
        //                     'date_to' => $billing_date,
        //                     'remarks' => null,
        //                     'status' => 0,
        //                 ]);
        //             }
        //             $response = [
        //                 'response' => 200,
        //                 'status' => 'success',
        //                 'message' => 'Bills updated successfully',
        //             ];
        //         } else {
        //             $response = [
        //                 'response' => 400,
        //                 'status' => 'danger',
        //                 'message' => 'Some bills are already prepared',
        //             ];
        //         }
        //     }
        // }
        // return back()->with($response);

    
    }

    public function checkBills(Request $request)
    {
        $company = Company::with(['proposals.billing'])
            ->whereRelation('proposals.billing', $request->date ? 'date_end' : 'date_start', $request->date)
            ->get();
        return response()->json($company);

    }
    public function period()
    {
        return view('biller.period.billing-period');
    }
}
