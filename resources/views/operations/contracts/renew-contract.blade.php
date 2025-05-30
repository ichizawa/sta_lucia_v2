@extends('layouts')
@section('content')
    @include('operations.contracts.contract-modals.view-contract-modal')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Renewal of Contract</h3>
                <h6 class="op-7 mb-2">Summary List of Contract Renewal</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Contracts</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Company Name</th>
                                        <th class="text-center">Renewal Term</th>
                                        <th class="text-center">Monthly Rent</th>
                                        <th class="text-center">Due Date</th>
                                        <th class="text-center">Date of Agreement</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($all as $contract)
                                        <tr>
                                            <td class="text-center">{{ $contract->company_name }}</td>
                                            <td class="text-center">{{ $contract->lease_term }}</td>
                                            <td class="text-center">P {{ number_format($contract->total_rent, 2) }}</td>
                                            <td class="text-center">{{ date('F, Y', strtotime($contract->end_contract)) }}
                                            </td>
                                            <td class="text-center">{{ date('F, Y', strtotime($contract->commencement)) }}
                                            </td>
                                            <!-- <td>{{ date('F d, Y', strtotime($contract->created_at)) }}</td> -->
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-warning viewContract"
                                                    data-contract-id="{{ $contract->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#viewContractModal">
                                                    <i class="fas fa-edit"></i>
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
