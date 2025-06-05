@extends('layouts')

@section('content')
    {{-- Include the “View/Edit Space” modal --}}
    @include('admin.components.modals.view-space-modal')

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Mall Space</h3>
                <h6 class="op-7 mb-0">Space Summary List</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Spaces</h4>
                            <a href="{{ route('space.add.space') }}" class="btn btn-sta ms-auto">
                                <i class="fa fa-plus"></i>
                                Add Spaces
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Space Name</th>
                                        <th class="text-center">Store Type</th>
                                        <th class="text-center">Floor Area</th>
                                        <th class="text-center">Space Code</th>
                                        <th class="text-center">Space Type</th>
                                        <th class="text-center">Space Status</th>
                                        <th class="text-center">Space Tagging</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="spaceList">
                                    {{-- DataTables will populate here --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Success notification if session('status') exists --}}
    @if (session('status'))
        <script>
            $(document).ready(function () {
                $.notify({
                    message: '{{ session('status') }}',
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

    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    {{-- DataTables JS (requires jQuery) --}}
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    {{-- Pusher JS --}}
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <script>
        let dtSpace;

        $(document).ready(function() {
            // Helper: show “N/A” if null/undefined/empty
            function orNA(value) {
                return (value === null || value === undefined || value === '') ? 'N/A' : value;
            }

            // Map space_tag → [label, badgeClass]
            const tagMap = {
                1: ['Available',   'bg-success'],
                2: ['Unavailable', 'bg-warning'],
                3: ['Reserved',    'bg-danger']
            };

            // Initialize DataTable
            dtSpace = $('#multi-filter-select').DataTable({
                processing: false,
                serverSide: false,
                ajax: {
                    url: "{{ route('space.data') }}",
                    dataSrc: ''
                },
                columns: [
                    {
                        data: 'space_name',
                        render: data => orNA(data)
                    },
                    {
                        data: 'store_type',
                        render: data => orNA(data)
                    },
                    {
                        data: 'space_area',
                        render: data => orNA(data) + (data ? ' per sqm' : '')
                    },
                    {
                        data: 'property_code',
                        render: data => orNA(data)
                    },
                    {
                        data: 'space_type',
                        render: data => orNA(data)
                    },
                    {
                        data: 'status',
                        render: val => {
                            if (val === null || val === undefined) {
                                return '<span class="badge bg-secondary">N/A</span>';
                            }
                            return val
                                ? '<span class="badge bg-warning">Occupied</span>'
                                : '<span class="badge bg-success">Available</span>';
                        }
                    },
                    {
                        data: 'space_tag',
                        render: val => {
                            if (val === null || val === undefined) {
                                return '<span class="badge bg-secondary">N/A</span>';
                            }
                            const [label, cls] = tagMap[val] || ['Unknown', 'bg-secondary'];
                            return `<span class="badge ${cls}">${label}</span>`;
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: row => `
                            <button class="btn btn-warning btn-sm space-view" data-spaceid="${row.id}">
                                <i class="fa fa-pen"></i>
                            </button>
                            <button class="btn btn-danger btn-sm deleteSpace" data-spaceid="${row.id}">
                                <i class="fa fa-trash"></i>
                            </button>`
                    }
                ],
                autoWidth: false,
                responsive: true,
                language: {
                    info: "_START_-_END_ of _TOTAL_ spaces",
                    searchPlaceholder: "Search spaces",
                    paginate: {
                        next: '<i class="dw dw-right-chevron"></i>',
                        previous: '<i class="dw dw-left-chevron"></i>'
                    }
                },
                order: [[0, 'asc']]
            });

            // Delegate “Delete” button click
            $('#multi-filter-select').on('click', '.deleteSpace', function() {
                const spaceId = $(this).data('spaceid');
                swal({
                    title: "Are you sure?",
                    text: "You are about to delete a space. This action is irreversible!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '{{ route('space.delete.space') }}',
                            method: 'POST',
                            data: { id: spaceId },
                            success: () => {
                                dtSpace.ajax.reload(null, false);
                                $.notify({
                                    message: "Space deleted successfully",
                                    title: "Success",
                                    icon: "fa fa-bell"
                                }, {
                                    type: 'success',
                                    placement: { from: 'top', align: 'right' },
                                    time: 1000,
                                    delay: 1200
                                });
                            },
                            error: () => {
                                $.notify({
                                    message: "Something went wrong, please try again!",
                                    title: "Error!",
                                    icon: "fa fa-bell"
                                }, {
                                    type: 'danger',
                                    placement: { from: 'top', align: 'right' },
                                    time: 1000,
                                    delay: 1200
                                });
                            }
                        });
                    }
                });
            });

            // Delegate “View/Edit” button click
            $('#multi-filter-select').on('click', '.space-view', function() {
                const spaceId = $(this).data('spaceid');
                $('.modal-body').empty();

                $.ajax({
                    url: "{{ route('space.view.space') }}",
                    data: { space_id: spaceId },
                    type: 'GET',
                    success: response => {
                        const content = `
                        <div class="text-center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5f7JudMO8epnKMScVsWibdWV2Fk53D55dSQ&s"
                                 alt="Space Image"
                                 class="img-fluid rounded w-75 mb-2" />
                        </div>
                        <div class="p-5">
                            <h5 class="modal-title text-center">${response.space_name}</h5>
                            <div class="row mb-3">
                                <div class="col">
                                    <label><strong>Store Type:</strong></label>
                                    <input type="text" class="form-control" value="${response.store_type}" readonly/>
                                </div>
                                <div class="col">
                                    <label><strong>Property Code:</strong></label>
                                    <input type="text" class="form-control" value="${response.property_code}" readonly/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label><strong>Store Area:</strong></label>
                                    <input type="text" class="form-control" value="${response.space_area}" readonly/>
                                </div>
                                <div class="col">
                                    <label><strong>Mall Code:</strong></label>
                                    <input type="text" class="form-control" value="${response.mall_code}" readonly/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label><strong>Building Number:</strong></label>
                                    <input type="text" class="form-control" value="${response.bldg_number}" readonly/>
                                </div>
                                <div class="col">
                                    <label><strong>Unit Number:</strong></label>
                                    <input type="text" class="form-control" value="${response.unit_number}" readonly/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label><strong>Level Number:</strong></label>
                                    <input type="text" class="form-control" value="${response.level_number}" readonly/>
                                </div>
                            </div>
                        </div>`;
                        $('.modal-body').html(content);
                        $('#viewSpaceModal').modal('show');
                    },
                    error: () => {
                        $('.modal-body').html('<p>Error retrieving data. Please try again later.</p>');
                    }
                });
            });

            // Pusher: reload DataTable when a SpaceEvent is broadcast
            Pusher.logToConsole = true;
            const pusher = new Pusher('1eedc3e004154aadb5dc', {
                cluster: 'ap1',
                forceTLS: true
            });
            const channel = pusher.subscribe('space-channel');
            channel.bind('space-updated', () => {
                console.log('Pusher event caught: reloading DataTable');
                dtSpace.ajax.reload(null, false);
            });
        });
    </script>
@endsection
