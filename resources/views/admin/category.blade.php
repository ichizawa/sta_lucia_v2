@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Categories</h3>
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
                                        <th>Action</th>
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

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="edit-category-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_category_id" name="id">
                        <div class="form-group">
                            <label for="edit_category_name">Category</label>
                            <input type="text" class="form-control" id="edit_category_name" name="name" required>
                        </div>
                      
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Destroy existing DataTable if it exists
            if ($.fn.DataTable.isDataTable('.category-item')) {
                $('.category-item').DataTable().destroy();
            }

            // Initialize DataTable
            $('.category-item').DataTable({
                processing: true,
                serverSide: true,
                retrieve: true,
                order: [[0, 'asc']],
                ajax: {
                    url: "{{ route('get.category') }}",
                    type: 'GET',
                    dataSrc: 'data',
                    error: function (xhr, status, error) {
                        console.error('DataTables AJAX Error:', xhr.responseText);
                        console.error('Status:', status);
                        console.error('Error:', error);
                    }
                },
                columns: [
                    {
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
                    },
                    {
                        data: null,
                        title: 'Action',
                        className: 'text-center',
                        render: function (data, type, row) {
                            return `
        <div>
            <button class="btn btn-sta btn-sm ms-auto" onclick="openEditCategoryModal(${row.id}, '${row.category_name}')"><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-sm ms-auto" onClick="deleteCategory(${row.id})"><i class="fa fa-trash"></i></button>
        </div>
    `;
                        }
                    }
                ]
            });
        });

        function deleteCategory(id) {
            // console.log(id);
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    $.ajax({
                        url: '{{ route('admin.delete.category') }}',
                        method: 'POST',
                        data: {
                            id: id
                        },
                        success: function (response) {
                            reloadDataTable();
                            var content = {
                                message: "Category deleted successfully",
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
                        },
                        error: function () {
                            toastr.error('An error occurred while deleting the category.');
                        }
                    });
                }
            });
        }

        function reloadDataTable() {
            if ($.fn.DataTable.isDataTable('.category-item')) {
                $('.category-item').DataTable().ajax.reload();
            }
        }

        function openEditCategoryModal(id, name) {
            $('#edit_category_id').val(id);
            $('#edit_category_name').val(name);
            $('#edit_sub_category_name').val(name);
            $('#editCategoryModal').modal('show');
        }

        $('#edit-category-form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: '{{ route('admin.update.category') }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    $('#editCategoryModal').modal('hide');
                    reloadDataTable();
                    var content = {
                        message: "Category updated successfully",
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
                },
                error: function() {
                    toastr.error('An error occurred while updating the category.');
                }
            });
        });

        



    </script>
@endsection