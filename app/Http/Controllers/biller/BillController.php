<?php

namespace App\Http\Controllers\biller;

use App\Http\Controllers\Controller;
use App\Models\AwardNotice;
use App\Models\Billing;
use App\Models\BillingDetails;
use App\Models\BillingLedger;
use App\Models\CommencementProposal;
use App\Models\Company;
use App\Models\Contracts;
use App\Models\LeaseProposal;
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
        $bill = Billing::join('proposal', 'billing.proposal_id', '=', 'proposal.id')
            ->join('company', 'company.owner_id', '=', 'proposal.tenant_id')
            ->join('commencement_proposals', 'proposal.id', '=', 'commencement_proposals.proposal_id')
            ->select('proposal.proposal_uid', 'company.acc_id', 'billing.*', 'commencement_proposals.commencement_date')
            ->where('billing.date_start', $request->date)
            // ->where('billing.status', 0)
            ->get();

        return response()->json($bill);
    }

    public function prepare(Request $request)
    {
        $bill_id = $request->input('bill_id', []);
        $date = $request->input('date');

        $latest_uid = Billing::max('id');
        $nextId = $latest_uid ? $latest_uid + 1 : 1;

        $billdate = new \DateTime($date);
        $billdate->modify('+1 months');
        $billing_date = $billdate->format('Y-m');
        $data = [];
        foreach ($bill_id as $bill) {
            $billing = Billing::find($bill);
            if ($billing->status == 0 || $billing->status == 1) {
                $billing->date_end = $billing_date;
                $billing->status = 2;
                $billing->update();
                $bill_num = 'STL-' . rand(10000, 99999) . '-' . $nextId;
                $billingDetails = BillingDetails::create([
                    'billing_id' => $bill,
                    'bill_no' => $bill_num,
                    'date_from' => $date,
                    'date_to' => $billing_date,
                    'remarks' => null,
                    'status' => 0
                ]);

                if ($billingDetails) {
                    $data[] = $billingDetails;
                }
            }else{
                $data = [];
            }
        }
        if (count($data) == 0) {
            return back()->with([
                'status' => 'danger',
                'message' => 'No bills to prepare'
            ]);
        } else {
            return back()->with([
                'status' => 'success',
                'message' => 'Bills prepared successfully'
            ]);
        }
    }

    public function checkBills(Request $request)
    {
        $data = BillingDetails::where('date_to', $request->date)->where('status', 0)->get();
        return response()->json($data);
    }
    public function period()
    {
        return view('biller.period.billing-period');
    }
}
