@extends('layouts')

@section('content')
    <div class="page-inner">

        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Roles</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Add Roles</h4>

                            <a href="#" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                                class="btn btn-sta ms-auto">
                                <i class="fa fa-plus"></i>
                                Add Roles
                            </a>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Coco Martin</td>
                                        <td>Biller</td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-success approversModal" data-bs-toggle="modal">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a class="btn btn-sm btn-warning filesModalTable" id="deleteRole"
                                                data-bs-toggle="modal">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alden Richards</td>
                                        <td>Admin</td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-success approversModal" data-bs-toggle="modal">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a class="btn btn-sm btn-warning filesModalTable" id="deleteRole"
                                                data-bs-toggle="modal">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daniel Padilla</td>
                                        <td>Super Admin</td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-success approversModal" data-bs-toggle="modal">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a class="btn btn-sm btn-warning filesModalTable" id="deleteRole"
                                                data-bs-toggle="modal">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.components.modals.add-roles-modal')
@endsection
