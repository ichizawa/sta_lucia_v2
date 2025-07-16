@extends('layouts')

@section('content')
    @include('admin.components.modals.view-space-modal')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Mall Space</h3>
                <h6 class="op-7 mb-0">Space Summary List</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Spaces</h4>
                            <a href="{{ route('lease.add.space') }}" class="btn btn-sta ms-auto">
                                <i class="fa fa-plus"></i>
                                Add Spaces
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Space Name</th>
                                        <th class="text-center">Space Type</th>
                                        <th class="text-center">Floor Area</th>
                                        <th class="text-center">Space Code</th>
                                        <th class="text-center">Store Type</th>
                                        <th class="text-center">Space Option</th>
                                        <th class="text-center">Space Status</th>
                                        <th class="text-center">Space Tagging</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="spaceList">
                                    @foreach ($all as $space)
                                        <tr>
                                            <td class="text-center">{{ ucwords($space->space_name) }}</td>
                                            <td class="text-center">{{ $space->store_type }}</td>
                                            <td class="text-center">{{ $space->space_area }} per sqm</td>
                                            <td class="text-center">{{ $space->property_code }}</td>
                                            <td class="text-center">{{ $space->store_type }}</td>
                                            <td class="text-center">{{ $space->space_type }}</td>
                                            <td class="text-center">
                                                <span class="badge {{ $space->status ? 'bg-warning' : 'bg-success' }}">
                                                    {{ $space->status ? 'Occupied' : 'Available' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $tags = [
                                                        1 => ['Available', 'bg-success'],
                                                        2 => ['Unavailable', 'bg-warning'],
                                                        3 => ['Reserved', 'bg-danger'],
                                                    ];
                                                    [$tagLabel, $tagClass] = $tags[$space->space_tag] ?? ['Unknown', 'bg-secondary'];
                                                @endphp
                                                <span class="badge {{ $tagClass }}">{{ $tagLabel }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-warning btn-sm space-view" data-spaceid="{{ $space->id }}">
                                                    <i class="fa fa-pen" aria-hidden="true"></i>
                                                </a>
                                                <a class="btn btn-danger btn-sm" onClick="deleteSpace({{ $space->id }})"
                                                    data-spaceid="{{ $space->id }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
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
            $(document).ready(function () {
                var content = {
                    message: '{{ session('status') }}',
                    title: 'Success',
                    icon: "fa fa-bell"
                };

                $.notify(content, {
                    type: 'success',
                    placement: {
                        from: 'top',
                        align: 'right',
                    },
                    time: 1000,
                    delay: 1200,
                });
            });
        </script>
    @endif
    <script>
        function deleteSpace(spaceId) {
    swal({
        title: "Are you sure?",
        text: "You're about to delete a space. This action is irreversible!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: '{{ route('lease.delete.space') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: spaceId
                },
                success: function (response) {
                    // $('#multi-filter-select').DataTable().row($(`button[data-space-id="${spaceId}"]`).parents('tr')).remove();
                    $.notify({
                        message: "Space deleted successfully",
                        title: "Success!",
                        icon: "fa fa-bell"
                    }, {
                        type: 'success',
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        delay: 1200
                    });
                    $(`a[onClick="deleteSpace(${spaceId})"]`).closest('tr').remove();
                },
                error: function (xhr) {
                    console.error("Error response:", xhr.responseText);

                    $.notify({
                        message: "Something went wrong, please try again!",
                        title: "Error!",
                        icon: "fa fa-bell"
                    }, {
                        type: 'danger',
                        placement: {
                            from: 'top',
                            align: 'right'
                        },
                        delay: 1200
                    });
                }
            });
        }
    });
}


        $(".space-view").on('click', function () {
            var spaceId = $(this).data('spaceid');
            $('.modal-body').empty();
            $.ajax({
                url: "{{ route('lease.view.space') }}",
                data: {
                    space_id: spaceId,
                },
                type: 'GET',
                success: function (response) {
                    var content = `
                    <div class="text-center ">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5f7JudMO8epnKMScVsWibdWV2Fk53D55dSQ&s" alt="Space Image" class="img-fluid rounded w-75 mb-2" />
                    </div>

                    <div class="p-5">
                            <h5 class="modal-title text-center">${response.space_name}</h5>
                            <div class="row mb-3">
                                <div class="col">
                                    <label><strong>Store Type:</strong></label>
                                    <input type="text" class="form-control" value="${response.store_type}" readonly/>
                                </div>
                                <div class="col">

                                    <label><strong>Property Code:</strong></label>
                                    <input type="text" class="form-control" value="${response.property_code}" readonly/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label><strong>Store Area:</strong></label>
                                    <input type="text" class="form-control" value="${response.space_area}" readonly/>
                                </div>
                                <div class="col">
                                    <label><strong>Mall Code:</strong></label>
                                    <input type="text" class="form-control" value="${response.mall_code}" readonly/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">

                                    <label><strong>Building Number:</strong></label>
                                    <input type="text" class="form-control" value="${response.bldg_number}" readonly/>
                                </div>
                                <div class="col">
                                    <label><strong>Unit Number:</strong></label>
                                    <input type="text" class="form-control" value="${response.unit_number}" readonly/>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label><strong>Level Number:</strong></label>
                                    <input type="text" class="form-control" value="${response.level_number}" readonly/>
                                </div>
                            </div>
                        </div>
                    `;
                    $('.modal-body').html(content);
                    $('#viewSpaceModal').modal('show');

                    $('.editInputs').click(function () {
                        $('.col').find('input').prop('readonly', false);
                        $('.editInputs').prop('hidden', true);
                        $('.saveInputs').prop('hidden', false);
                    });

                    $('.saveInputs').click(function () {
                        $('.col').find('input').prop('readonly', true);
                        $('.editInputs').prop('hidden', false);
                        $('.saveInputs').prop('hidden', true);
                        let spaceId = $('.space-view').data('spaceid');
                        let formData = $('.modal-body').find('input').serialize();
                        
                    });
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    $('.modal-body').html('<p>Error retrieving data. Please try again later.</p>');
                }
            });
        });
    </script>
@endsection