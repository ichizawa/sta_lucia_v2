@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Categories</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Category</h4>
                            <div>
                                <a data-bs-toggle="modal" data-bs-target="#addCategoriesModal" class="btn btn-sta ms-auto">
                                    <i class="fa fa-plus"></i>
                                    Add Category
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#addSubCategoriesModal"
                                    class="btn btn-sta ms-auto">
                                    <i class="fa fa-plus"></i>
                                    Add Sub-Category
                                </a>

                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover category-item">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Sub Category Name</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.components.modals.categories')
    @include('admin.components.modals.add-subcategories-modal')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script>
        // Pusher.logToConsole = true;
        var pusher = new Pusher('0e1b160ee99a4bd8a3b0', {
            cluster: 'ap1'
        });
        var channel = pusher.subscribe('category-channel');
        channel.bind('CategoryUpdated', function(data) {
            if ($.fn.DataTable.isDataTable('.category-item')) {
                $('.category-item').DataTable().ajax.reload();
            }
        });

        $(document).ready(function() {
            // Destroy existing DataTable if it exists
            if ($.fn.DataTable.isDataTable('.category-item')) {
                $('.category-item').DataTable().destroy();
            }

            // Initialize DataTable
            $('.category-item').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                ajax: {
                    url: "{{ route('get.category') }}",
                    type: 'GET',
                    dataSrc: 'data',
                    error: function(xhr, status, error) {
                        console.error('DataTables AJAX Error:', xhr.responseText);
                        console.error('Status:', status);
                        console.error('Error:', error);
                    }
                },
                columns: [{
                        data: 'category_name',
                        name: 'category_name',
                        title: 'Category',
                        className: 'text-center'
                    },
                    {
                        data: 'subcategory_names',
                        name: 'subcategory_names',
                        title: 'Subcategories',
                        className: 'text-center'

                    }
                ]
            });
        });

        function reloadDataTable() {
            if ($.fn.DataTable.isDataTable('.category-item')) {
                $('.category-item').DataTable().ajax.reload();
            }
        }
    </script>
@endsection
