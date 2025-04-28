@extends('layouts')

@section('content')
    @include('admin.space.space-modals.add-mall-modal')
    @include('admin.space.space-modals.edit-mall-modal')
    <!-- <style>
                        #basic-datatables_previous a,
                        #basic-datatables_next a {
                            background-color: red ! important;
                            border: blue 1px solid ! important;
                        }
                    </style> -->
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Mall Codes</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Mall Codes</h4>
                            <a data-bs-toggle="modal" data-bs-target="#addMallModal" class="btn btn-sta ms-auto">
                                <i class="fa fa-plus"></i>
                                Add Mall Codes
                            </a>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Mall Code</th>
                                        <th class="text-center">Mall Name</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($mallCode as $malls)
                                        <tr>
                                            <td class="text-center">{{ $malls->mallnum }}</td>
                                            <td class="text-center">{{ $malls->mallname }}</td>
                                            <td>
                                                <div class="d-flex gap-3 justify-content-center">
                                                    <button data-bs-toggle="modal" data-mall-id="{{ $malls->id }}"
                                                        data-bs-target="#editMallModal"
                                                        class="btn btn-sm btn-warning editMall">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button data-bs-toggle="modal" data-mall-id="{{ $malls->id }}"
                                                        class="btn btn-sm btn-danger deleteMall">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
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
        $(document).ready(function() {
            $('.deleteMall').click(function() {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this mall code!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '{{ route('space.delete.mall', 'mall') }}',
                            method: 'POST',
                            data: {
                                id: $(this).data('mall-id'),
                            },
                            success: function(response) {
                                // toastr.success('Mall code deleted successfully.');
                                location.reload();
                            },
                            error: function() {
                                toastr.error(
                                    'An error occurred while deleting the mall code.'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
