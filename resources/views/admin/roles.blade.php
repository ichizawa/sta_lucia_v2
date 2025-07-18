@extends('layouts')

@include('admin.components.modals.add-roles-modal')
@include('admin.components.modals.edit-role-modal')


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
                    <button href="#" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="btn btn-sta ms-auto">
                        <i class="fa fa-plus"></i>
                        Add Roles
                    </button>
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
                            @foreach ($roles as $role)
                            <tr>
                                <!-- Role Name -->
                                <td class="text-center">
                                    {{ ucfirst($role->name) }}
                                </td>
                                <!-- Role Type -->
                                <td>
                                    {{ $role->type }}
                                </td>
                                
                                <td class="text-center">
                                    <!-- Edit Button-->
                                    <a class="btn btn-sm btn-success editRolesBTN"
                                    data-role='@json($role)'
                                    data-bs-toggle="modal"
                                    data-bs-target="#editRoleModal">
                                    <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <a class="btn btn-sm btn-danger deleteRoleTypeBTN"
                                                        data-id="{{ $role->id }}"><i class="fa fa-trash"></i></a>
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


    @if (session('success'))
        <script>
            $(document).ready(function() {
                var content = {
                    message: '{{ session('success') }}',
                    title: 'Success',
                    icon: "fa fa-bell"
                }

                $.notify(content, {
                    type: "success",
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