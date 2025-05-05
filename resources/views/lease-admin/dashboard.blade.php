@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Dashboard</h3>
                <h6 class="op-7 mb-2">Leasing Admin System</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Registered Tenants</p>
                                    <h4 class="card-title">58</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fa-solid fa-file-contract"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Active Contracts</p>
                                    <h4 class="card-title">60</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-warning bubble-shadow-small">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Pending Proposals</p>
                                    <h4 class="card-title">30</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-danger bubble-shadow-small">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Contracts Expiring Soon</p>
                                    <h4 class="card-title">16</h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Awaiting Commencement Date</div>
                            <div class="card-tools">
                                <div class="dropdown">
                                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0">
                                <thead class="lease-admin-thead">
                                    <tr>
                                        <th scope="col" class="text-center">Proposal Number</th>
                                        <th scope="col" class="text-center">Tenant Name</th>
                                        <th scope="col" class="text-center">Date Created</th>
                                        <th scope="col" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">325963</td>
                                        <td class="text-center">Elizabeth Olsen</td>
                                        <td class="text-center">April 9, 2025</td>
                                        <td class="text-center">
                                            <span class="badge badge-warning">pending</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">325963</td>
                                        <td class="text-center">Elizabeth Olsen</td>
                                        <td class="text-center">April 9, 2025</td>
                                        <td class="text-center">
                                            <span class="badge badge-warning">pending</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">325963</td>
                                        <td class="text-center">Elizabeth Olsen</td>
                                        <td class="text-center">April 9, 2025</td>
                                        <td class="text-center">
                                            <span class="badge badge-warning">pending</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">325963</td>
                                        <td class="text-center">Elizabeth Olsen</td>
                                        <td class="text-center">April 9, 2025</td>
                                        <td class="text-center">
                                            <span class="badge badge-warning">pending</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">325963</td>
                                        <td class="text-center">Elizabeth Olsen</td>
                                        <td class="text-center">April 9, 2025</td>
                                        <td class="text-center">
                                            <span class="badge badge-warning">pending</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">325963</td>
                                        <td class="text-center">Elizabeth Olsen</td>
                                        <td class="text-center">April 9, 2025</td>
                                        <td class="text-center">
                                            <span class="badge badge-warning">pending</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">325963</td>
                                        <td class="text-center">Elizabeth Olsen</td>
                                        <td class="text-center">April 9, 2025</td>
                                        <td class="text-center">
                                            <span class="badge badge-warning">pending</span>
                                        </td>
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
