@extends('layouts')

@section('content')
    @include('admin.space.space-modals.add-building-modal')
    @include('admin.space.space-modals.edit-building-modal')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Building Number</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Building Numbers</h4>
                            <a data-bs-toggle="modal" data-bs-target="#addBuildingModal" class="btn btn-sta ms-auto">
                                <i class="fa fa-plus"></i>
                                Add Building Number
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Mall Name</th>
                                        <th class="text-center">Building Number</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($buildingCode as $building)
                                        <tr>
                                            <td class="text-center">{{ $building->mallcodes->mallname }}</td>
                                            <td class="text-center">{{ $building->bldgnum }}</td>
                                            <td>
                                                <div class="d-flex gap-3 justify-content-center">
                                                    <a class="btn btn-sm btn-warning editBuilding"
                                                        data-building-uid="{{ $building->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#editBuildingModal">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-danger deleteBuilding"
                                                        data-building-uid="{{ $building->id }}">
                                                        <i class="fa fa-trash"></i>
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
        $(document).ready(function() {
            $('.deleteBuilding').click(function() {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this building code!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '{{ route('space.delete.building', 'building') }}',
                            method: 'POST',
                            data: {
                                id: $(this).data('building-uid'),
                            },
                            success: function(response) {
                                toastr.success('Building code deleted successfully.');
                                location.reload();
                            },
                            error: function() {
                                toastr.error(
                                    'An error occurred while deleting the building code.'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
