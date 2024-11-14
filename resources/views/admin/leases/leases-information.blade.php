@extends('layouts')

@section('content')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Mall Leasable Information</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Leasable Information</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi-filter-select" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Space Name</th>
                                    <th>Space Type</th>
                                    <th>Floor Area</th>
                                    <th>Store Type</th>
                                    <th>Assigned To</th>
                                    <th>Availability</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($space as $leasable_space)
                                    <!-- {{$leasable_space}} -->
                                        <tr>
                                            <td>{{ ucwords($leasable_space->space_name) }}</td>
                                            <td>{{ $leasable_space->store_type }}</td>
                                            <td>{{ $leasable_space->space_area }}</td>
                                            <td>{{ $leasable_space->store_type }}</td>
                                            <td>{{ $leasable_space->owner_id ? ucwords($leasable_space->rep_fname . ' ' . $leasable_space->rep_lname) : 'Not Assigned' }}</td>
                                            <td>{!! $leasable_space->status ? '<span class="badge bg-secondary">Unavailable</span>' : '<span class="badge bg-success">Available</span>' !!}
                                            <!-- <td>
                                                <a class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#view-lease"><i class="fa fa-eye"></i></a>
                                                <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-lease"><i class="fa fa-pen"></i></a>
                                            </td> -->
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
@include('admin.components.modals.view-leasable-info')
@include('admin.components.modals.edit-leasable-info')
@endsection