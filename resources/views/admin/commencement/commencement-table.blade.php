@extends('layouts')

@section('content')
@include('admin.commencement.commencement-modals.update-commencement-modal')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Commencement Lists</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">List of Commencements</h4>
                        <button class="btn btn-sta ms-auto edit-comm-date" data-bs-toggle="modal"
                            data-bs-target="#comm-date-modal">
                            <i class="fa fa-plus"></i>
                            Update Commencement
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="comm_table" class="display table table-striped table-hover commencement-table">
                            <thead>
                                <tr>
                                    <th>Proposal Number</th>
                                    <th>Tenant Name</th>
                                    <th>Date Created</th>
                                    <th>Commencement Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proposal as $commence)
                                    <tr>
                                        <td>{{ $commence->proposal_uid }}</td>
                                        <td>{{ $commence->store_name }}</td>
                                        <td>{{ date('F d, Y', strtotime($commence->created_at)) }}</td>
                                        <td>{{ $commence->commencement_date ? date('F Y', strtotime($commence->commencement_date)) : 'N/A' }}</td>
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