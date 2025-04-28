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
                                        <th class="text-center">Store Name</th>
                                        <th class="text-center">Nature of Business</th>
                                        <th class="text-center">Date Awarded</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($awardnotice as $award)
                                        <tr>
                                            <td class="text-center">{{ $award->store_name }}</td>
                                            <td class="text-center">{{ $award->bussiness_nature }}</td>
                                            <td class="text-center">{{ $award->created_at }}</td>
                                            <td class="text-center">{{ $award->status }}</td>
                                            <td class="text-center">
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
