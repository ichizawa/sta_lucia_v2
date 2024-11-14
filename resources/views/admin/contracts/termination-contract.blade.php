@extends('layouts')

@section('content')
   
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Termination of Contract</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Terminations</h4>
                            <button class="btn btn-outline-info btn-round ms-auto" data-bs-toggle="modal"
                                data-bs-target="#addRowModal">
                                <i class="fa fa-plus"></i>
                                Add Termination
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Lease Date</th>
                                        <th>Termination Notice Date</th>
                                        <th>Termination Effective Date</th>
                                        <th>Reason for Termination</th>
                                        <th>Security Deposit</th>
                                        <th>Final Inspection Date</th>
                                        <th>Key Return Date</th>
                                        <th>Final Rent Payment Due</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>123 Main St, Edinburgh</td>
                                        <td>2023/01/01</td>
                                        <td>2024/01/01</td>
                                        <td>2024/08/01</td>
                                        <td>Mutual Agreement</td>
                                        <td>$1,200</td>
                                        <td>2024/08/30</td>
                                        <td>2024/08/31</td>
                                        <td>$1,200</td>
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
