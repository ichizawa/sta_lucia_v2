{{-- resources/views/admin/leases/leases-information.blade.php --}}
@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Mall Leasable Information</h3>
                <h6 class="op-7 mb-2">Space Overview</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Leasable Information</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {{-- Add style="width:100%" here so the table always fills its parent --}}
                            <table
                                id="multi-filter-select"
                                class="display table table-striped table-hover"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Space Name</th>
                                        <th class="text-center">Space Type</th>
                                        <th class="text-center">Floor Area</th>
                                        <th class="text-center">Store Type</th>
                                        <th class="text-center">Assigned To</th>
                                        <th class="text-center">Availability</th>
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
    @include('admin.components.modals.view-leasable-info')
    @include('admin.components.modals.edit-leasable-info')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <script>
        Pusher.logToConsole = true;
        $(document).ready(function () {
            function capitalize(str) {
                if (!str) return '';
                return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
            }
            let dtSpace = $('#multi-filter-select').DataTable({
                processing: false,
                serverSide: false,
                responsive: true,
                autoWidth: false,

                ajax: {
                    url: "{{ route('leases.mall.leases') }}",
                    dataSrc: ''
                },
                columns: [
                    {
                        data: 'space_name',
                        className: 'text-center',
                        render: d => capitalize(d)
                    },
                    {
                        data: 'space_type',
                        className: 'text-center',
                        render: d => capitalize(d)
                    },
                    {
                        data: 'space_area',
                        className: 'text-center'
                    },
                    {
                        data: 'store_type',
                        className: 'text-center',
                        render: d => capitalize(d)
                    },
                    {
                        data: 'owner_id',
                        className: 'text-center',
                        render: function (owner_id, type, row) {
                            if (!owner_id) {
                                return 'Not Assigned';
                            }
                            let fname = capitalize(row.rep_fname);
                            let lname = capitalize(row.rep_lname);
                            return fname + ' ' + lname;
                        }
                    },
                    {
                        data: 'status',
                        className: 'text-center',
                        render: function (d) {
                            return d
                                ? '<span class="badge bg-secondary">Unavailable</span>'
                                : '<span class="badge bg-success">Available</span>';
                        }
                    }
                ],
                order: [[2, 'desc']]
            });
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
