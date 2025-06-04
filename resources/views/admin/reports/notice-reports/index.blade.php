@extends('layouts')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Notice Reports</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Tenant Name</th>
                                    <th>Notice Type</th>
                                    <th>Date Created</th>
                                    <th>Date Updated</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Fake Company</td>
                                    <td>Award Notice</td>
                                    <td>2026/04/25</td>
                                    <td>2026/04/25</td>
                                    <td>Approved</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal"
                                                data-bs-target="#noticeReportSetup">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>My Company</td>
                                    <td>Award Notice</td>
                                    <td>2026/04/25</td>
                                    <td>2026/04/25</td>
                                    <td>Pending</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal"
                                                data-bs-target="#noticeReportSetup">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tang Inasar</td>
                                    <td>Vacate Notice</td>
                                    <td>2026/04/25</td>
                                    <td>2026/04/25</td>
                                    <td>Approved</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal"
                                                data-bs-target="#noticeReportSetup">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bench</td>
                                    <td>Award Notice</td>
                                    <td>2026/04/25</td>
                                    <td>2026/04/25</td>
                                    <td>Pending</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal"
                                                data-bs-target="#noticeReportSetup">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Oxygen</td>
                                    <td>Award Notice</td>
                                    <td>2026/04/25</td>
                                    <td>2026/04/25</td>
                                    <td>Approved</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal"
                                                data-bs-target="#noticeReportSetup">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jollibee</td>
                                    <td>Award Notice</td>
                                    <td>2026/04/25</td>
                                    <td>2026/04/25</td>
                                    <td>Approved</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal"
                                                data-bs-target="#noticeReportSetup">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Greenwich</td>
                                    <td>Vacate Notice</td>
                                    <td>2026/04/25</td>
                                    <td>2026/04/25</td>
                                    <td>Pending</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal"
                                                data-bs-target="#noticeReportSetup">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Watsons</td>
                                    <td>Vacate Notice</td>
                                    <td>2026/04/25</td>
                                    <td>2026/04/25</td>
                                    <td>Approved</td>
                                    <td>
                                        <div class="form-button-action">
                                            <button class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal"
                                                data-bs-target="#noticeReportSetup">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
