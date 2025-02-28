<?php

namespace App\Http\Controllers\lease_admin;

use App\Http\Controllers\Controller;
use App\Models\bill\Billing;
use App\Models\CommencementProposal;
use App\Models\LeaseProposal;
use Barryvdh\DomPDF\Facade\Pdf;
use File;
use Illuminate\Http\Request;

class LeaseAdminController extends Controller
{
    public function index()
    {
        return view('lease-admin.dashboard');
    }

    public function commcenemnt_index()
    {
        $proposal = LeaseProposal::with(['company', 'commencement_proposal'])->get();
        return view('lease-admin.commencement.commencement-table', compact('proposal'));
    }

    public function commencementUpdate(Request $request)
    {
        $propid = $request->input('prop_num', []);
        $data = [];
        $status = true;

        foreach ($propid as $prop) {
            $billingExists = Billing::where('proposal_id', $prop)->exists();

            if (!$billingExists) {
                CommencementProposal::where('proposal_id', $prop)->update([
                    'commencement_date' => $request->comm_date
                ]);

                Billing::create([
                    'proposal_id' => $prop,
                    'total_amount' => null,
                    'debit' => null,
                    'credit' => null,
                    'amount' => null,
                    'billing_uid' => null,
                    'date_start' => $request->comm_date,
                    'date_end' => null,
                    'is_prepared' => 0,
                    'is_paid' => 0,
                    'is_reading' => 0,
                    'status' => 0
                ]);

                $pdf = PDF::loadview('admin.components.commencement-letter')->setPaper('legal', 'portrait');

                $dompdf = $pdf->getDomPDF();
                $canvas = $dompdf->getCanvas();

                $pdfFileName = 'commencement_' . $prop . '.pdf';
                $directoryPath = storage_path('app/public/lease-proposals/commencements/');

                if (!File::exists($directoryPath)) {
                    File::makeDirectory($directoryPath, 0755, true, true);
                }
                $pdf->save($directoryPath . $pdfFileName);

                $status = true;
            } else {
                $status = false;
            }
        }

        if ($status) {
            $data = [
                'status' => 'success',
                'message' => "Commencement date and billing created successfully."
            ];
        } else {
            $data = [
                'status' => 'error',
                'message' => "Billing already exists."
            ];
        }

        return response()->json($data);

    }
}
