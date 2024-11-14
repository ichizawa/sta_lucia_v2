@extends('layouts')

@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Billing</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Billing Periods</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi-filter-select" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Bill #</th>
                                    <th>Lease #</th>
                                    <th>Remarks</th>
                                    <th>Amount</th>
                                    <th>Date From</th>
                                    <th>Date To</th>
                                    <th>Status</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($billing as $collect)
                                    <tr>
                                        <td>{{ $collect->details[0]->bill_no }}</td>
                                        <td>{{ $collect->proposal[0]->proposal_uid }}</td>
                                        <td>{{ $collect->details[0]->remarks ?? 'No Remarks' }}</td>
                                        <td>₱ {{ number_format($collect->details[0]->total_amount_payable, 2) }}</td>
                                        <td>{{ date('M d, Y', strtotime($collect->details[0]->date_from)) }}</td>
                                        <td>{{ date('M d, Y', strtotime($collect->details[0]->date_to)) }}</td>
                                        <td>{!! $collect->details[0]->status ? '<span class="badge bg-success">Paid</span>' : '<span class="badge bg-warning">Pending</span>' !!}</td>
                                        <!-- <td>
                                            <button class="btn btn-warning btn-sm utilityList" data-bs-toggle="modal"
                                                data-bs-target="#utilityListModal" data-id="{{ $collect->id }}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </td> -->
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