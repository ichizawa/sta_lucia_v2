@extends('layouts')

@section('content')
@include('admin.components.modals.view-space-modal')
<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Space</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Space</h4>
                        <a href="{{ route('space.add.space') }}" class="btn btn-sta ms-auto">
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
                                    <th>Space Name</th>
                                    <th>Space Type</th>
                                    <th>Floor Area</th>
                                    <th>Space Code</th>
                                    <th>Store Type</th>
                                    <th>Space Option</th>
                                    <th>Space Status</th>
                                    <th>Space Tagging</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="spaceList">
                                @foreach ($all as $spaces)
                                    <tr>
                                        <td>{{ ucwords($spaces->space_name) }}</td>
                                        <td>{{ $spaces->store_type }}</td>
                                        <td>{{ $spaces->space_area }} per sqm</td>
                                        <td>{{ $spaces->property_code }}</td>
                                        <td>{{ $spaces->store_type }}</td>
                                        <td>{{ $spaces->space_type }}</td>
                                        <td>{!! $spaces->status ? '<span class="badge bg-warning">Unavailable</span>' : '<span class="badge bg-success">Available</span>' !!} </td>
                                        <td>{!! $spaces->space_tag == 1 ? '<span class="badge bg-success">Available</span>' : ($spaces->space_tag == 2 ? '<span class="badge bg-warning">Unavailable</span>' : '<span class="badge bg-danger">Reserved</span>') !!} </td>
                                        <td>
                                            <a class="btn btn-warning btn-sm space-view"
                                                data-spaceid="{{$spaces->id}}">
                                                <i class="fa fa-pen" aria-hidden="true"></i>
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
    // $('#multi-filter-select').DataTable({});

    $(".space-view").on('click', function () {
        var spaceId = $(this).data('spaceid');
        $('.modal-body').empty();
        $.ajax({
            url: "{{ route('space.view.space') }}",
            data: {
                space_id: spaceId,
            },
            type: 'GET',
            success: function (response) {
                var content = `
            <div class="text-center ">
               <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5f7JudMO8epnKMScVsWibdWV2Fk53D55dSQ&s" alt="Space Image" class="img-fluid rounded w-75 mb-2" />
           </div>
                <h5 class="modal-title text-center mt-4">${response.space_name}</h5>
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
            `;
                $('.modal-body').html(content);
                $('#viewSpaceModal').modal('show');

                $('.editInputs').click(function() {
                    $('.col').find('input').prop('readonly', false);
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