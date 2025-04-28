@extends('layouts')

@section('content')
    @include('admin.charge.charge-modal.edit-charge-modal')
    @include('admin.components.modals.add-charges-modal')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Charges</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Charges</h4>
                            <button class="btn btn-sta ms-auto" data-bs-toggle="modal" data-bs-target="#addChargesModal">
                                <i class="fa fa-plus"></i>
                                Add Charges
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Charge Name</th>
                                        <th class="text-center">Charge Fee</th>
                                        <th class="text-center">Frequency</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($all as $charges)
                                        <tr>
                                            <td class="text-center">{{ $charges->charge_name }}</td>
                                            <td class="text-center">{{ $charges->charge_fee }}</td>
                                            <td class="text-center">{{ $charges->frequency }}</td>
                                            <td>
                                                <div class="d-flex  gap-3 justify-content-center">
                                                    <a class="btn btn-sm btn-warning editCharge" data-bs-toggle="modal"
                                                        data-bs-target="#editChargeModal"
                                                        data-charges="{{ $charges }}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-danger deleteCharge"
                                                        data-charge-id="{{ $charges->id }}">
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
    @if (session('success'))
        <script>
            $(document).ready(function() {
                var content = {
                    message: '{{ session('
                                                                                                                                                                                                success ') }}',
                    title: "Success",
                    icon: "fa fa-bell"
                };

                $.notify(content, {
                    type: 'success',
                    placement: {
                        from: 'top',
                        align: 'right',
                    },
                    time: 1000,
                    delay: 1500,
                });
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('.deleteCharge').click(function() {
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this charge!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '{{ route('admin.delete.charges') }}',
                            method: 'POST',
                            data: {
                                id: $(this).data('charge-id')
                            },
                            success: function(response) {
                                toastr.success('Charge deleted successfully.');
                                location.reload();
                            },
                            error: function() {
                                toastr.error(
                                    'An error occurred while deleting the charge.');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
