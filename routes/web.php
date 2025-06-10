<?php
use App\Http\Controllers\biller\ActivitiesController;
use App\Http\Controllers\biller\BillController;
use \App\Http\Controllers\biller\InvoicesController;
use App\Http\Controllers\biller\CashierController;
use App\Http\Controllers\client\ClientAuthorizedPersonelController;
use App\Http\Controllers\client\ClientAwardNoticeController;
use App\Http\Controllers\client\ClientBillingController;
use App\Http\Controllers\client\ClientContractController;
use App\Http\Controllers\client\ClientDocumentsController;
use App\Http\Controllers\client\ClientLedgerController;
use App\Http\Controllers\client\ClientProposal;
use App\Http\Controllers\client\ClientProposalController;
use App\Http\Controllers\client\ClientSpaceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\collect\CollectionController;
use App\Http\Controllers\collect\CollectionLedgerController;
use App\Http\Controllers\CommencementController;
use App\Http\Controllers\lease_admin\IssuePermitscontroller;
use App\Http\Controllers\lease_admin\LeaseAdminController;
use App\Http\Controllers\LeasesController;
use App\Http\Controllers\operation\ConstructionController;
use App\Http\Controllers\operation\OperationContractController;
use App\Http\Controllers\operation\OperationController;
use App\Http\Controllers\operation\OperationNoticesController;
use App\Http\Controllers\operation\PreConstructionController;
use App\Http\Controllers\operation\UtilityReadingController;
use App\Http\Controllers\operation\WorkPermitController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\reading\ReadingController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorizedPersonnel;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\TenantsController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\VacateNoticesController;

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth', [AuthController::class, 'login'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/service-worker.js', function () {
//     return response()->file(
//         public_path('service-worker.js'),
//         ['Content-Type' => 'application/javascript']
//     );
// });

Route::group(['middleware' => ['auth', 'authCheck']], function () {


    // admin

    Route::prefix('admin')->middleware('role.check:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'adminIndex'])->name('admin.dashboard');
        Route::post('/delete-space', [SpaceController::class, 'adminDelete'])->name('space.delete.space');

        Route::get('/space', [SpaceController::class, 'adminSpace'])->name('admin.space');
        Route::prefix('space')->group(function () {
            Route::get('/add-space', [SpaceController::class, 'adminAddSpace'])->name('space.add.space');
            Route::post('/submit-space', [SpaceController::class, 'submitSpace'])->name('space.submit.space');
            Route::get('/view-space-modal', [SpaceController::class, 'adminViewSpace'])->name('space.view.space');
            Route::post('/delete-space', [SpaceController::class, 'adminDelete'])->name('space.delete.space');

            Route::get('/data', [SpaceController::class, 'getSpaceData'])->name('space.data');

            Route::get('/mall-option/{setup}', [SpaceController::class, 'adminOptionSpace'])->name('space.edit.mall');
            Route::get('/building-option/{setup}', [SpaceController::class, 'adminOptionSpace'])->name('space.edit.building');
            Route::get('/level-option/{setup}', [SpaceController::class, 'adminOptionSpace'])->name('space.edit.level');

            Route::post('/mall-delete/{setup}', [SpaceController::class, 'adminSpaceCodes'])->name('space.delete.mall');
            Route::post('/building-delete/{setup}', [SpaceController::class, 'adminSpaceCodes'])->name('space.delete.building');
            Route::post('/level-delete/{setup}', [SpaceController::class, 'adminSpaceCodes'])->name('space.delete.level');

            Route::post('/space-options/{setup}', [SpaceController::class, 'adminOptionSpace'])->name('space.option.space');
            Route::get('/get-level', [SpaceController::class, 'adminShowLevel'])->name('space.get.level');
        });

        Route::middleware(['auth'])->prefix('utility-admin')->name('utility.')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('Dashboard');


        });

        // TENANTS
        Route::prefix('tenants')->group(function () {
            Route::get('/', [TenantsController::class, 'adminTenants'])->name('admin.tenants');
            Route::get('/data', [TenantsController::class, 'retrieveTenants'])->name('admin.tenants.data');
            Route::get('/add-tenants', [TenantsController::class, 'adminAddTenants'])->name('admin.add.tenants');
            Route::post('/submit-tenants', [TenantsController::class, 'adminSubmitTenants'])->name('admin.submit.tenants');
            Route::get('/get-sub-category', [TenantsController::class, 'getSubCategory'])->name('admin.get.sub.category');
            Route::get('/view-tenants-modal', [TenantsController::class, 'adminViewTenants'])->name('admin.tenant.documents');

            Route::post('/submit-tenant-documents', [TenantsController::class, 'adminAddDocuments'])->name('admin.submit.documents');
            Route::post('/approve-tenant-documents', [TenantsController::class, 'adminApproveDocuments'])->name('admin.tenant.documents.approve');

            Route::post('/delete-tenant', [TenantsController::class, 'adminDeleteTenants'])->name('admin.delete.tenants');
        });

        // LEASES

        Route::prefix('leases')->group(function () {
            Route::get('/mall-leaseable-info', [LeasesController::class, 'adminMallLeaseableInfo'])->name('leases.mall.leases');


            Route::get('/leases-proposal', [LeasesController::class, 'adminLeases'])->name('leases.leases.proposal');
            Route::get('/add-proposal', [LeasesController::class, 'addLease'])->name('leases.add.proposal');
            Route::get('/pull-utilities-charges', [LeasesController::class, 'getChargesUtilities'])->name('admin.pull.utilities.charges');
            Route::post('/submit-lease-proposal/{option}', [LeasesController::class, 'adminSubmitLeaseProposal'])->name('lease.submit.lease.proposal');
            Route::get('/show-proposal', [LeasesController::class, 'showProposal'])->name('lease.show.proposal');
            Route::get('/show-counter-proposal', [LeasesController::class, 'showCounterProposal'])->name('lease.show.counter.proposal');
            Route::get('/get-business-info', [LeasesController::class, 'adminGetBusinessInfo'])->name('lease.business.info');
            // Route::get('/lease-option-proposal/{set}', [LeasesController::class, 'adminOptionsProposal'])->name('lease.option.proposals');
            // routes/web.php BAGO

            Route::post('/lease-option-proposal/{set}', [LeasesController::class, 'adminOptionsProposal'])->name('lease.option.proposal');

            Route::get('/proposal-data', [LeasesController::class, 'getProposalData'])->name('leases.proposal.data');


        });

        // UTILITY

        Route::get('/utility', [UtilityController::class, 'adminUtility'])->name('admin.utility');
        Route::prefix('utility')->group(function () {
            Route::post('/add-utility', [UtilityController::class, 'adminAddUtility'])->name('admin.add.utility');
            Route::post('/delete-utility', [UtilityController::class, 'deleteUtility'])->name('admin.delete.utility');
        });

        Route::get('/charges', [ChargeController::class, 'adminCharges'])->name('admin.charges');
        Route::post('/delete-charges', [ChargeController::class, 'adminDeleteCharges'])->name('admin.delete.charges');
        Route::post('/submit-charges', [ChargeController::class, 'adminAddCharges'])->name('submit.charges');

        // Route::get('/branch', [BranchController::class, 'adminBranch'])->name('admin.branch');
        // Route::prefix('branch')->group(function () {
        //     Route::post('/add-branch', [BranchController::class, 'adminAddBranch'])->name('branch.add.branch');
        // });

        // ADMIN CATEGORY

        Route::get('/category', [CategoryController::class, 'adminCategory'])->name('admin.category');

        Route::prefix('category')->group(function () {
            Route::post('/submit-category', [CategoryController::class, 'store'])->name('submit.category');
            Route::get('/categories', [CategoryController::class, 'getCategories'])->name('get.category');
            Route::post('/submit-sub-category', [CategoryController::class, 'storeSubCategory'])->name('submit.sub.category');
            Route::post('/delete-category', [CategoryController::class, 'delete'])->name('admin.delete.category');
        });

        // AMENITIES

        Route::get('/amenities', [AdminController::class, 'adminAmenities'])->name('admin.amenities');
        Route::prefix('amenities')->group(function () {
            Route::post('/submit-amenities', [AdminController::class, 'adminSubmitAmenities'])->name('admin.submit.amenities');
            Route::post('/delete-amenities', [AdminController::class, 'deleteAmenities'])->name('admin.delete.amenities');
        });

        // NOTICES

        Route::prefix('notices')->group(function () {
            Route::get('/award-notices/{option}', [VacateNoticesController::class, 'adminAwardNotices'])->name('admin.award.notices');
            Route::get('/get-files/{option}', [VacateNoticesController::class, 'adminAwardNotices'])->name('admin.award.get');
            Route::get('/view-files/{option}', [VacateNoticesController::class, 'adminAwardNotices'])->name('admin.award.view');
            Route::post('/submit-files/{option}', [VacateNoticesController::class, 'adminAwardNotices'])->name('admin.award.submit');

            Route::post('notice-option/{validation}', [VacateNoticesController::class, 'adminNoticeOptions'])->name('admin.notice.options');

            Route::get('/vacate-notices', [VacateNoticesController::class, 'adminVacateNotices'])->name('admin.vacate.notices');
            Route::get('/notices-data', [VacateNoticesController::class, 'getNoticesData'])->name('admin.notices.data');


            // Route::get('/award-notices/data', [VacateNoticesController::class, 'getNoticesData'])->name('admin.notices.data');
        });

        // CONTRACTS

        Route::prefix('contract')->group(function () {
            Route::get('/renewal-contract', [ContractController::class, 'adminRenewalContract'])->name('admin.renewal.contract');
            Route::get('/view-contract', [ContractController::class, 'adminViewContract'])->name('admin.view.contract');
            Route::get('/termination-contract', [ContractController::class, 'adminTerminationContract'])->name('admin.termination.contract');

            // Route::get('/download-vacate-notice', [ContractController::class, 'downloadVacateNoticePDF'])->name('download.vacate.notice');
        });

        // AMENITIES


        Route::get('/amenities', [AdminController::class, 'adminAmenities'])->name('admin.amenities');
        Route::prefix('amenities')->group(function () {
            Route::post('/submit-amenities', [AdminController::class, 'adminSubmitAmenities'])->name('admin.submit.amenities');
            Route::get('/specific-amenities-delete', [AdminController::class, 'deleteAmenities'])->name('amenities.delete');
        });

        // Route::prefix('commencement')->group(function () {
        //     Route::get('/lists', [CommencementController::class, 'index'])->name('commencement.lists');
        //     Route::post('/commencement-update', [CommencementController::class, 'commencementUpdate'])->name('commencement.update');
        // });

        // BILL ADMIN


        Route::get('/billing-periods', [AdminController::class, 'adminBillingPeriods'])->name('admin.bill.period');

        Route::get('/settings', [AdminController::class, 'adminSettings'])->name('admin.settings');
        Route::get('/reports', [AdminController::class, 'adminReports'])->name('admin.reports');
        Route::get('/payments', [AdminController::class, 'adminPayments'])->name('admin.payments');
        Route::get('/activity-log', [AdminController::class, 'adminActivityLog'])->name('admin.activity-log');
    });

    // CLIENT

    Route::prefix('client')->middleware('role.check:tenant')->group(function () {
        Route::get('/dashboard', [ClientController::class, 'clientIndex'])->name('client.dashboard');
        Route::get('/lease-proposals', [ClientProposalController::class, 'index'])->name('client.proposal');
        Route::get('/award-notice', [ClientAwardNoticeController::class, 'index'])->name('client.award.notice');
        Route::get('/contracts', [ClientContractController::class, 'index'])->name('client.contracts');
        Route::get('/space', [ClientSpaceController::class, 'index'])->name('client.space');
        Route::get('/billing', [ClientBillingController::class, 'index'])->name('client.billing');

        Route::get('/ledger', [ClientLedgerController::class, 'index'])->name('client.ledger');

        Route::prefix('setup')->group(function () {
            Route::get('/authorized-personnel', [ClientAuthorizedPersonelController::class, 'index'])->name('client.auth.person');
            Route::get('/documents', [ClientDocumentsController::class, 'index'])->name('client.documents');
        });
    });

    // BILLER

    Route::prefix('biller')->middleware('role.check:bill')->group(function () {
        Route::get('/dashboard', [BillController::class, 'index'])->name('bill.dashboard');

        Route::prefix('collection')->group(function () {
            Route::get('/cashier', [CashierController::class, 'index'])->name('bill.cashier');
            Route::post('/prepare-bill', [CashierController::class, 'prepare'])->name('bill.cashier.prepare');
            Route::get('/ledger', [CashierController::class, 'ledger'])->name('bill.cashier.ledger');
        });

        Route::prefix('billing')->group(function () {
            Route::get('/biller', [BillController::class, 'bill'])->name('bill.billing');
            Route::get('/lists', [BillController::class, 'contractLists'])->name('biller.period.lists');
            Route::get('/check-periods', [BillController::class, 'checkBills'])->name('biller.check.bills');

            Route::post('/prepare-bill', [BillController::class, 'prepare'])->name('biller.prepare.process');
            Route::get('/billing-period', [BillController::class, 'period'])->name('bill.period');
        });

    });

    // UTILITY ROUTES / EXTENSION

    // Route::prefix('utility')->group(function () {
    //     Route::get('/reading', [ActivitiesController::class, 'index'])->name('utility.reading');
    //     Route::get('/lists', [ActivitiesController::class, 'lists'])->name('utility.reading.get');
    //     Route::get('/utility-lists', [ActivitiesController::class, 'utilityLists'])->name('utility.reading.lists');
    //     Route::get('/utility-reading', [ActivitiesController::class, 'reading'])->name('utility.reading.bills');
    //     Route::post('/prepare-reading', [ActivitiesController::class, 'prepare'])->name('utility.reading.store');
    //     Route::post('/save-reading', [ActivitiesController::class, 'save'])->name('utility.reading.save');

    // });

    // UTILITY ROUTES / EXTENSION DUPLICATE

    Route::group(['middleware' => ['auth', 'authCheck']], function () {

        Route::prefix('utility')->group(function () {
            Route::get('/dashboard', [UtilityController::class, 'dashboard'])->name('utility.dashboard');

            Route::get('/utility', [UtilityController::class, 'index'])->name('utility.reading.input-reading-modal');
             Route::get('/lists', [UtilityController::class, 'lists'])->name('reading.get.list');
            Route::get('/utility-lists', [UtilityController::class, 'utilityLists'])->name('reading.lists.utility');
            Route::get('/utility-reading', [UtilityController::class, 'reading'])->name('reading.bills.utility');
            Route::post('/prepare-reading', [UtilityController::class, 'prepare'])->name('reading.store');
            Route::post('/save-reading', [UtilityController::class, 'save'])->name('reading.save');

        });

    });

        Route::prefix('collector')->middleware('role.check:collect')->group(function () {

            // GET /collector/dashboard
            Route::get('/dashboard', [CollectionController::class, 'index'])->name('collect.dashboard');

            // GET /collector/collect
            Route::get('/collect', [CollectionController::class, 'collect']) ->name('collect.invoices');

            // All the collection-related endpoints
            Route::prefix('collection')->group(function () {
                // GET  /collector/collection/ledger
            Route::get('/ledger', [CollectionController::class, 'get'])->name('collect.ledger.index');

                // GET  /collector/collection/contract-info
            Route::get('/contract-info', [CollectionController::class, 'view'])->name('collect.get.bills');

                // POST /collector/collection/collect-bill
            Route::post('/collect-bill', [CollectionController::class, 'store'])->name('collect.store.bills');

                // GET  /collector/collection/check-periods
                Route::get('/check-periods', [CollectionController::class, 'checkBills'])->name('collect.check.bills');
            });

            // Ledger table view
            Route::prefix('ledger')->group(function () {
            Route::get('/ledger-table', [CollectionLedgerController::class, 'collect_index'])->name('collect.ledger.table');
            });
        });

    Route::prefix('operation')->middleware('role.check:operation')->group(function () {
        Route::get('/dashboard', [OperationController::class, 'index'])->name('operation.dashboard');

        Route::prefix('permits')->group(function () {
            Route::get('/pre-construction', [PreConstructionController::class, 'index'])->name('pre.construction.operation');
            Route::get('/get-lists', [PreConstructionController::class, 'tenantLists'])->name('pre.construction.get.tenant.lists');
            Route::get('/contract-lists', [PreConstructionController::class, 'contractLists'])->name('pre.construction.get.contract.lists');

            Route::get('/work-permits', [WorkPermitController::class, 'index'])->name('work.permit.operation');
        });

        Route::prefix('notices')->group(function () {
            Route::get('/award-notices/{option}', [OperationNoticesController::class, 'operationAwardNotices'])->name('operation.award.notices');
            Route::get('operation/notices/get-files/{option}', [OperationNoticesController::class, 'operationAwardNotices'])->name('operation.award.get');

            Route::get('/view-files/{option}', [OperationNoticesController::class, 'operationAwardNotices'])->name('operation.award.view');
            Route::post('/submit-files/{option}', [OperationNoticesController::class, 'operationAwardNotices'])->name('operation.award.submit');
            Route::post('notice-option/{validation}', [OperationNoticesController::class, 'operationNoticeOptions'])->name('operation.notice.options');
            Route::get('/vacate-notices', [OperationNoticesController::class, 'operationVacateNotices'])->name('operation.vacate.notices');

        });

        Route::prefix('contract')->group(function () {
            Route::get('/renewal-contract', [OperationContractController::class, 'operationRenewalContract'])->name('operation.renewal.contract');
            Route::get('/view-contract', [ContractController::class, 'adminViewContract'])->name('operation.view.contract');
            Route::get('/termination-contract', [OperationContractController::class, 'operationTerminationContract'])->name('operation.termination.contract');
        });

        Route::prefix('construction')->group(function () {
            Route::get('/construction-release', [ConstructionController::class, 'index'])->name('space.construction.construction');
        });

        // Utility Reading Routes
        Route::prefix('utility-reading')->group(function () {
            Route::get('/reading', [UtilityReadingController::class, 'index'])->name('reading.reading.operation');
            Route::get('/lists', [UtilityReadingController::class, 'lists'])->name('reading.get.list');
            Route::get('/utility-lists', [UtilityReadingController::class, 'utilityLists'])->name('reading.lists.utility');
            Route::get('/utility-reading', [UtilityReadingController::class, 'reading'])->name('reading.bills.utility');
            Route::post('/prepare-reading', [UtilityReadingController::class, 'prepare'])->name('reading.store');
            Route::post('/save-reading', [UtilityReadingController::class, 'save'])->name('reading.save');
        });
    });

    Route::prefix('lease-admin')->middleware('role.check:lease')->group(function () {
        Route::get('/dashboard', [LeaseAdminController::class, 'index'])->name('lease.admin.dashboard');

        Route::prefix('commencement')->group(function () {
            Route::get('/lists', [LeaseAdminController::class, 'commencement_index'])->name('lease.admin.commencement.lists');
            Route::post('/commencement-update', [LeaseAdminController::class, 'commencementUpdate'])->name('lease.admin.commencement.update');
            Route::get('/data', [LeaseAdminController::class, 'commencementData'])->name('lease.admin.commencement.data');
        });

        Route::prefix('permits')->group(function () {
            Route::get('/list', [IssuePermitscontroller::class, 'permits_index'])->name('lease.admin.permits.lists');
            Route::get('/contract-lists', [IssuePermitscontroller::class, 'get_contracts'])->name('lease.admin.contract.lists');
        });

    });
});
