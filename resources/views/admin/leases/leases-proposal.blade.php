@extends('layouts')

@section('content')
    @include('admin.components.modals.proposal-modal')
    @include('admin.components.modals.counter-proposals-modal')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Lease Proposal</h3>
                <h6 class="op-7 mb-2">Lease Proposal Summary</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Mall Lease Proposal</h4>
                            <a href="{{ route('leases.add.proposal') }}" class="btn btn-sta ms-auto">
                                <i class="fa fa-plus"></i>
                                Create New Lease Proposal
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Proposed To</th>
                                        <th class="text-center">Space/s</th>
                                        <th class="text-center">Total Floor Area/s</th>
                                        <th class="text-center">Tenant Type</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="proposals_table">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            $(document).ready(function() {
                $.notify({
                    message: '{{ session('success') }}',
                    title: 'Success',
                    icon: 'fa fa-bell'
                }, {
                    type: 'success',
                    placement: { from: 'top', align: 'right' },
                    time: 1000,
                    delay: 1200
                });
            });
        </script>
    @endif

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <script>
        let dtProposal;

        $(document).ready(function() {
            function orNA(value) {
                return (value === null || value === undefined || value === '') ? 'N/A' : value;
            }

            if (! $.fn.DataTable.isDataTable('#multi-filter-select')) {
                dtProposal = $('#multi-filter-select').DataTable({
                    processing: false,
                    serverSide: false,
                    ajax: {
                        url: "{{ route('leases.proposal.data') }}",
                        dataSrc: ''
                    },
                    columns: [
                        {
                            data: 'company_name',
                            className: 'text-center',
                            render: data => orNA(data)
                        },
                        {
                            data: 'property_codes',
                            className: 'text-center',
                            render: data => orNA(data)
                        },
                        {
                            data: 'total_space_area',
                            className: 'text-center',
                            render: data => orNA(data) + (data ? ' sqm' : '')
                        },
                        {
                            data: 'tenant_type',
                            className: 'text-center',
                            render: data => orNA(data)
                        },
                        {
                            data: 'status',
                            className: 'text-center',
                            render: val => {
                                if (val === null || val === undefined) {
                                    return '<span class="badge bg-secondary">N/A</span>';
                                }
                                const statusInt = parseInt(val, 10);
                                if (statusInt === 1) {
                                    return '<span class="badge bg-success">Approved</span>';
                                } else if (statusInt === 2) {
                                    return '<span class="badge bg-danger">Rejected</span>';
                                } else {
                                    return '<span class="badge bg-warning">Pending</span>';
                                }
                            }
                        },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            className: 'text-center',
                            render: row => `
                                <button class="btn btn-sm btn-success showProposalContents"
                                        data-show-proposal-id="${row.id}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#leaseProposal">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-warning editProposalContents"
                                        data-edit-proposal-id="${row.id}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editProposal">
                                    <i class="fa fa-pen"></i>
                                </button>`
                        }
                    ],
                    autoWidth: false,
                    responsive: true,
                    language: {
                        info: "_START_-_END_ of _TOTAL_ proposals",
                        searchPlaceholder: "Search proposals",
                        paginate: {
                            next: '<i class="dw dw-right-chevron"></i>',
                            previous: '<i class="dw dw-left-chevron"></i>'
                        }
                    },
                    order: [[0, 'asc']]
                });
            }
            Pusher.logToConsole = true;
            const pusher = new Pusher('1eedc3e004154aadb5dc', {
                cluster: 'ap1',
                forceTLS: true
            });
            const channel = pusher.subscribe('lease-channel');
            channel.bind('proposal-updated', () => {
                console.log('Pusher event caught: reloading proposals table');
                $('#multi-filter-select').DataTable().ajax.reload(null, false);
            });
        });
    </script>
@endsection
