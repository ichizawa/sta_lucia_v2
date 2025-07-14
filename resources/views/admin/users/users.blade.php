@extends('layouts')
@include('admin.users.users-modal.add-user-modal')
@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Users</h3>
                <h6 class="op-7 mb-2">Users Overview</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <!-- <h4 class="card-title">Ceo / President / Owner</h4> -->
                            <button class="btn btn-sta ms-auto" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                <i class="fa fa-plus"></i>
                                Add Users
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Phone Number</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tenant-show-table">
                                    @foreach ($users->sortBy('type') as $user)
                                        <tr>
                                            <td class="text-center">
                                                {{ $user->name }}
                                            </td>
                                            <td class="text-center">
                                                {{ $user->username }}
                                            </td>
                                            <td class="text-center">
                                                {{ $user->address }}
                                            </td>
                                            <td class="text-center">
                                                {{ $user->phone }}
                                            </td>
                                            <td class="text-center">
                                                {{ $user->email }}
                                            </td>
                                            <td class="text-center">
                                                {{ ucfirst($user->type) }}
                                            </td>
                                            <td class="text-center">
                                                @if ($user->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <a class="btn btn-warning btn-sm view_user" {{--
                                                        data-owner-id="{{ $company->owner_id }}"
                                                        data-company-name="{{ $company->company_name }}"
                                                        data-tenant-type="{{ $company->tenant_type }}" data-bs-toggle="modal"
                                                        data-docu-status="{{ $owner->doc_status }}"
                                                        data-bs-target="#tenantDocuments" --}}>
                                                        <i class="fa fa-pen" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm deleteTenant" {{--
                                                        onClick="delete_tenant_func()" --}}>
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </div>
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
    <script>
        $(document).ready(function () {
            $('multi-filter-select').DataTable({});
        });
    </script>
    
    @if (session('success'))
    <script>
        $(document).ready(function () {
            var content = {
                message: '{{ session('success') }}',
                title: 'Success',
                icon: 'fa fa-check'
            };

            $.notify(content, {
                type: 'success',
                placement: {
                    from: 'top',
                    align: 'right',
                },
                delay: 2500,
                timer: 1000,
                z_index: 9999,
            });
        });
    </script>
@endif


@endsection