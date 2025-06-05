<?php

namespace App\Http\Controllers\lease_admin;

use App\Http\Controllers\Controller;
use App\Models\bill\Billing;
use App\Models\CommencementProposal;
use App\Events\LeaseAdminEvent;
use App\Models\LeaseProposal;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Events\CommencementEvent;
use App\Events\BillerEvent;
use File;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaseAdminController extends Controller
{
    public function index()
    {
        return view('lease-admin.dashboard');
    }

    public function commencement_index()
    {
        $proposal = LeaseProposal::with(['company', 'commencement_proposal'])->get();
        return view('lease-admin.commencement.commencement-table', compact('proposal'));
    }
    public function commencementData()
    {
        $all = LeaseProposal::with(['company', 'commencement_proposal'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                $dateCreated = Carbon::parse($item->created_at)
                    ->format('F d, Y');

                $commDate = null;
                if (
                    $item->commencement_proposal
                    && $item->commencement_proposal->commencement_date
                ) {
                    $commDate = Carbon::parse(
                        $item->commencement_proposal->commencement_date
                    )->format('F Y');
                }

                return [
                    'id' => $item->id,
                    'proposal_uid' => $item->proposal_uid,
                    'tenant_name' => $item->company->store_name,
                    'date_created' => $dateCreated,
                    'commencement_date' => $commDate,
                ];
            });

        return response()->json(['data' => $all]);
    }

    public function commencementUpdate(Request $request)
    {
        $raw = $request->input('prop_num');
        $propidArray = is_array($raw) ? $raw : [$raw];
        $newCommDate = $request->input('comm_date');
        $anyChanged = false;

        foreach ($propidArray as $prop) {

            CommencementProposal::updateOrCreate(
                ['proposal_id' => $prop],
                ['commencement_date' => $newCommDate]
            );
            $billing = Billing::where('proposal_id', $prop)->first();

            if ($billing) {
                $billing->date_start = $newCommDate;

                $billing->date_end = null;
                $billing->save();
            } else {

                Billing::create([
                    'proposal_id' => $prop,
                    'total_amount' => null,
                    'debit' => null,
                    'credit' => null,
                    'amount' => null,
                    'billing_uid' => null,
                    'date_start' => $newCommDate,
                    'date_end' => null,
                    'is_prepared' => 0,
                    'is_paid' => 0,
                    'is_reading' => 0,
                    'status' => 0,
                ]);
            }

            $pdf = Pdf::loadView('admin.components.commencement-letter')->setPaper('legal', 'portrait');
            $pdfFileName = 'commencement_' . $prop . '.pdf';
            $directoryPath = storage_path('app/public/lease-proposals/commencements/');
            if (!File::exists($directoryPath)) {
                File::makeDirectory($directoryPath, 0755, true, true);
            }
            $pdf->save($directoryPath . $pdfFileName);
            $proposal = LeaseProposal::with(['company', 'commencement_proposal'])
                ->find($prop);
            event(new CommencementEvent($proposal));
            event(new BillerEvent($newCommDate, [$prop]));
            $anyChanged = true;
        }

        if ($anyChanged) {
            return response()->json([
                'status' => 'success',
                'message' => 'Commencement date updated successfully.'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'No valid proposals to update.'
        ]);
    }
}
