@extends('layouts')

@section('content')
<!--  -->
@include('admin.components.modals.add-amenities-modal')
@include('admin.components.modals.edit-amenities-modal')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Amenities</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">List of Amenities</h4>
                        <button class="btn btn-sta ms-auto" data-bs-toggle="modal" data-bs-target="#addAmenities">
                            <i class="fa fa-plus"></i>
                            Add Amenities
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi-filter-select" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Amenities Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all as $amenity)
                                    <tr>
                                        <td>
                                            {{ ucfirst($amenity->amenity_name) }}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-success editAmenitiesBTN" data-amenity="{{ $amenity }}" data-bs-toggle="modal" data-bs-target="#editAmenityModal"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger deleteBTN" data-id="{{ $amenity->id }}"><i class="fa fa-trash"></i></a>
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
@if (session('success'))
    <script>
        $(document).ready(function () {
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
<script>
    $('.deleteBTN').on('click', function() {
        var id = $(this).data('id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this amenity!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{ route('admin.delete.amenities') }}",
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        swal("Poof! Your amenities has been deleted!", {
                            icon: "success",
                        }).then(() => {
                            location.reload(); 
                        });
                    },
                    error: function(xhr, status, error) {
                        swal("Error deleting ameninities", {
                            icon: "error",
                        });
                    }
                });
            } else {
                swal("Your amenity is safe!");
            }
        });
    });
</script>
@endsection