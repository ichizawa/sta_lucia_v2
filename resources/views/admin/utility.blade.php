@extends('layouts')

@section('content')
    <div class="page-inner">

        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Utility</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Add Utility</h4>

                            <a data-bs-toggle="modal" data-bs-target="#addUtilityModalAdmin" class="btn btn-sta ms-auto">
                                <i class="fa fa-plus"></i>
                                Add Utilities
                            </a>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Utility Type</th>
                                        <th class="text-center">Utility Description</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($all as $utility)
                                        <tr>
                                            <td class="text-center">{{ $utility->utility_type }}</td>
                                            <td class="text-center">{{ $utility->utility_description }}</td>
                                            <td class="text-center">{{ $utility->utility_price }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-sta ms-auto">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <a class="btn btn-sm btn-danger ms-auto deleteBTN" data-id="{{ $utility->id }}">
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
    @include('admin.components.modals.add-utility-modal')
    @include('admin.components.modals.utility-modal')
    {{-- @include('admin.components.modals.utility-reading') --}}
    @if (session('success'))
        <script>
            $(document).ready(function () {
                var content = {
                    'testing',
                    message: "{{ session('success ') }}",
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
        function deleteUtility(id) {
            swal("Deleting Utility!", "Are you sure you want to delete this utility?", "danger");
        }

        $(document).ready(function () {
            // $('#addBtn').on('click', function (e) {
            //     e.preventDefault();
            //     let isValid = true;
            //     $('.custom-datalist').removeClass('input-error');
            //     toastr.clear();
            //     $('#utilityReadingsForm .custom-datalist').each(function () {
            //         if (!$(this).val().trim()) {
            //             $(this).addClass('input-error');
            //             isValid = false;
            //         }
            //     });
            //     if (!isValid) {
            //         toastr.error('Please fill out all required fields.');
            //         return;
            //     }
            //     var formData = new FormData($('#utilityReadingsForm')[0]);
            //     $.ajax({
            //         url: '',
            //         method: 'POST',
            //         data: formData,
            //         processData: false,
            //         contentType: false,
            //         success: function (response) {
            //             toastr.success('Form submitted successfully.');
            //             $('#addRowModal').modal('hide');
            //             $('#utilityReadingsForm')[0].reset();
            //         },
            //         error: function () {
            //             toastr.error('An error occurred while submitting the form.');
            //         }
            //     });
            // });

            $('.deleteBTN').click(function () {
                // console.log($(this).data('id'));
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this utility!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: '{{ route('admin.delete.utility') }}',
                                method: 'POST',
                                data: {
                                    id: $(this).data('id')
                                },
                                success: function (response) {
                                    toastr.success('Utility deleted successfully.');
                                    location.reload();
                                },
                                error: function () {
                                    toastr.error(
                                        'An error occurred while deleting the utility.');
                                }
                            });
                        }
                    });
            });
        });
    </script>
@endsection