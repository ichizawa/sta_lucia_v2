<style>
    .center-table th,
    .center-table td {
        text-align: center;
        vertical-align: middle;
    }
</style>


@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">Tenant Billing System</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fa-solid fa-file-contract"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Contracts</p>
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
                                <div class="icon-big text-center icon-danger bubble-shadow-small">
                                    <i class="fa-solid fa-money-bill"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Unpaid Billings</p>
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
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Unprepared Billings</p>
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
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="fa-solid fa-calendar-week"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Current Billing Period</p>
                                    <h4 class="card-title">April 2025</h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Top Paying Tenants</div>
                    </div>
                    <div class="card-body">
                        <table class="table center-table">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Proposal #</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>574521</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>789150</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>784512</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>895612</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>741258</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>785400</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>784503</td>
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
