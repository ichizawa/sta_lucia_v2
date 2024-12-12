@extends('layouts')

@section('content')
@include('admin.space.space-modals.add-level-modal')
@include('admin.space.space-modals.edit-level-modal')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Level Numbers</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">List of Level Numbers</h4>
                        <a data-bs-toggle="modal" data-bs-target="#addLevelModal" class="btn btn-sta ms-auto">
                            <i class="fa fa-plus"></i>
                            Add Level Numbers
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Mall Number</th>
                                    <th>Building Number</th>
                                    <th>Level Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($levelCode as $levels)
                                <tr>
                                    <td>{{ $levels->mallnum }}</td>
                                    <td>{{ $levels->bldgnum }}</td>
                                    <td>{{ $levels->lvlnum }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-warning editspecificLevels"
                                            data-level-id="{{ $levels->lvlnumid }}" data-bs-toggle="modal"
                                            data-bs-target="#editLevelModal">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger deletespecificLevels"
                                            data-level-id="{{ $levels->lvlnumid }}">
                                            <i class="fa fa-trash"></i>
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
<script>
    $(document).ready(function() {
        $('.deletespecificLevels').click(function(e) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this level!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '{{ route('space.delete.level', 'level') }}',
                        type: "POST",
                        data: {
                            id: $(this).data('level-id'),
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            toastr.success('Level successfully marked as deleted.');
                            location.reload();
                        },
                        error: function() {
                            swal("Error", "Unable to delete the level.", "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endsection