<?php

namespace App\Http\Controllers;

use App\Models\bill\Billing;
use App\Models\CommencementProposal;
use App\Events\BillerEvent;
use App\Models\LeaseProposal;
use App\Events\CommencementEvent;
use Barryvdh\DomPDF\Facade\Pdf;
use File;
use Illuminate\Http\Request;

class CommencementController extends Controller
{
    // public function index()
    // {
    //     $proposal = LeaseProposal::with(['company', 'commencement_proposal'])->get();
    //     return view('admin.commencement.commencement-table', compact('proposal'));
    // }
   public function index(Request $request)
{
    $all = LeaseProposal::with(['company', 'commencement_proposal'])
        ->orderBy('proposal_uid', 'asc')
        ->get();

    if ($request->ajax() || $request->wantsJson()) {
        $rows = $all->map(function ($p) {
            return [
                'id'               => $p->id,
                'proposal_uid'     => $p->proposal_uid,
                'tenant_name'      => $p->company->store_name,
                'created_at'       => $p->created_at->format('F d, Y'),
                'commencement_date'=> $p->commencement_proposal
                                       && $p->commencement_proposal->commencement_date
                                        ? $p->commencement_proposal->commencement_date->format('F Y')
                                        : null,
            ];
        });

        return response()->json($rows);
    }


    return view('lease-admin.commencement.commencement-table', [
        'proposal' => $all
    ]);
}


    public function commencementUpdate(Request $request)
    {
         $raw = $request->input('prop_num');
    $propidArray = is_array($raw) ? $raw : [ $raw ];

    $status = true;

    foreach ($propidArray as $prop) {
            $billingExists = Billing::where('proposal_id', $prop)->exists();
            if (! $billingExists) {

                CommencementProposal::updateOrCreate(
                    ['proposal_id'       => $prop],
                    ['commencement_date' => $request->comm_date]
                );


                $newBilling = Billing::create([
                    'proposal_id'   => $prop,
                    'total_amount'  => null,
                    'debit'         => null,
                    'credit'        => null,
                    'amount'        => null,
                    'billing_uid'   => null,
                    'date_start'    => $request->comm_date,
                    'date_end'      => null,
                    'is_prepared'   => 0,
                    'is_paid'       => 0,
                    'is_reading'    => 0,
                    'status'        => 0
                ]);


                $pdf = Pdf::loadView('admin.components.commencement-letter')->setPaper('legal', 'portrait');
                $pdfFileName    = 'commencement_' . $prop . '.pdf';
                $directoryPath  = storage_path('app/public/lease-proposals/commencements/');
                if (! File::exists($directoryPath)) {
                    File::makeDirectory($directoryPath, 0755, true, true);
                }
                $pdf->save($directoryPath . $pdfFileName);

                $proposal = LeaseProposal::with(['company', 'commencement_proposal'])
                              ->find($prop);
                event(new CommencementEvent($proposal));

                event(new BillerEvent(  $request->comm_date,  [$prop]  ));

                $status = true;
            } else {
                $status = false;
            }
        }

        if ($status) {
            $data = [
                'status'  => 'success',
                'message' => "Commencement date and billing created successfully."
            ];
        } else {
            $data = [
                'status'  => 'error',
                'message' => "Billing already exists."
            ];
        }

        return response()->json($data);
    }

}
