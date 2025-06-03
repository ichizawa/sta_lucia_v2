@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Issue Permits</h3>
                <h6 class="op-7 mb-2">Permits Overview</h6>
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
                            <table id="permit_tenant_table" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Tenant #</th>
                                        <th class="text-center">Tenant Name</th>
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
                            <table id="permit_contract_table" class="table table-striped table-hover">
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
            $('#permit_tenant_table').DataTable({
                pageLength: 10,
                responsive: true,
                data: @json($tenants),
                columns: [{
                        data: "acc_id",
                        className: "text-center",
                    },
                    {
                        data: "store_name",
                        className: "text-center",

                    },
                ],
                createdRow: function(row, data, index) {
                    $(row).addClass('cursor-pointer');
                    $(row).addClass('check_contract');
                    $(row).attr('data-id', data.id);
                }
            });
            const permit_contract_table = $('#permit_contract_table').DataTable({
                pageLength: 10,
                responsive: true,
                processing: true,
                columns: [{
                        data: "proposal_uid",
                        className: "text-center",

                    },
                    {
                        data: "end_contract",
                        className: "text-center",
                        render: function(data) {
                            return format_date(data);
                        }
                    },
                    {
                        data: "created_at",
                        className: "text-center",
                        render: function(data) {
                            return format_date(data);
                        }
                    }
                ]
            });

            $(document).on('click', '.check_contract', function() {
                var id = $(this).data('id');

                $.ajax({
                    url: "{{ route('lease.admin.contract.lists') }}",
                    type: "GET",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(data) {
                        permit_contract_table.clear();
                        permit_contract_table.rows.add(data).draw();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
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
