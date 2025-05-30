@extends('layouts')
@section('content')
    @include('admin.notices.notice-modals.edit-award-notice-modal')
    @include('admin.notices.notice-modals.view-award-files-modal')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Award Notices</h3>
                <h6 class="op-7 mb-0 mb-3">Award Notice Summary List</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Notices</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
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
                                    @foreach ($notices as $notice)
                                        <tr>
                                            <td class="text-center">{{ $notice->company_name }}</td>
                                            <td class="text-center">{{ $notice->tenant_type }}</td>
                                            <td class="text-center">
                                                {{ date('F j, Y', strtotime($notice->award_notice_created_at)) }}</td>
                                            <td class="text-center">
                                                {!! $notice->award_notice_status == 1
                                                    ? '<span class="badge bg-success">Approved</span>'
                                                    : ($notice->award_notice_status == 2
                                                        ? '<span class="badge bg-warning">For Approval</span>'
                                                        : ($notice->award_notice_status == 3
                                                            ? '<span class="badge bg-warning">Rejected</span>'
                                                            : '<span class="badge bg-danger">Pending</span>')) !!}
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-success approversModal" data-bs-toggle="modal"
                                                    data-approvers="{{ $notice }}"
                                                    data-bs-target="#editAwardNoticeModal">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <a class="btn btn-sm btn-warning filesModalTable" data-bs-toggle="modal"
                                                    data-award-data="{{ $notice }}" data-bs-target="#viewFilesModal">
                                                    <i class="fa fa-eye"></i>
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
    @if (session('status'))
        <script>
            $(document).ready(function() {
                var content = {
                    message: '{{ session('status') ? 'File Uploaded Successfully' : 'File Cannot be Uploaded' }}',
                    title: '{{ session('status') ? 'Success' : 'Warning' }}',
                    icon: "fa fa-bell"
                }

                $.notify(content, {
                    type: '{{ session('status') ? 'success' : 'warning' }}',
                    placement: {
                        from: 'top',
                        align: 'right',
                    },
                    time: 1000,
                    delay: 1200,
                })
            })
        </script>
    @endif
@endsection
