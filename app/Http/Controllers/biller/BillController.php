<?php

namespace App\Http\Controllers\biller;

use App\Http\Controllers\Controller;
use App\Models\bill\Billing;
use App\Models\bill\BillingDetails;
use App\Events\BillerEvent;
use App\Models\Company;
use App\Models\LeaseProposal;
use Carbon\Carbon;
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
            ->whereHas('proposals.billing', function ($query) use ($request) {
                $query->where('date_end', 'like', "{$request->date}%")
                      ->orWhere(function ($q) use ($request) {
                          $q->whereNull('date_end')
                            ->where('date_start', 'like', "{$request->date}%");
                      });
            })
            ->get();

        return response()->json($company);
    }

    public function prepare(Request $request)
    {
        $bill_ids = $request->input('bill_id', []);
        $date     = $request->input('date');

        $latest_uid = Billing::max('id');
        $nextId     = $latest_uid ? $latest_uid + 1 : 1;

        $billDate = new \DateTime($date);
        $billDate->modify('+1 month')->modify('+4 days');
        $billing_date = $billDate->format('Y-m-d');

        $preparedIds = [];
        $response    = [];

        if (! empty($bill_ids)) {
            foreach ($bill_ids as $id) {
                $billing = Billing::find($id);
                if (! $billing) {
                    continue;
                }

                $proposal = LeaseProposal::with(['selected_space.space'])
                    ->find($billing->proposal_id);
                if (! $proposal) {
                    continue;
                }

                $billing->date_end = new \DateTime($billing->date_end);
                $amount = 0;

                if ($billing->is_prepared == Billing::PENDING) {

                    if ($proposal->min_mgr == 0) {
                        $amount = $proposal->total_mgr;
                    }

                    $billing->billing_uid  = rand(100000, 999999) . '-' . $nextId;
                    $billing->total_amount = $amount;
                    $billing->credit       = 0;
                    $billing->debit        = $amount;
                    $billing->change       = 0;
                    $billing->date_end     = $billing_date;
                    $billing->is_paid      = Billing::PENDING;
                    $billing->is_prepared  = Billing::PREPARED;
                    $billing->is_reading   = Billing::PENDING;
                    $billing->status       = Billing::PREPARED;
                    $billing->save();

                    BillingDetails::create([
                        'billing_id'     => $billing->id,
                        'bill_no'        => $billing->billing_uid,
                        'transaction_id' => rand(10000, 99999) . '-' . $billing->billing_uid,
                        'debit'          => $billing->debit,
                        'credit'         => 0,
                        'change'         => 0,
                        'date_to'        => $billing->date_end,
                        'remarks'        => 'Bill prepared as of ' . Carbon::now()->toDateTimeString(),
                        'status'         => 0,
                        'is_paid'        => 0,
                    ]);

                    $preparedIds[] = $id;
                    $nextId++;
                }
            }

            if (! empty($preparedIds)) {

                event(new BillerEvent($date, $preparedIds));

                $response = [
                    'response' => 200,
                    'status'   => 'success',
                    'message'  => 'Bill(s) prepared successfully',
                ];
            } else {
                $response = [
                    'response' => 400,
                    'status'   => 'danger',
                    'message'  => 'Selected bill(s) were already prepared',
                ];
            }
        } else {
            $response = [
                'response' => 400,
                'status'   => 'danger',
                'message'  => 'No bills to prepare',
            ];
        }

        return back()->with($response);
    }

    public function checkBills(Request $request)
    {
        $company = Company::with(['proposals.billing'])
            ->whereHas('proposals.billing', function ($query) use ($request) {
                $query->where('date_end', 'like', "{$request->date}%")
                      ->orWhere(function ($q) use ($request) {
                          $q->whereNull('date_end')
                            ->where('date_start', 'like', "{$request->date}%");
                      })
                      ->where('is_prepared', Billing::PREPARED);
            })
            ->get();

        return response()->json($company);
    }

    public function period()
    {
        return view('biller.period.billing-period');
    }
}
