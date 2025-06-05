@extends('layouts')

@section('content')
    @include('admin.contracts.contract-modals.view-contract-modal')

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Renewal of Contract</h3>
                <h6 class="op-7 mb-0 mb-3">Summary List of Contract Renewal</h6>
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
                            <table id="basic-datatables" class="display table table-striped table-hover" style="width: 100%;">
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
                                    {{-- DataTables will populate via AJAX --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- The “View Contract” modal markup, as before: --}}
    @include('admin.contracts.contract-modals.view-contract-modal')

    {{-- DataTables CSS/JS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    {{-- Pusher JS --}}
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <script>
    $(document).ready(function() {
        // -----------------------
        // 1) Initialize DataTable
        // -----------------------
        let dtContracts = $('#basic-datatables').DataTable({
            processing: false,
            serverSide: false,
            responsive: true,
            autoWidth: false,

            ajax: {
                url: "{{ route('admin.renewal.contract') }}",
                dataSrc: ''
            },
            columns: [
                { data: 'company_name',    className: 'text-center' },
                { data: 'renewal_term',    className: 'text-center' },
                { data: 'monthly_rent',    className: 'text-center' },
                { data: 'due_date',        className: 'text-center' },
                { data: 'agreement_date',  className: 'text-center' },
                {
                    data: 'contract_id',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(id) {
                        return `
                        <button
                            class="btn btn-sm btn-warning viewContract"
                            data-contract-id="${id}"
                            data-bs-toggle="modal"
                            data-bs-target="#viewContractModal"
                            title="View Contract">
                            <i class="fas fa-edit"></i>
                        </button>`;
                    }
                }
            ],
            order: [[0, 'asc']]
        });

        // ---------------------------------------------------
        // 2) Hook up “View Contract” buttons to AJAX → view
        // ---------------------------------------------------
        $('#basic-datatables').on('click', '.viewContract', function() {
            let contractId = $(this).data('contract-id');
            $('#viewContractModal .modal-body').html('Loading…');

            $.ajax({
                url: "{{ route('admin.view.contract') }}",
                method: 'GET',
                data: { id: contractId },
                success: function(response) {
                    // response = { filedir: "...", contract: {...} }
                    let c = response.contract;
                    let pdfUrl = response.filedir;

                    let html = `
                        <h5>Contract ID: ${c.id}</h5>
                        {{-- Add any other fields you’d like here: e.g. company_name: ${c.company_name} --}}
                        <hr>
                        <div class="text-center">
                            <embed src="${pdfUrl}#toolbar=0"
                                   type="application/pdf"
                                   width="100%"
                                   height="500px" />
                        </div>
                        <p class="mt-2 text-center">
                            <a href="${pdfUrl}" class="btn btn-primary" target="_blank">
                                Download PDF
                            </a>
                        </p>`;

                    $('#viewContractModal .modal-body').html(html);
                },
                error: function() {
                    $('#viewContractModal .modal-body').html(
                        '<p class="text-danger">Error loading contract. Please try again.</p>'
                    );
                }
            });
        });

        // ----------------------------
        // 3) Set up Pusher subscription
        // ----------------------------
        Pusher.logToConsole = true; // for debugging

        let pusher = new Pusher('1eedc3e004154aadb5dc', {
            cluster: 'ap1',
            forceTLS: true
        });

        let channel = pusher.subscribe('contract-channel');
        channel.bind('contract-renewed', (payload) => {
            console.log('Received contract-renewed event:', payload);
            // When a contract is created/renewed/updated, reload the DataTable:
            dtContracts.ajax.reload(null, false);
        });
    });
    </script>
@endsection
