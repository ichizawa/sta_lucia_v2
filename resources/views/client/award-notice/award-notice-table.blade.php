@extends('layouts')

@section('content')

<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Award Notices</h3>
            <h6 class="op-7 mb-2">Tenant Billing System</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of Award Notice</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="client" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Store Name</th>
                                    <th>Nature of Business</th>
                                    <th>Date Awarded</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($awardnotice as $award)
                                    <tr>
                                        <td>{{ $award->store_name }}</td>
                                        <td>{{ $award->bussiness_nature }}</td>
                                        <td>{{ $award->created_at }}</td>
                                        <td>{{ $award->status }}</td>
                                        <td>
                                            <a class="btn btn-warning btn-sm">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>Proposal ID</th>
                                    <th>Space/s</th>
                                    <th>Total Floor Area/s</th>
                                    <th>Tenant Type</th>
                                    <th>Status</th>
                                    <th>View Proposal</th>
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