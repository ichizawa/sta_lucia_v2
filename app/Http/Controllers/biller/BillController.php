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
        $date = $request->date;

        $tenants = Company::all();
        $proposals = LeaseProposal::all();
        $bills = Billing::all();
        $bill_details = BillingDetails::all();
        $commencements = CommencementProposal::all();

        $tenants->map(function ($tenant) use ($proposals, $bills, $bill_details, $commencements, $date) {
            $matchProposal = $proposals->where('tenant_id', $tenant->owner_id);

            $matchProposal->map(function ($proposal) use ($bills, $bill_details, $commencements, $date) {
                $proposal->commencement = $commencements->firstWhere('proposal_id', $proposal->id);
                $proposal->bill = $bills->where('proposal_id', $proposal->id);
                $proposal->bill_details = $bill_details->whereIn('billing_id', $proposal->bill->pluck('id'));

                if ($proposal->bill_details->isEmpty() || $proposal->bill_details->every(fn($detail) => $detail->date_to === null)) {
                    $proposal->is_date_match = $proposal->commencement && $proposal->commencement->commencement_date === $date;
                } else {
                    $proposal->is_date_match = $proposal->bill_details->contains(fn($detail) => $detail->date_to === $date);
                }

                return $proposal;
            });

            $tenant->proposal = $matchProposal->filter(function ($proposal) {
                return $proposal->is_date_match;
            });

            return $tenant;
        });

        $filteredTenants = $tenants->filter(function ($tenant) {
            return $tenant->proposal->isNotEmpty();
        });

        return response()->json($filteredTenants);

        // $tenants->map(function ($tenant) use ($proposals, $bills, $commencements) {
        //     $matchedProposals = $proposals->where('tenant_id', $tenant->owner_id);
        //     $matchedProposals->map(function ($proposal) use ($bills, $commencements) {
        //         $proposal->bill = $bills->where('proposal_id', $proposal->id);
        //         $proposal->commencement = $commencements->firstWhere('proposal_id', $proposal->id);
        //         return $proposal;
        //     });
        //     $tenant->proposal = $matchedProposals;
        //     return $tenant;
        // });
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

        $data = [];
        $response = [
            'response' => 400,
            'status' => 'danger',
            'message' => 'No bills to prepare',
        ];

        if (!empty($bill_ids)) {
            foreach ($bill_ids as $bill_id) {
                $billing = Billing::find($bill_id);

                if (!$billing) {
                    continue;
                }

                if ($billing->status == 0 || $billing->status == 1) {
                    $billing->date_end = $billing_date;
                    $billing->status = 2;
                    $billing->save();

                    $bill_num = 'STL-' . rand(10000, 99999) . '-' . $nextId;
                    $billingDetails = BillingDetails::create([
                        'billing_id' => $bill_id,
                        'bill_no' => $bill_num,
                        'date_from' => $date,
                        'date_to' => $billing_date,
                        'remarks' => null,
                        'status' => 0,
                    ]);

                    if ($billingDetails) {
                        $data[] = $billingDetails;
                        $response = [
                            'response' => 200,
                            'status' => 'success',
                            'message' => 'Bills prepared successfully',
                        ];
                    }
                } else {
                    $response = [
                        'response' => 400,
                        'status' => 'danger',
                        'message' => 'Some bills are already prepared',
                    ];
                }
            }
        }

        return back()->with($response);

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
