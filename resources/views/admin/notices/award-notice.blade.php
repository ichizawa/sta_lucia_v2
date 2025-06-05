{{-- resources/views/admin/notices/award-notice.blade.php --}}
@extends('layouts')

@section('content')
    @include('admin.notices.notice-modals.edit-award-notice-modal')
    @include('admin.notices.notice-modals.view-award-files-modal')

    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List of Notices</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="award-notices-table"
                                   class="display table table-striped table-hover w-100"
                                   style="width:100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Company Name</th>
                                        <th class="text-center">Nature of Business</th>
                                        <th class="text-center">Date of Awarding</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- DataTables will populate --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DataTables & Pusher scripts --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <script>
        let dtAward;

        $(document).ready(function () {
            // Display "N/A" when value is null/undefined/empty
            function orNA(value) {
                return (value === null || value === undefined || value === '') ? 'N/A' : value;
            }

            // Map award_notice_status to badge text/color
            function statusBadge(status) {
                switch (parseInt(status, 10)) {
                    case 0:
                        return '<span class="badge bg-warning">Pending</span>';
                    case 2:
                        return '<span class="badge bg-warning">Needs Approval</span>';
                    case 1:
                        return '<span class="badge bg-success">Approved</span>';
                    case 3:
                        return '<span class="badge bg-danger">Rejected</span>';
                    default:
                        return '<span class="badge bg-warning">Pending</span>';
                }
            }
            dtAward = $('#award-notices-table').DataTable({
                processing: false,
                serverSide: false,
                ajax: {
                    url: "{{ route('admin.notices.data') }}",
                    dataSrc: ''
                },
                columns: [
                    {
                        data: 'company_name',
                        className: 'text-center',
                        render: orNA
                    },
                    {
                        data: 'tenant_type',
                        className: 'text-center',
                        render: orNA
                    },
                    {
                        data: 'award_notice_created_at',
                        className: 'text-center',
                        render: orNA
                    },
                    {
                        data: 'award_notice_status',
                        className: 'text-center',
                        render: statusBadge
                    },
                    {
                        data: null,
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                        render: function (row) {
                            // Show "Edit/Approve Notice" button only if award_notice_status === 0 (Pending)
                            let approveButton = '';
                            if (parseInt(row.award_notice_status, 10) === 0) {
                                approveButton = `
                                    <a class="btn btn-sm btn-success approversModal"
                                       data-bs-toggle="modal"
                                       data-approvers='${JSON.stringify(row)}'
                                       data-bs-target="#editAwardNoticeModal">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                `;
                            } else {
                                approveButton = `
                                    <button class="btn btn-sm btn-secondary" disabled>
                                        <i class="fa fa-lock"></i>
                                    </button>
                                `;
                            }

                            // "View Files" is always available
                            let viewFilesButton = `
                                <a class="btn btn-sm btn-warning filesModalTable"
                                   data-bs-toggle="modal"
                                   data-award-data='${JSON.stringify(row)}'
                                   data-bs-target="#viewFilesModal">
                                    <i class="fa fa-eye"></i>
                                </a>
                            `;

                            return approveButton + viewFilesButton;
                        }
                    }
                ],
                order: [[2, 'desc']],
                language: {
                    info: "_START_-_END_ of _TOTAL_ notices",
                    searchPlaceholder: "Search notices",
                    paginate: {
                        next: '<i class="dw dw-right-chevron"></i>',
                        previous: '<i class="dw dw-left-chevron"></i>'
                    }
                }
            });

            // Reload DataTable when AwardNoticeEvent is broadcast
            Pusher.logToConsole = true;
            const pusher = new Pusher('1eedc3e004154aadb5dc', {
                cluster: 'ap1',
                forceTLS: true
            });
            const channel = pusher.subscribe('award-notices');
            channel.bind('award.notice.updated', function() {
                dtAward.ajax.reload(null, false);
            });

            // Handle click on "Edit/Approve Notice" button
            $('#award-notices-table').on('click', '.approversModal', function() {
                let data = $(this).data('approvers');

                // Show/hide footer based on award_notice_status !== 1
                $('#checkFileFooter').toggle(parseInt(data.award_notice_status, 10) !== 1);

                // Populate hidden award_notice_id field
                $('#award_notice_id').val(data.id);

                // Attempt to load PDF
                let pdfFileName = `award_notice_${data.id}.pdf`;
                let filePath = "{{ asset('storage/tenant_documents/') }}/"
                             + data.company_name
                             + "/award_notice/"
                             + pdfFileName;

                $.get(filePath)
                    .done(function () {
                        $('#award-notice-pdf').attr('src', filePath + '#zoom=150');
                    })
                    .fail(function () {
                        $('#award-notice-pdf').attr('src', '');
                    });
            });

            // Show toast if session('modal_open') is set
            @if(session('modal_open'))
                let content = {
                    message: '{{ session('status') }}',
                    title: 'Success',
                    icon: "fa fa-bell"
                };
                $.notify(content, {
                    type: 'success',
                    placement: { from: 'top', align: 'right' },
                    time: 1000,
                    delay: 1200,
                });
            @endif
        });
    </script>
@endsection
