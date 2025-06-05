<?php

namespace App\Http\Controllers;

use App\Models\AwardNotice;
use App\Models\Company;
use App\Models\Contracts;
use App\Models\LeaseProposal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Storage;

class ContractController extends Controller
{
     public function adminRenewalContract(Request $request)
    {
        // Common query: join contracts → award_notice → proposal → company
        $allContracts = Contracts::join('award_notice', 'contracts.award_notice_id', '=', 'award_notice.id')
            ->join('proposal',       'award_notice.proposal_id',   '=', 'proposal.id')
            ->join('company',        'proposal.tenant_id',         '=', 'company.owner_id')
            ->select(
                'contracts.id as contract_id',
                'company.company_name',
                'proposal.total_rent',
                'proposal.lease_term',
                'proposal.commencement',
                'proposal.end_contract'
            )
            ->orderBy('contracts.id', 'desc')
            ->get();

        // If this is an AJAX request, return JSON instead of rendering the view:
        if ($request->ajax() || $request->wantsJson()) {
            // Map each contract row into exactly the fields needed by the DataTable
            $rows = $allContracts->map(function ($c) {
                return [
                    'contract_id'     => $c->contract_id,
                    'company_name'    => $c->company_name,
                    'renewal_term'    => $c->lease_term,
                    // Format “Monthly Rent” with two decimal places and a “P ” prefix:
                    'monthly_rent'    => 'P ' . number_format($c->total_rent, 2),
                    // Format “Due Date” as “F, Y” (e.g. “June, 2025”)
                    'due_date'        => date('F, Y', strtotime($c->end_contract)),
                    // Format “Date of Agreement” as “F, Y”
                    'agreement_date'  => date('F, Y', strtotime($c->commencement)),
                ];
            });

            return response()->json($rows);
        }

        // Otherwise (non‐AJAX), render the Blade view so that a normal page load still works:
        return view('admin.contracts.renew-contract');
    }
    // Orig
    // public function adminRenewalContract()
    // {
    //     $all = Contracts::join('award_notice', 'contracts.award_notice_id', '=', 'award_notice.id')
    //         ->join('proposal', 'award_notice.proposal_id', '=', 'proposal.id')
    //         ->join('company', 'proposal.tenant_id', '=', 'company.owner_id')
    //         ->select('company.company_name', 'company.company_address', 'proposal.total_rent', 'proposal.lease_term', 'contracts.id', 'proposal.commencement', 'proposal.end_contract')
    //         ->get();
    //     return view('admin.contracts.renew-contract', compact('all'));
    // }

    public function adminViewContract(Request $request)
    {
        $contract = Contracts::where('id', $request->id)->first();
        $proposal_id = AwardNotice::where('id', $contract->id)->pluck('proposal_id')->first();
        $company_id = LeaseProposal::where('id', $proposal_id)->pluck('tenant_id')->first();
        $company_name = Company::where('owner_id', $company_id)->pluck('company_name')->first();

        $directorypath = "public/tenant_documents/{$company_name}/contract/";
        $pdfFileName = "contract_{$request->id}.pdf";

        if (!Storage::exists($directorypath)) {
            Storage::makeDirectory($directorypath, 0755, true);
        }

        // $pdf = PDF::loadView('admin.components.contract-template')->setPaper('legal', 'portrait');
        // $dompdf = $pdf->getDomPDF();
        // $canvas = $dompdf->getCanvas();
        // $pdf->save(storage_path("app/{$directorypath}/{$pdfFileName}"));
        return response()->json([
            'filedir' => asset('storage/tenant_documents/' . $company_name . '/contract/' . $pdfFileName),
            'contract' => $contract
        ]);
    }

    public function adminTerminationContract()
    {
        return view('admin.contracts.termination-contract');
    }

    // public function downloadVacateNoticePDF()
    // {
    //     $pdf = Pdf::loadView('admin.components.vacate-template')->setPaper('legal', 'portrait');
    //     return $pdf->download('Vacate_Notice.pdf');
    // }

}
