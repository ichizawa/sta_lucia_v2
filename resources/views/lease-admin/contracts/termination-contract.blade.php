@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Termination of Contract</h3>
                <h6 class="op-7 mb-0 mb-3">Contract Summary Overview</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Terminations</h4>
                            {{-- <button class="btn btn-outline-info btn-round ms-auto" data-bs-toggle="modal"
                                data-bs-target="#addRowModal">
                                <i class="fa fa-plus"></i>
                                Add Termination
                            </button> --}}

                            <a href="" class="btn btn-sta ms-auto" data-bs-toggle="modal"
                                data-bs-target="#addRowModal">
                                <i class="fa fa-plus"></i>
                                Add Termination
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">Lease Date</th>
                                        <th class="text-center">Termination Notice Date</th>
                                        <th class="text-center">Termination Effective Date</th>
                                        <th class="text-center">Reason for Termination</th>
                                        <th class="text-center">Security Deposit</th>
                                        <th class="text-center">Final Inspection Date</th>
                                        <th class="text-center">Key Return Date</th>
                                        <th class="text-center">Final Rent Payment Due</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Tiger Nixon</td>
                                        <td class="text-center">123 Main St, Edinburgh</td>
                                        <td class="text-center">2023/01/01</td>
                                        <td class="text-center">2024/01/01</td>
                                        <td class="text-center">2024/08/01</td>
                                        <td class="text-center">Mutual Agreement</td>
                                        <td class="text-center">$1,200</td>
                                        <td class="text-center">2024/08/30</td>
                                        <td class="text-center">2024/08/31</td>
                                        <td class="text-center">$1,200</td>
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
