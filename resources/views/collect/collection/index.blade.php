@extends('layouts')

@section('content')
@include('collect.collection.collect-modal.collection-modal')
@include('collect.collection.collect-modal.collection-contract-modal')
@include('collect.collection.collect-modal.collection-option-modal')
@include('collect.collection.ledgers.ledger-modal-table')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Collection</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xl-8 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Tenant Lists</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tenant-datatables" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Tenant #</th>
                                        <th>Tenant Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Select Year</h4>
                            <!-- <button class="btn btn-sta ms-auto create-bill me-2" data-bs-toggle="modal"
                            data-bs-target="#collectionModal">
                            <i class="fa fa-plus"></i>
                            Pay Collection
                        </button> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="collect-datatables" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const BILL_CHECK = "{{ route('biller.check.bills') }}";
</script>
@endsection