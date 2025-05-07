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
<div class="modal fade" id="addSubCategoriesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header brown-border-top">
                <h5 class="modal-title">Categories</h5>
                <button type="button" class="btn btn-outline-secondary" id="add-subcategory">Add Another
                    Sub-Category</button>
            </div>
            <div class="modal-body">
                <div id="add-category">
                    <div class="row">
                        <div class="col">
                            <form id="form-sub-category">
                                <div class="form-group">
                                    <label for="select_category">Select Category</label>
                                    <select class="form-select form-control" name="category" id="select_category">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="subcategory-container">
                                    <div class="form-group">
                                        <label for="sub_category_1">Add Sub-Category</label>
                                        <input type="text" class="form-control" id="sub_category_1"
                                            name="sub_categories[]">
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" id="submit-new-sub-category" class="btn btn-sta">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let subCategoryCounter = 1;

        $('#add-subcategory').click(function() {
            subCategoryCounter++;
            const newSubCategoryField = `
            <div class="form-group">
                <label for="sub_category_${subCategoryCounter}">Add Sub-Category</label>
                <input type="text" class="form-control" id="sub_category_${subCategoryCounter}" name="sub_categories[]">
            </div>
        `;
            $('#subcategory-container').append(newSubCategoryField);
        });

        $("#submit-new-sub-category").click(function() {

            var formData = new FormData($("#form-sub-category")[0])
            $.ajax({
                url: "{{ route('submit.sub.category') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    toastr.success(data.message, 'Success');
                    reloadDataTable();
                    $('#addSubCategoriesModal').modal('hide');
                },
                error: function(data) {
                    console.log(data);
                }
            })
        });
    });
</script>
