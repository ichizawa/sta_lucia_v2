<style>
    .modal-dialog {
        max-width: 900px;
        margin-top: 10%;
    }

    .modal-content {
        border-radius: 0.5rem;
    }

    .modal-header {
        border-bottom: none;
        padding: 1rem 1.5rem;
    }

    .modal-footer {
        border-top: none;
        padding: 1rem 1.5rem;
    }

    .form-group label {
        font-weight: 500;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }
</style>
<div class="modal fade" id="addCategoriesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Categories</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-category">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Add Category</label>
                                <input type="text" class="form-control" id="add_category" name="name">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" id="submit-new-category" class="btn btn-primary">
                    Add
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#submit-new-category').click(function (e) {
        e.preventDefault();
        var formData = new FormData($('#add-category')[0]);
        $('#addCategoriesModal').empty();
        $.ajax({
            url: "{{ route('submit.category')}}",
            type: 'POST',
            data: formData,
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    reloadDataTable();
                    $('#addCategoriesModal').modal('hide');
                    toastr.success(response.message, 'Success');
                } else {
                    toastr.warning(response.message, 'Warning');
                }
            },
            error: function (xhr, status, error) {
                toastr.error(response.message, 'Error');
            }

        })
    })
</script>