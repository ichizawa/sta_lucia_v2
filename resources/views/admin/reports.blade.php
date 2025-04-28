@extends('layouts')
@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Reports</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Reports</h4>
                            <!-- <button class="btn btn-outline-info btn-round ms-auto" data-bs-toggle="modal"
                                                    data-bs-target="#addRowModal">
                                                    <i class="fa fa-plus"></i>
                                                    Add Utitlity
                                                </button> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Store Name</th>
                                        <th class="text-center">Store Representative</th>
                                        <th class="text-center">Report</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Vape Mart</td>
                                        <td class="text-center">Ace Batingal</td>
                                        <td class="text-center">Sales</td>
                                        <td class="text-center">View Report</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
