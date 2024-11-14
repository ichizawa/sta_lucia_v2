<?php

namespace App\Http\Controllers;

use App\Models\AwardNotice;
use App\Models\AwardNoticeFiles;
use App\Models\ChargesSelected;
use App\Models\Company;
use App\Models\Contracts;
use App\Models\LeaseProposal;
use App\Models\Representative;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Storage;

class VacateNoticesController extends Controller
{
    public function adminAwardNotices(Request $request, $option)
    {
        if($option == 'upload'){
            return $this->adminFilesUpload($request);
        }

        if($option == 'view'){
            $notices = AwardNotice::join('proposal', 'award_notice.proposal_id', '=', 'proposal.id')
                ->join('company', 'proposal.tenant_id', '=', 'company.owner_id')
                ->select(
                    'award_notice.id as award_notice_id',
                    'award_notice.status as award_notice_status',
                    'award_notice.created_at as award_notice_created_at',
                    'proposal.*',
                    'company.tenant_type',
                    'company.company_name',
                    'company.owner_id as company_owner_id'
                )
                ->get();

            // foreach ($notices as $notice) {
            //     $directoryPath = "public/tenant_documents/{$notice->company_name}/award_notice";
            //     $pdfFileName = "award_notice_{$notice->award_notice_id}.pdf";

            //     if (!Storage::exists($directoryPath)) {
            //         Storage::makeDirectory($directoryPath, 0755, true);
            //     }

            //     $award = LeaseProposal::join('leasable_space', 'proposal.id', '=', 'leasable_space.proposal_id')
            //         ->join('space', 'leasable_space.space_id', '=', 'space.id')
            //         ->join('award_notice', 'proposal.id', '=', 'award_notice.proposal_id')
            //         ->join('company', 'proposal.tenant_id', '=', 'company.owner_id')
            //         ->join('owner', 'proposal.tenant_id', '=', 'owner.id')
            //         ->where('proposal.id', $notice->id)
            //         ->get();

            //     $charges = ChargesSelected::join('charges', 'extra_charges_selected.charge_id', '=', 'charges.id')
            //     ->where('extra_charges_selected.lease_id', $notice->id)
            //     ->get();

            //     $pdf = PDF::loadView('admin.components.award-notice-template', compact('award', 'charges'))->setPaper('legal', 'portrait');
            //     $dompdf = $pdf->getDomPDF();
            //     $canvas = $dompdf->getCanvas();
            //     $pdf->save(storage_path("app/{$directoryPath}/{$pdfFileName}"));
            // }

            return view('admin.notices.award-notice', compact('notices'));
        }

        if($option == 'get'){
            $awardNoticeFiles = AwardNoticeFiles::join('company', 'award_notice_files.owner_id', '=', 'company.owner_id')
            ->select('award_notice_files.*', 'company.company_name')
            ->where('award_notice_id', $request->noticeid)
            ->get();

            return response()->json([
                'data' => $awardNoticeFiles
            ]);
        }

        if($option == 'check'){
            $check = AwardNoticeFiles::where('award_notice_id', $request->noticeid)->first();
        }

    }
    public function adminFilesUpload(Request $request){
        $anf = AwardNoticeFiles::create([
            'award_notice_id' => $request->award_notice_id,
            'owner_id' => $request->owner_id,
            'file_name' => $request->file_name ? $request->file_name : null,
            'file_path' => $request->file_path ? $request->file('file_path')->getClientOriginalName() : null,
            'status' => 0
        ]);
        $boolean = false;
        if($anf){
            $ownerName = Company::where('owner_id', $request->owner_id)->pluck('company_name')->first();
            if ($request->hasFile('file_path')) {
                $fileName = $request->file('file_path')->getClientOriginalName();

                $directorypath = "public/tenant_documents/{$ownerName}/award_notice/approval_files";
                if(!Storage::exists($directorypath)){
                    Storage::makeDirectory($directorypath, 0755, true);
                }
                $request->file('file_path')->storeAs('public/tenant_documents/' . $ownerName . '/award_notice/approval_files/', $fileName);
                $boolean = true;
                return redirect()->back()->with('status', $boolean);
            }
        }else{
            $boolean = false;
            return redirect()->back()->with('status', $boolean);
        }
    }
    public function adminVacateNotices()
    {
        return view('admin.notices.vacate_notices');
    }

    public function adminNoticeOptions(Request $request){
        
        $contract_creation = AwardNotice::where('id', $request->award_notice_id)->update(['status' => $request->status_award]);
        $awardnotice = AwardNotice::where('id', $request->award_notice_id)->first();
        
        if($contract_creation){
            if($request->status_award == 1){
                $contracts = Contracts::create([
                    'award_notice_id' => $request->award_notice_id,
                    'status' => 1,
                ]);

                $tenant_id = LeaseProposal::where('id', $awardnotice->proposal_id)->pluck('tenant_id')->first();
                $tenant_email = Representative::where('owner_id', $tenant_id)->pluck('rep_email')->first();
                Representative::where('owner_id', $tenant_id)->update(['status' => 1]);
                User::where('email', $tenant_email)->update(['status' => 1]);

                $ownerName = Company::where('owner_id', $tenant_id)->pluck('company_name')->first();
                $directorypath = "public/tenant_documents/{$ownerName}/contract/";
                $pdfFileName = "contract_{$contracts->id}.pdf";

                if (!Storage::exists($directorypath)) {
                    Storage::makeDirectory($directorypath, 0755, true);
                }

                $pdf = PDF::loadView('admin.components.contract-template')->setPaper('legal', 'portrait');
                $dompdf = $pdf->getDomPDF();
                $canvas = $dompdf->getCanvas();
                $pdf->save(storage_path("app/{$directorypath}/{$pdfFileName}"));

            }
        }

        return back()->with([
            'notice' => $awardnotice,
            'modal_open' => true,
        ]);
    }
}
