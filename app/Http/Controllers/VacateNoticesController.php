<?php

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use App\Jobs\admin\AwardNoticeStatus;
use App\Models\AwardNotice;
use App\Models\AwardNoticeFiles;
use App\Models\ChargesSelected;
use App\Models\CommencementProposal;
use App\Models\Company;
use App\Models\Contracts;
use App\Models\LeaseProposal;
use App\Models\Representative;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Events\AwardNoticeEvent;
use Carbon\Carbon;
use App\Events\ContractRenewalEvent;
use Storage;

class VacateNoticesController extends Controller
{
    public function adminAwardNotices(Request $request, $option)
    {
        if ($option == 'upload') {
            return $this->adminFilesUpload($request);
        }

        if ($option == 'view') {
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

            return view('admin.notices.award-notice', compact('notices'));
        }

        if ($option == 'get') {
            $awardNoticeFiles = AwardNoticeFiles::join('company', 'award_notice_files.owner_id', '=', 'company.owner_id')
                ->select('award_notice_files.*', 'company.company_name')
                ->where('award_notice_id', $request->noticeid)
                ->get();

            return response()->json([
                'data' => $awardNoticeFiles
            ]);
        }

        if ($option == 'check') {
            $check = AwardNoticeFiles::where('award_notice_id', $request->noticeid)->first();
        }

    }
    public function adminFilesUpload(Request $request)
    {
        $anf = AwardNoticeFiles::create([
            'award_notice_id' => $request->award_notice_id,
            'owner_id' => $request->owner_id,
            'file_name' => $request->file_name ? $request->file_name : null,
            'file_path' => $request->file_path ? $request->file('file_path')->getClientOriginalName() : null,
            'status' => 0
        ]);
        $boolean = false;
        if ($anf) {
            $ownerName = Company::where('owner_id', $request->owner_id)->pluck('company_name')->first();
            if ($request->hasFile('file_path')) {
                $fileName = $request->file('file_path')->getClientOriginalName();

                $directorypath = "public/tenant_documents/{$ownerName}/award_notice/approval_files";
                if (!Storage::exists($directorypath)) {
                    Storage::makeDirectory($directorypath, 0755, true);
                }
                $request->file('file_path')->storeAs('public/tenant_documents/' . $ownerName . '/award_notice/approval_files/', $fileName);
                $boolean = true;
                return redirect()->back()->with('status', $boolean);
            }
        } else {
            $boolean = false;
            return redirect()->back()->with('status', $boolean);
        }
    }
    public function adminVacateNotices()
    {
        return view('admin.notices.vacate_notices');
    }

    // public function adminNoticeOptions(Request $request)
    // {

    //     $awardnotice = AwardNotice::with(['proposal', 'proposal.company', 'proposal.representative'])->find($request->award_notice_id);

    //      if (! $awardnotice) {
    //     return back()->withErrors([
    //         'award_notice_id' => 'Award notice not found.',
    //     ]);
    // }
    //     if ($request->status_award == 1) {
    //         $awardnotice->status = 1;
    //         $awardnotice->save();
    //             if (! $awardnotice) {
    //                 return back()->withErrors(['award_notice_id' => 'Award notice not found.']);
    //             }

    //         $contracts = Contracts::create([
    //             'award_notice_id' => $request->award_notice_id,
    //             'status' => 1,
    //         ]);

    //         CommencementProposal::create([
    //             'proposal_id' => $awardnotice->proposal_id,
    //             'commencement_date' => null,
    //         ]);

    //         User::where('email', $awardnotice->proposal->representative->rep_email)->update([
    //             'status' => 1
    //         ]);

    //         $directorypath = "public/tenant_documents/{$awardnotice->proposal->company->company_name}/contract/";
    //         $pdfFileName = "contract_{$contracts->id}.pdf";

    //         if (!Storage::exists($directorypath)) {
    //             Storage::makeDirectory($directorypath, 0755, true);
    //         }

    //         $pdf = PDF::loadView('admin.components.contract-template')->setPaper('legal', 'portrait');
    //         $dompdf = $pdf->getDomPDF();
    //         $canvas = $dompdf->getCanvas();
    //         $pdf->save(storage_path("app/{$directorypath}/{$pdfFileName}"));

    //         event(new AwardNoticeEvent($awardnotice));

    //     }
    //     return back()->with([
    //         'notice' => $awardnotice,
    //         'modal_open' => true,
    //     ]);
    // }
    public function adminNoticeOptions(Request $request)
{
    $awardnotice = AwardNotice::with([
        'proposal',
        'proposal.company',
        'proposal.representative'
    ])->find($request->award_notice_id);

    if (! $awardnotice) {
        return back()->withErrors([
            'award_notice_id' => 'Award notice not found.',
        ]);
    }

    if ($request->status_award == 1) {
        $awardnotice->status = 1;
        $awardnotice->save();

        $contracts = Contracts::create([
            'award_notice_id' => $awardnotice->id,
            'status'          => 1,
        ]);
        event(new ContractRenewalEvent($contracts));

        CommencementProposal::create([
            'proposal_id'       => $awardnotice->proposal_id,
            'commencement_date' => null,
        ]);

        User::where('email', $awardnotice->proposal->representative->rep_email)
            ->update(['status' => 1]);

        $directorypath = "public/tenant_documents/{$awardnotice->proposal->company->company_name}/contract/";
        $pdfFileName   = "contract_{$contracts->id}.pdf";

        if (! Storage::exists($directorypath)) {
            Storage::makeDirectory($directorypath, 0755, true);
        }

        $pdf = PDF::loadView('admin.components.contract-template')
                  ->setPaper('legal', 'portrait');
        $pdf->save(storage_path("app/{$directorypath}/{$pdfFileName}"));


        $awardnotice->load('proposal.company');
        event(new AwardNoticeEvent($awardnotice));

    }
    elseif ($request->status_award == 3) {
        $awardnotice->status = 3;
        $awardnotice->save();
        $awardnotice->load('proposal.company');
        event(new AwardNoticeEvent($awardnotice));
    }

    return back()->with([
        'notice'     => $awardnotice,
        'modal_open' => true,
    ]);
}


    public function getNoticesData()
{
$notices = AwardNotice::join('proposal', 'award_notice.proposal_id', '=', 'proposal.id')
    ->join('company', 'proposal.tenant_id', '=', 'company.owner_id')
    ->select([
        'award_notice.id as id',
        'company.company_name',
        'company.tenant_type',
        'award_notice.created_at as award_notice_created_at',
        'award_notice.status as award_notice_status',
    ])
    ->orderBy('award_notice.created_at', 'desc')
    ->get();

$result = $notices->map(function($row) {
    return [
        'id'                      => $row->id,
        'company_name'            => $row->company_name,
        'tenant_type'             => $row->tenant_type,
        'award_notice_created_at' => Carbon::parse($row->award_notice_created_at)
                                            ->format('F j, Y'),
        'award_notice_status'     => $row->award_notice_status,
    ];
});

return response()->json($result);


}



}
