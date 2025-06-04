@extends('layouts')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Space Lease Reports</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Space Name</th>
                                    <th>Space Type</th>
                                    <th>Date Created</th>
                                    <th>Date Updated</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jollibe</td>
                                    <td>Food Chain</td>
                                    <td>2026/04/25</td>
                                    <td>2026/04/25</td>
                                    <td>Active</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Watsons</td>
                                    <td>Drugstore</td>
                                    <td>2026/04/25</td>
                                    <td>2026/04/25</td>
                                    <td>Pending</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ace Hardware</td>
                                    <td>Hardware</td>
                                    <td>2026/04/25</td>
                                    <td>2026/04/25</td>
                                    <td>Active</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Taco Boy</td>
                                    <td>Food Stall</td>
                                    <td>2026/04/25</td>
                                    <td>2026/04/25</td>
                                    <td>Active</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
