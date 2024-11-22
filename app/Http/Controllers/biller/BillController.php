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
use App\Models\UtilitiesReading;
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
        $tenants = Company::all();
        $proposals = LeaseProposal::all();
        $bills = Billing::all();
        $commencements = CommencementProposal::all();

        $tenants->map(function ($tenant) use ($proposals, $bills, $commencements) {
            $matchedProposals = $proposals->where('tenant_id', $tenant->owner_id);
            $matchedProposals->map(function ($proposal) use ($bills, $commencements) {
                $proposal->bill = $bills->where('proposal_id', $proposal->id);
                $proposal->commencement = $commencements->firstWhere('proposal_id', $proposal->id);
                return $proposal;
            });
            $tenant->proposal = $matchedProposals;
            return $tenant;
        });

        return response()->json($tenants);

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
