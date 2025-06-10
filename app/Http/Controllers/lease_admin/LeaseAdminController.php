<?php

namespace App\Http\Controllers\lease_admin;

use App\Http\Controllers\Controller;
use App\Models\bill\Billing;
use App\Models\CommencementProposal;
use App\Models\LeaseProposal;
use Barryvdh\DomPDF\Facade\Pdf;
use File;
use Illuminate\Http\Request;
use App\Models\LeasableInfoModel;
use App\Models\Contracts;
use App\Models\AwardNotice;

class LeaseAdminController extends Controller
{
    public function index()
    {
        return view('lease-admin.dashboard');
    }

    public function leasesProposal()
    {
        $proposal = LeaseProposal::join('company', 'proposal.tenant_id', '=', 'company.owner_id')
            ->select('company.company_name', 'proposal.status', 'proposal.id', 'company.owner_id', 'proposal.tenant_id', 'company.tenant_type')
            ->orderBy('proposal.id', 'desc')
            ->get();
        $spaces_proposal = LeasableInfoModel::join('space', 'leasable_space.space_id', '=', 'space.id')
            ->select('leasable_space.owner_id', 'leasable_space.proposal_id', 'space.*')
            ->get();

        $proposal->map(function ($proposals) use ($spaces_proposal) {
            $matching_space_proposals = $spaces_proposal->filter(function ($space) use ($proposals) {
                return $space->proposal_id == $proposals->id;
            });
            $proposals->space_selected = $matching_space_proposals;

            return $proposals;
        });

        return view('lease-admin.leases.leases-proposal', compact('proposal'));
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

    public function renewalContract()
    {
        $all = Contracts::join('award_notice', 'contracts.award_notice_id', '=', 'award_notice.id')
            ->join('proposal', 'award_notice.proposal_id', '=', 'proposal.id')
            ->join('company', 'proposal.tenant_id', '=', 'company.owner_id')
            ->select('company.company_name', 'company.company_address', 'proposal.total_rent', 'proposal.lease_term', 'contracts.id', 'proposal.commencement', 'proposal.end_contract')
            ->get();
        return view('lease-admin.contracts.renew-contract', compact('all'));
    }

    public function terminationContract()
    {
        return view('lease-admin.contracts.termination-contract');
    }

    public function awardNotices(Request $request, $option)
    {
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

            return view('lease-admin.notices.award-notice', compact('notices'));
        }
    }
}
