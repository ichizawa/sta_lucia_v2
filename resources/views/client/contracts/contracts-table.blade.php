@extends('layouts')

@section('content')

<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Contracts</h3>
            <h6 class="op-7 mb-2">Tenant Billing System</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of Contracts</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="client" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Proposal ID</th>
                                    <th>Space/s</th>
                                    <th>Total Floor Area/s</th>
                                    <th>Tenant Type</th>
                                    <th>Status</th>
                                    <th>View Proposal</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection