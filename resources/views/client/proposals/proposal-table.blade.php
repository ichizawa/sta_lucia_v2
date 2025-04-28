@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Proposal</h3>
                <h6 class="op-7 mb-2">Tenant Billing System</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List of Proposals</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="client" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Proposal ID</th>
                                        <th class="text-center">Space/s</th>
                                        <th class="text-center">Business</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">View Proposal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proposals as $proposal)
                                        <tr>
                                            <td class="text-center">{{ $proposal->id }}</td>
                                            <td class="text-center">{{ $proposal->space_name }}</td>
                                            <td class="text-center">{{ $proposal->bussiness_nature }}</td>
                                            <td class="text-center">{!! $proposal->status
                                                ? '<span class="badge badge-success">Active</span>'
                                                : '<span class="badge badge-warning">Pending</span>' !!}</td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-warning">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
