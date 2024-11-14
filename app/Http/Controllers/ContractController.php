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
    public function adminRenewalContract(){
        $all = Contracts::join('award_notice', 'contracts.award_notice_id', '=', 'award_notice.id')
        ->join('proposal', 'award_notice.proposal_id', '=', 'proposal.id')
        ->join('company', 'proposal.tenant_id', '=', 'company.owner_id')
        ->select('company.company_name', 'company.company_address', 'proposal.total_rent', 'proposal.lease_term','contracts.id', 'proposal.commencement', 'proposal.end_contract')
        ->get();
        return view('admin.contracts.renew-contract', compact('all'));
    }

    public function adminViewContract(Request $request){
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
            'filedir' => asset('storage/tenant_documents/'. $company_name .'/contract/'.$pdfFileName),
            'contract'=> $contract
        ]);
    }

    public function adminTerminationContract()
    {
        return view('admin.contracts.termination-contract');
    }
}
