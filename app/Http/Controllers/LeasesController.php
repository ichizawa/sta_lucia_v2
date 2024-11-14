<?php

namespace App\Http\Controllers;

use App\Models\ArchivedProposal;
use App\Models\AwardNotice;
use App\Models\CommencementProposal;
use App\Models\Company;
use App\Models\CounterProposal;
use App\Models\DocumentsTable;
use App\Models\LeasableInfoModel;
use App\Models\LeaseProposal;
use App\Models\Owner;
use App\Models\Representative;
use App\Models\Space;
use App\Models\SpaceMallCode;
use App\Models\SpacePaymentInformation;
use App\Models\TenantDocuments;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SpaceUtility;
use File;
use Illuminate\Http\Request;
use App\Models\BusinessType;
use App\Models\Charge;
use App\Models\UtilitiesModel;
use App\Models\ChargesSelected;
use App\Models\UtilitiesSelected;
use App\Models\SpaceSelected;
use App\Models\Amenities;
use App\Models\AmenitySelected;
use Storage;

class LeasesController extends Controller
{
    public function adminMallLeaseableInfo()
    {
        $space = Space::join('leasable_space', 'space.id', '=', 'leasable_space.space_id')
            ->leftJoin('representative', 'leasable_space.owner_id', '=', 'representative.owner_id')
            ->select('space.*', 'leasable_space.status', 'leasable_space.owner_id', 'representative.rep_fname', 'representative.rep_lname')
            ->orderBy('leasable_space.id', direction: 'desc')
            ->get();
        // dd($space); die();
        return view('admin.leases.leases-information', compact('space'));
    }
    public function adminLeases()
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

        return view('admin.leases.leases-proposal', compact('proposal'));
    }
    public function addLease()
    {
        $tenants = Owner::join('company', 'owner.id', '=', 'company.owner_id')
            ->join('representative', 'owner.id', '=', 'representative.owner_id')
            ->get();

        $space = Space::join('leasable_space', 'space.id', '=', 'leasable_space.space_id')->where('leasable_space.status', '0')->get();
        $charges = Charge::all();
        $utilities = UtilitiesModel::all();

        return view('admin.leases.add-proposal', compact('tenants', 'space', 'charges', 'utilities'));
    }
    public function getChargesUtilities(Request $request)
    {
        $utilities = SpaceUtility::select()->where('space_id', $request->space_id)->get();
        $charges = SpacePaymentInformation::select()->where('space_id', $request->space_id)->get();

        $datas = [
            'utilities' => $utilities,
            'charges' => $charges
        ];
        return response()->json($datas);
    }

    public function adminSubmitLeaseProposal(Request $request, $option)
    {
        $data = [];
        if ($option == 'proposal') {
            $this->newProposal($request);
            // dd($request->all()); die();
            $data = [
                'status' => 'success',
                'message' => 'Lease proposal added successfully'
            ];
            return redirect()->route('leases.leases.proposal')->with('success', 'Lease proposal added successfully');
        } else {
            $this->counterProposal($request);
            $data = [
                'status' => 'success',
                'message' => 'Counter Lease proposal added successfully'
            ];
            return redirect()->route('leases.leases.proposal')->with('success', 'Counter Lease proposal added successfully');
        }

    }

    public function newProposal(Request $request)
    {
        // $data = [
        //     'tenant_id' => $request->companyprop,
        //     'proposal_uid' => rand(100000, 999999),
        //     'bussiness_nature' => $request->businessnature,
        //     'brent' => (float) str_replace(',', '', $request->brent),
        //     'total_rent' => (float) str_replace(',', '', $request->total_rent),
        //     'discount' => $request->paymentdisc ?? 0,
        //     'min_mgr' => (float) str_replace(',', '', $request->minmgr ?? 0),
        //     'lease_term' => $request->termlease,
        //     'commencement' => $request->commencementmonth,
        //     'end_contract' => $request->leaseendmonth,
        //     'const_period' => $request->constperiod,
        //     'rent_deposit' => $request->advrent ?? 0,
        //     'sec_dep' => $request->secrent ?? 0,
        //     'escalation_rate' => $request->escrent,
        //     'status' => 0
        // ];

        $data = [
            'tenant_id' => $request->companyprop,
            'proposal_uid' => rand(100000, 999999),
            'bussiness_nature' => $request->businessnature,
            'brent' => $request->brent,
            'discount' => $request->paymentdisc ?? 0,
            'total_rent' => $request->total_basic_rent,
            'total_mgr' => $request->total_guaranteed_rent,
            'min_mgr' => $request->minmgr,
            'lease_term' => $request->termlease,
            'commencement' => $request->commencementmonth,
            'end_contract' => $request->leaseendmonth,
            'const_period' => $request->constperiod,
            'rent_deposit' => $request->advrent,
            'sec_dep' => $request->secrent,
            'escalation_rate' => $request->escrent,
            'status' => 0
        ];
        $lease_prop = LeaseProposal::create($data);
        $spaceSelected = $request->input('spaceprop', []);
        LeasableInfoModel::whereIn('space_id', $spaceSelected)->update([
            'owner_id' => $request->companyprop,
            'proposal_id' => $lease_prop->id,
            'status' => 1
        ]);

        $charges = $request->input('chargeid', []);
        $dataCharges = [];
        foreach ($charges as $charge_id) {
            $dataCharges[] = [
                'lease_id' => $lease_prop->id,
                'charge_id' => $charge_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        ChargesSelected::insert($dataCharges);

        $utilities = $request->input('utilityid', []);
        $dataUtility = [];
        foreach ($utilities as $utility_id) {
            $dataUtility[] = [
                'lease_id' => $lease_prop->id,
                'utility_id' => $utility_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        UtilitiesSelected::insert($dataUtility);

        $tenantDocs = TenantDocuments::where('owner_id', $request->companyprop)->first();
        if($tenantDocs->status == 1){
            AwardNotice::create([
                'proposal_id' => $lease_prop->id,
                'status' => 2
            ]);
            $rep_email = Representative::where('owner_id', $request->companyprop)->pluck('rep_email')->first();
            User::where('email', $rep_email)->update([
                'status' => 2
            ]);
        }else{
            AwardNotice::create([
                'proposal_id' => $lease_prop->id,
                'status' => 0
            ]);
        }
        CommencementProposal::create([
            'proposal_id' => $lease_prop->id,
            'commencement_date' => $request->leaseendmonth
        ]);

        $this->newProposalPDF($lease_prop);
    }

    public function newProposalPDF($lease_prop){
        $proposals = LeaseProposal::join('company', 'proposal.tenant_id', '=', 'company.owner_id')
            ->join('representative', 'proposal.tenant_id', '=', 'representative.owner_id')
            ->join('owner', 'proposal.tenant_id', '=', 'owner.id')
            ->select(
                'proposal.*',
                'company.company_name',
                'company.company_address',
                'proposal.bussiness_nature',
                'representative.rep_fname',
                'representative.rep_lname',
                'representative.rep_position',
                'representative.rep_email',
                'owner.id as owner_id',
                'representative.rep_mobile'
            )
            ->where('proposal.id', $lease_prop->id)
            ->get();

        $space_proposals = LeasableInfoModel::join('space', 'leasable_space.space_id', '=', 'space.id')
            ->where('leasable_space.proposal_id', $lease_prop->id)
            ->get();

        $getUtilities = UtilitiesSelected::join('utilities', 'utilities_selected.utility_id', '=', 'utilities.id')
            ->where('utilities_selected.lease_id', $lease_prop->id)
            ->get();

        $getCharges = ChargesSelected::join('charges', 'extra_charges_selected.charge_id', '=', 'charges.id')
            ->where('extra_charges_selected.lease_id', $lease_prop->id)
            ->get();

        $getAminities = Space::join('amenity_selected', 'space.id', '=', 'amenity_selected.space_id')
            ->leftJoin('amenities', 'amenity_selected.amenity_id', '=', 'amenities.id')
            ->leftJoin('leasable_space', 'space.id', '=', 'leasable_space.space_id')
            ->leftJoin('owner', 'owner.id', '=', 'leasable_space.owner_id')
            ->where('owner.id', $lease_prop->id)
            ->get();

        $pdf_size = array(0, 0, 349, 573);
        $pdf = PDF::loadview('admin.components.proposal-template', compact('proposals', 'space_proposals', 'getUtilities', 'getCharges', 'getAminities'))->setPaper('legal', 'portrait');

        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();

        $pdfFileName = 'proposal_' . $lease_prop->id . '.pdf';
        $directoryPath = storage_path('app/public/lease-proposals/');

        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true, true);
        }
        $pdf->save($directoryPath . $pdfFileName);
        
        return $pdfFileName;
    }

    public function counterProposal(Request $request)
    {
        // $data = [
        //     'proposal_id' => $request->proposal_id,
        //     'proposal_uid' => rand(100000, 999999),
        //     'bussiness_nature' => $request->businessnature,
        //     'brent' => (float) str_replace(',', '', $request->brent),
        //     'total_rent' => (float) str_replace(',', '', $request->total_rent),
        //     'discount' => $request->paymentdisc ?? 0,
        //     'min_mgr' => (float) str_replace(',', '', $request->minmgr ?? 0),
        //     'lease_term' => $request->termlease,
        //     'commencement' => $request->commencementmonth,
        //     'end_contract' => $request->leaseendmonth,
        //     'const_period' => $request->constperiod,
        //     'rent_deposit' => $request->advrent ?? 0,
        //     'sec_dep' => $request->secrent ?? 0,
        //     'escalation_rate' => $request->escrent,
        //     'status' => 0
        // ];

        $data = [
            'tenant_id' => $request->companyprop,
            'proposal_uid' => rand(10000000, 99999999),
            'bussiness_nature' => $request->businessnature,
            'brent' => $request->brent,
            'discount' => $request->paymentdisc,
            'total_rent' => $request->total_basic_rent,
            'total_mgr' => $request->total_guaranteed_rent,
            'min_mgr' => $request->minmgr,
            'lease_term' => $request->termlease,
            'commencement' => $request->commencementmonth,
            'end_contract' => $request->leaseendmonth,
            'const_period' => $request->constperiod,
            'rent_deposit' => $request->advrent,
            'sec_dep' => $request->secrent,
            'escalation_rate' => $request->escrent,
            'status' => 0
        ];

        $counter_leases = CounterProposal::create($data);

        $counter_proposal = CounterProposal::where('counter_proposals.id', $counter_leases->id)
            ->join('proposal', 'counter_proposals.proposal_id', '=', 'proposal.id')
            ->join('company', 'proposal.tenant_id', '=', 'company.owner_id')
            ->join('representative', 'proposal.tenant_id', '=', 'representative.owner_id')
            ->join('owner', 'proposal.tenant_id', '=', 'owner.id')
            ->select(
                'counter_proposals.*',
                'company.company_name',
                'company.company_address',
                'counter_proposals.bussiness_nature',
                'representative.rep_fname',
                'representative.rep_lname',
                'representative.rep_position',
                'owner.owner_mobile',
                'owner_email',
                'owner.id as owner_id',
            )
            ->get();

        foreach ($counter_proposal as $counter_proposals) {
            $space_proposals = LeasableInfoModel::join('space', 'leasable_space.space_id', '=', 'space.id')
                ->where('leasable_space.proposal_id', $counter_proposals->proposal_id)
                ->get();

            $getUtilities = UtilitiesSelected::join('utilities', 'utilities_selected.utility_id', '=', 'utilities.id')
                ->where('utilities_selected.lease_id', $counter_proposals->proposal_id)
                ->get();

            $getCharges = ChargesSelected::join('charges', 'extra_charges_selected.charge_id', '=', 'charges.id')
                ->where('extra_charges_selected.lease_id', $counter_proposals->proposal_id)
                ->get();

            $getAminities = Space::join('amenity_selected', 'space.id', '=', 'amenity_selected.space_id')
                ->leftJoin('amenities', 'amenity_selected.amenity_id', '=', 'amenities.id')
                ->leftJoin('leasable_space', 'space.id', '=', 'leasable_space.space_id')
                ->leftJoin('owner', 'owner.id', '=', 'leasable_space.owner_id')
                ->where('owner.id', $counter_proposals->owner_id)
                ->get();
        }

        $pdf_size = array(0, 0, 349, 573);
        $pdf = PDF::loadview('admin.components.counter-proposal-template', compact('counter_proposal', 'space_proposals', 'getUtilities', 'getCharges', 'getAminities'))->setPaper('legal', 'portrait');

        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();

        $pdfFileName = 'counter_proposal_' . $counter_leases->id . '.pdf';
        $directoryPath = storage_path('app/public/counter-lease-proposals/');

        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true, true);
        }
        $pdf->save($directoryPath . $pdfFileName);
    }

    public function showProposal(Request $request)
    {
        $proposals = LeaseProposal::join('company', 'proposal.tenant_id', '=', 'company.owner_id')
            ->join('representative', 'proposal.tenant_id', '=', 'representative.owner_id')
            ->join('owner', 'proposal.tenant_id', '=', 'owner.id')
            ->select(
                'proposal.*',
                'company.company_name',
                'company.company_address',
                'proposal.bussiness_nature',
                'representative.rep_fname',
                'representative.rep_lname',
                'representative.rep_position',
                'owner.owner_mobile',
                'owner.id as owner_id',
                'owner_email'
            )
            ->where('proposal.id', $request->proposal_id)
            ->get();

        $space_proposals = LeasableInfoModel::join('space', 'leasable_space.space_id', '=', 'space.id')
            ->where('leasable_space.proposal_id', $request->proposal_id)
            ->get();

        $getUtilities = UtilitiesSelected::join('utilities', 'utilities_selected.utility_id', '=', 'utilities.id')
            ->where('utilities_selected.lease_id', $request->proposal_id)
            ->get();

        $getCharges = ChargesSelected::join('charges', 'extra_charges_selected.charge_id', '=', 'charges.id')
            ->where('extra_charges_selected.lease_id', $request->proposal_id)
            ->get();

        // $proposal = LeaseProposal::find($request->proposal_id);
        // $pdfFileName = $this->newProposalPDF($proposal);
        $pdfFileName = 'proposal_' . $request->proposal_id . '.pdf';
        
        $documentStatus = [];
        foreach($proposals as $props){
            $documentStatus = TenantDocuments::where('owner_id', $props->owner_id)->first();
        }

        $proposals->map(function ($proposal) use ($space_proposals) {
            $matching_space_proposals = $space_proposals->filter(function ($space) use ($proposal) {
                return $space->owner_id == $proposal->tenant_id;
            });
            $proposal->space_selected = $matching_space_proposals;

            return $proposal;
        });

        $counterProposals = CounterProposal::where('proposal_id', $request->proposal_id)->get();

        return response()->json([
            'pdf_url' => asset('storage/lease-proposals/' . $pdfFileName),
            'data' => $proposals,
            'utilities' => $getUtilities,
            'charges' => $getCharges,
            'counter_proposals' => $counterProposals,
            'document_status' => $documentStatus
        ]);
    }

    public function showCounterProposal(Request $request)
    {
        $pdfFileName = 'counter_proposal_' . $request->counter_proposal_id . '.pdf';
        $cprop = CounterProposal::where('id', $request->counter_proposal_id)->first();
        $prop = LeaseProposal::where('id', $cprop->proposal_id)->first();

        return response()->json([
            'pdf_url' => asset('storage/counter-lease-proposals/' . $pdfFileName),
            'data' => $cprop,
            'prop' => $prop
        ]);
    }

    public function adminGetBusinessInfo(Request $request)
    {
        $business_type = BusinessType::where('company_id', $request->company_id)
            ->join('categories', 'business_type.category_id', '=', 'categories.id')
            ->join('sub_category', 'business_type.sub_category_id', '=', 'sub_category.id')
            ->select('categories.name', 'sub_category.name as sub_name')
            ->get();
        return response()->json($business_type);
    }

    public function adminOptionsProposal(Request $request, $set)
    {
        $data = [];
        if ($set == "new") {
            $proposals = LeaseProposal::where('id', $request->proposal_id)->update([
                'status' => $request->option
            ]);

            if ($proposals) {
                $tenant_id = LeaseProposal::where('id', $request->proposal_id)->pluck('tenant_id')->first();
                $rep = Representative::where('owner_id', $tenant_id)->pluck('rep_email')->first();
                $company_name = Company::where('owner_id', $tenant_id)->pluck('company_name')->first();
                
                $directoryPath = "public/tenant_documents/{$company_name}/award_notice";
                $pdfFileName = "award_notice_{$request->proposal_id}.pdf";

                if (!Storage::exists($directoryPath)) {
                    Storage::makeDirectory($directoryPath, 0755, true);
                }

                $award = LeaseProposal::join('leasable_space', 'proposal.id', '=', 'leasable_space.proposal_id')
                    ->join('space', 'leasable_space.space_id', '=', 'space.id')
                    ->join('award_notice', 'proposal.id', '=', 'award_notice.proposal_id')
                    ->join('company', 'proposal.tenant_id', '=', 'company.owner_id')
                    ->join('owner', 'proposal.tenant_id', '=', 'owner.id')
                    ->where('proposal.id', $request->proposal_id)
                    ->get();

                $charges = ChargesSelected::join('charges', 'extra_charges_selected.charge_id', '=', 'charges.id')
                    ->where('extra_charges_selected.lease_id', $request->proposal_id)
                    ->get();

                $pdf = PDF::loadView('admin.components.award-notice-template', compact('award', 'charges'))->setPaper('legal', 'portrait');
                $dompdf = $pdf->getDomPDF();
                $canvas = $dompdf->getCanvas();
                $pdf->save(storage_path("app/{$directoryPath}/{$pdfFileName}"));

                $data = [
                    'status' => "success",
                    'message' => "Proposal has been approved successfully"
                ];
            } else {
                $data = [
                    'status' => "danger",
                    'message' => "Something went wrong"
                ];
            }

        } else {
            CounterProposal::where('id', $request->proposal_id)->update([
                'status' => $request->option
            ]);
            $proposal_id = CounterProposal::where('id', $request->proposal_id)->pluck('proposal_id')->first();
            $tenant_id = LeaseProposal::where('id', $proposal_id)->pluck('tenant_id')->first();

            if ($tenant_id) {
                $insert = CounterProposal::where('id', $request->proposal_id)->first();
                $main_proposal = LeaseProposal::where('id', $proposal_id)->first();
                $pushtoarchived = ArchivedProposal::create($main_proposal->toArray());

                if ($pushtoarchived) {
                    LeaseProposal::where('id', $proposal_id)->update([
                        'tenant_id' => $tenant_id,
                        'proposal_uid' => $insert->proposal_uid,
                        'bussiness_nature' => $insert->bussiness_nature,
                        'discount' => $insert->discount,
                        'brent' => $insert->brent,
                        'total_rent' => $insert->total_rent,
                        'min_mgr' => $insert->min_mgr,
                        'lease_term' => $insert->lease_term,
                        'commencement' => $insert->commencement,
                        'end_contract' => $insert->end_contract,
                        'const_period' => $insert->const_period,
                        'rent_deposit' => $insert->rent_deposit,
                        'sec_dep' => $insert->sec_dep,
                        'escalation_rate' => $insert->escalation_rate,
                        'status' => 0
                    ]);
                    
                    $lease_prop = LeaseProposal::where('id', $proposal_id)->first();
                    $this->newProposalPDF($lease_prop);
                }

                $data = [
                    'status' => "success",
                    'message' => "Counter Proposal has been approved successfully"
                ];
            } else {
                $data = [
                    'status' => "danger",
                    'message' => "Something went wrong"
                ];
            }
        }

        return response()->json($data);
    }
}