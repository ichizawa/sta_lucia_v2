<?php

namespace App\Http\Controllers\lease_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\admin\SendRegistrationUpdate;
use App\Models\AwardNotice;
use App\Models\DocumentsTable;
use App\Models\LeaseProposal;
use App\Models\SubCategory;
use App\Models\TenantDocuments;
use App\Models\User;
use App\Models\Company;
use App\Models\Owner;
use App\Models\Representative;
use App\Events\TenantUpdated;
use Illuminate\Support\Facades\Hash;
use App\Models\Categories;
use App\Models\BusinessType;

class LeaseTenantController extends Controller
{   
    public function leaseAdminTenants()
    {
        $owners = Owner::with(['companies', 'representatives'])->get();
        
        return view('lease-admin.tenants.tenants', [
            'owners' => $owners,
        ]);
    }
    
    public function leaseAddTenants (Request $request)
    {
        $categories = Categories::all();

        return view('lease-admin.tenants.add-tenants', [
            'categories' => $categories,
        ]);
    }

    public function getSubCategory(Request $request)
    {
        $subCategory = SubCategory::whereIn('category_id', $request->categoryID)->get();
        return response()->json($subCategory);
    }

    public function retrieveTenants()
    {
        $checkDocs = true;
        $owners = Owner::with(['companies', 'representatives'])->join('tenant_documents', 'tenant_documents.owner_id', '=', 'owner.id')
        ->select('owner.*', 'tenant_documents.status as doc_status')->get();
        return view('lease-admin.tenants.tenants', ['owners' => $owners]);
    }

    public function leaseSubmitTenants(Request $request)
    {
        $owner = new Owner();
        $owner->owner_fname = $request->ownerfname ? $request->ownerfname : null;
        $owner->owner_lname = $request->ownerlname ? $request->ownerlname : null;
        $owner->owner_position = $request->ownerposition ? $request->ownerposition : null;
        $owner->owner_address = $request->owneraddress ? $request->owneraddress : null;
        $owner->owner_email = $request->owneremail ? $request->owneremail : null;
        $owner->owner_telephone = $request->ownertelephone ? $request->ownertelephone : null;
        $owner->owner_officehrs = $request->ownerofficehrs ? $request->ownerofficehrs : null;
        $owner->owner_afterofficehrs = $request->ownerafterofficehrs ? $request->ownerafterofficehrs : null;
        $owner->owner_mobile = $request->ownermobile ? $request->ownermobile : null;
        $owner->save();

        $company = new Company();
        $company->acc_id = 'STA-LUCIA-' . rand(10000000, 99999999);
        $company->owner_id = $owner->id;
        $company->tenant_type = $request->tenant_type;
        $company->company_name = $request->tenant_company;
        $company->store_name = $request->tenant_storename;
        $company->company_address = $request->companyaddress;
        $company->save();

        $category = $request->input('category', []);
        $sub_category = $request->input('sub_category', []);
        
        $data = [];
        foreach ($category as $catID) {
            foreach ($sub_category as $subID) {
                $data[] = [
                    'company_id' => $company->id,
                    'category_id' => $catID,
                    'sub_category_id' => $subID,
                    'created_at' => now(),
                    'updated_at' => now(),
            ];
            }
        }
        
        if (!empty($data)) {
            BusinessType::insert($data);
        } else {
            \Log::info('Error in sub category');
        }

        $representative = new Representative();
        $representative->owner_id = $owner->id;
        $representative->rep_fname = $request->repfname;
        $representative->rep_lname = $request->replname;
        $representative->rep_position = $request->rep_position;
        $representative->rep_address = $request->repaddress;
        $representative->rep_email = $request->repemail;
        $representative->rep_telephone = $request->reptelephone;
        $representative->rep_officehrs = $request->repofficehrs;
        $representative->rep_afterofficehrs = $request->repafterofficehrs;
        $representative->rep_mobile = $request->repmobile;
        $representative->status = 0;
        $representative->password = Hash::make($request->reppassword);
        $representative->save();

        $user = new User();
        $user->name = $request->repfname . ' ' . $request->replname;
        $user->email = $request->repemail;
        $user->type = 'tenant';
        $user->status = 0;
        $user->password = Hash::make($request->reppassword);
        $user->save();

        $dti_reg = $request->file('dti') ? $request->file('dti')->getClientOriginalName() : null;
        $valid_id1 = $request->file('valid_id1') ? $request->file('valid_id1')->getClientOriginalName() : null;
        $valid_id2 = $request->file('valid_id2') ? $request->file('valid_id2')->getClientOriginalName() : null;
        $sec_reg = $request->file('sec_reg') ? $request->file('sec_reg')->getClientOriginalName() : null;
        $valid_idSig1 = $request->file('valid_idSig1') ? $request->file('valid_idSig1')->getClientOriginalName() : null;
        $valid_idSig2 = $request->file('valid_idSig2') ? $request->file('valid_idSig2')->getClientOriginalName() : null;
        $bir_cor = $request->file('bir_cor') ? $request->file('bir_cor')->getClientOriginalName() : null;
        $comp_prof = $request->file('comp_prof') ? $request->file('comp_prof')->getClientOriginalName() : null;
        $menu_list = $request->file('menu_list') ? $request->file('menu_list')->getClientOriginalName() : null;
        $store_persp = $request->file('store_persp') ? $request->file('store_persp')->getClientOriginalName() : null;
        $franch_letter = $request->file('franch_letter') ? $request->file('franch_letter')->getClientOriginalName() : null;
        $car_letter = $request->file('car_letter') ? $request->file('car_letter')->getClientOriginalName() : null;
        $service_letter = $request->file('service_letter') ? $request->file('service_letter')->getClientOriginalName() : null;
        $realty_letter = $request->file('realty_letter') ? $request->file('realty_letter')->getClientOriginalName() : null;
        $hlurb = $request->file('hlurb') ? $request->file('hlurb')->getClientOriginalName() : null;

        $userDocuments = DocumentsTable::create([
            'dti_reg' => $dti_reg,
            'valid_id1' => $valid_id1,
            'valid_id2' => $valid_id2,
            'sec_reg' => $sec_reg,
            'valid_idSig1' => $valid_idSig1,
            'valid_idSig2' => $valid_idSig2,
            'bir_cor' => $bir_cor,
            'comp_prof' => $comp_prof,
            'menu_list' => $menu_list,
            'store_persp' => $store_persp,
            'franch_letter' => $franch_letter,
            'car_letter' => $car_letter,
            'service_letter' => $service_letter,
            'realty_letter' => $realty_letter,
            'hlurb' => $hlurb,
            'status' => 0,
        ]);

        $docu = TenantDocuments::create([
           'owner_id' => $owner->id,
           'document_id' => $userDocuments->id,
           'view' => 0,
           'status' => 0
        ]);

        $fileNames = [
            'dti',
            'valid_id1',
            'valid_id2',
            'sec_reg',
            'valid_idSig1',
            'valid_idSig2',
            'bir_cor',
            'comp_prof',
            'menu_list',
            'store_persp',
            'franch_letter',
            'car_letter',
            'service_letter',
            'realty_letter',
            'hlurb'
        ];

        $storedFiles = [];
        // $folderName = 'public/tenant_documents/';
        // if (!File::exists($folderName)) {
        //     File::makeDirectory($folderName, 0775, true, true);
        // }

        foreach ($fileNames as $fileName) {
            if ($request->hasFile($fileName)) {
                $originalName = $request->file($fileName)->getClientOriginalName();
                $request->file($fileName)->storeAs('public/tenant_documents/' . $request->tenant_company, $originalName);
                $storedFiles[$fileName] = $originalName;
            }
        }

        $allFilesAreNull = true;
        $files = [];
        if($request->tenant_type == 'Corporate'){
            $files = [
                'sec_reg' => $sec_reg,
                'valid_idSig1' => $valid_idSig1,
                'valid_idSig2' => $valid_idSig2,
                'bir_cor' => $bir_cor,
                'comp_prof' => $comp_prof,
                'menu_list' => $menu_list,
                'store_persp' => $store_persp,
                'franch_letter' => $franch_letter,
                'car_letter' => $car_letter,
                'service_letter' => $service_letter,
                'realty_letter' => $realty_letter,
                'hlurb' => $hlurb,
            ];
        }else{
            $files = [
                'dti_reg' => $dti_reg,
                'valid_id1' => $valid_id1,
                'valid_id2' => $valid_id2,
                'bir_cor' => $bir_cor,
                'comp_prof' => $comp_prof,
                'menu_list' => $menu_list,
                'store_persp' => $store_persp,
                'franch_letter' => $franch_letter,
                'car_letter' => $car_letter,
                'service_letter' => $service_letter,
                'realty_letter' => $realty_letter,
                'hlurb' => $hlurb,
            ];
        }
        
        $document_id = 0;
        foreach ($files as $file) {
            $document_id++;
            if ($file == null) {
                $allFilesAreNull = false;
                break;
            }
        }
        if ($allFilesAreNull) {
            TenantDocuments::where('document_id', $docu->id)->update([
                'status' => 1
            ]);
        }

        return response()->json(['success' => 'Tenant added successfully']);
    }

    public function leaseViewTenants(Request $request){
        $owners = TenantDocuments::with(['documents'])->where('owner_id', $request->owner_id)->get();
        return response()->json($owners);
    }

    public function deleteTenants(Request $request){
            $rep_email = Representative::where('id', $request->id)->value('rep_email');
    
            $tenant = Owner::find($request->id);
        
            if ($tenant) {
                if ($rep_email) {
                    $user = User::where('email', $rep_email)->first();
                    
                    if ($user) {
                        $user->delete();
                    }
                }
        
                // Delete the tenant
                $tenant->delete();
        
                return response()->json(['message' => 'Tenant and associated user successfully deleted']);
            } else {
                return response()->json(['message' => 'Tenant not found'], 404);
            }
        }

        public function leaseAddDocuments(Request $request){
        $ownerid = $request->input('tenant_doc_owner_id');
        $tenant_doc_id = $request->input('tenant_doc_id');
        $tenant_doc_id2 = $request->input('tenant_doc_id2');
        $ownerName = Company::where('owner_id', $ownerid)->pluck('company_name')->first();

        if ($request->hasFile('tenant_doc_file')) {
            $fileName = $request->file('tenant_doc_file')->getClientOriginalName();
            $file = $request->file('tenant_doc_file')->storeAs('public/tenant_documents/' . $ownerName, $fileName);
            
            $uploadDoc = DocumentsTable::where('id', $tenant_doc_id)->update([
                $tenant_doc_id2 => $fileName,
            ]);
            

            return response()->json(['status' => 'Document added successfully', 'filename' => $fileName, 'ownerName' => $ownerName]);
        } else {
            return response()->json([
                'status' => 'No file uploaded'
            ], 400);
        }
    }

    public function leaseApproveDocuments(Request $request){
        $proposalid = LeaseProposal::where('tenant_id', $request->ownerid)->pluck('id')->first();
        TenantDocuments::where('owner_id', $request->ownerid)->update([
            'status' => 1
        ]);
        DocumentsTable::where('id', $proposalid)->update([
            'status' => 1
        ]);
        if($proposalid){
            AwardNotice::where('proposal_id', $proposalid)->update([
                'status' => 2
            ]);
            return response()->json(['status' => 'Document approved successfully']);
        }else{
            return response()->json(['status' => 'No proposal found']);
        }
        
    }

    public function leaseDeleteTenants(Request $request){
        $docid = TenantDocuments::where('owner_id', $request->id)->pluck('document_id')->first();
        DocumentsTable::where('id', $docid)->delete();
        $rep_email = Representative::where('owner_id', $request->id)->pluck('rep_email')->first();
        Owner::where('id', $request->id)->delete();
        User::where('email', $rep_email)->delete();
        if($docid){
            return response()->json(['status' => 'Tenant deleted successfully']);
        }else{
            return response()->json(['status' => 'No tenant found']);
        }
    }

}
