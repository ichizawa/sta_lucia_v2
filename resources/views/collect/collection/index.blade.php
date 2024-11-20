@extends('layouts')

@section('content')
@include('collect.collection.collect-modal.create-collect-modal')
@include('collect.collection.collect-modal.utility-reading-modal')
@include('collect.collection.collect-modal.select-reading-modal')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Collection</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Lists to Collect</h4>
                        <!-- <button class="btn btn-sta ms-auto create-bill me-2" data-bs-toggle="modal"
                            data-bs-target="#collectionModal">
                            <i class="fa fa-plus"></i>
                            Pay Collection
                        </button> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="collect-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Bill #</th>
                                    <th>Lease #</th>
                                    <th>Remarks</th>
                                    <th>Total Rent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($billing as $collect)
                                    <tr>
                                        <td>{{ $collect->details[0]->bill_no }}</td>
                                        <td>{{ $collect->proposal[0]->proposal_uid }}</td>
                                        <td>{{ $collect->details[0]->remarks ?? 'No Remarks' }}</td>
                                        <td>₱ {{ number_format($collect->details[0]->total_amount_payable, 2) }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm utilityList" data-bs-toggle="modal"
                                                data-bs-target="#utilityListModal" data-id="{{ $collect->id }}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>Account #</th>
                                    <th>Tenant Name</th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection