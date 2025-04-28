<style>
    #pre_construction_table tbody td,
    #contract_construction_table tbody td {
        text-align: center;
    }
</style>


@extends('layouts')

@section('content')
    @include('operations.permits.pre_construction_modal')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Pre-Construction Dashboard</h3>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <!-- <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                                                                    <a href="#" class="btn btn-primary btn-round">Add Customer</a> -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Tenant Lists</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="pre_construction_table" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Tenant #</th>
                                        <th class="text-center">Tenant Name</th>
                                        <!-- <th>Status</th> -->
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Contract Lists</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="contract_construction_table" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Contract #</th>
                                        <th class="text-center">End of Contract</th>
                                        <th class="text-center">Contract Created</th>
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
    <script>
        $(document).ready(function() {
            const operation_tenant_table = $('#pre_construction_table').DataTable({
                pageLength: 10,
                responsive: true,
            });
            const tablecontractlists = $('#contract_construction_table').DataTable({
                pageLength: 10,
                responsive: true,
            });

            $.ajax({
                url: "{{ route('pre.construction.get.tenant.lists') }}",
                method: "GET",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    operation_tenant_table.clear();
                    $.map(response, function(value, index) {
                        let newRow = operation_tenant_table.row.add([
                            value.acc_id,
                            value.company_name,
                            // `<div class="d-flex align-items-center">
                        //         <a href="#" class="btn btn-sm btn-warning me-2" data-id="${value.id}" data-bs-toggle="modal" data-bs-target="#showListsContractModal">
                        //             <i class="fa fa-eye"></i>
                        //         </a>
                        //     </div>`
                        ]);

                        $(newRow.node()).addClass('cursor-pointer checkContracts').attr({
                            "data-id": value.id
                        });
                    });
                    operation_tenant_table.draw();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });

            $(document).on('click', '.checkContracts', function() {
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('pre.construction.get.contract.lists') }}",
                    method: "GET",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        tablecontractlists.clear();
                        $.map(response, function(value, index) {
                            let contractRow = tablecontractlists.row.add([
                                value.proposal_uid,
                                value.end_contract,
                                format_date(value.created_at),
                                // `<div class="d-flex align-items-center">
                            //     <a href="#" class="btn btn-sm btn-warning me-2" data-id="${value.id}" data-bs-toggle="modal" data-bs-target="#showListsContractModal">
                            //         <i class="fa fa-eye"></i>
                            //     </a>
                            // </div>`
                            ]);

                            $(contractRow.node()).addClass('cursor-pointer').attr({
                                "data-bs-toggle": "modal",
                                "data-bs-target": "#showLisstPermit",
                                "data-id": value.id
                            });
                        });
                        tablecontractlists.draw();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                })
            });

            function format_date(date) {
                let parsedDate = new Date(date);
                let options = {
                    month: 'short',
                    day: '2-digit',
                    year: 'numeric'
                };
                return parsedDate.toLocaleDateString('en-US', options);
            }
        });
    </script>
@endsection
