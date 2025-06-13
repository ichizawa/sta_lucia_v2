<style>
.modal-body {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 32px 32px 16px 32px;
}

.modal-title {
    font-size: 1.5rem;
    margin-bottom: 20px;
}

.view-space-img {
    display: block;
    margin: 0 auto 16px auto;
    border-radius: 12px;
    width: 75%;
    max-width: 500px;
    height: auto;
}

.space-name {
    text-align: center;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 24px;
}

.view-space-fields .row {
    margin-bottom: 18px;
}

.view-space-fields label {
    font-weight: 500;
    margin-bottom: 4px;
}

.view-space-fields input {
    background: #fff;
}
</style>
<div class="modal fade" id="viewSpaceModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-0">View Space</h5>
                <!-- <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary editInputs">Edit</button>
                <button type="button" class="btn btn-success saveInputs" style="display:none;">Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    <script>
    // Delegate events to modal for dynamic content
    $(document).on('click', '#viewSpaceModal .editInputs', function() {
        var modal = $('#viewSpaceModal');
        modal.find('.modal-body input').prop('readonly', false);
        modal.find('.editInputs').hide();
        modal.find('.saveInputs').show();
    });

    $(document).on('click', '#viewSpaceModal .saveInputs', function() {
        var modal = $('#viewSpaceModal');
        var spaceId = modal.find('.modal-body').data('spaceid');
        var data = {
            id: spaceId,
            store_type: modal.find('input[name="store_type"]').val(),
            property_code: modal.find('input[name="property_code"]').val(),
            space_area: modal.find('input[name="space_area"]').val(),
            mall_code: modal.find('input[name="mall_code"]').val(),
            bldg_number: modal.find('input[name="bldg_number"]').val(),
            unit_number: modal.find('input[name="unit_number"]').val(),
            level_number: modal.find('input[name="level_number"]').val(),
            _token: '{{ csrf_token() }}'
        };
        $.ajax({
            url: "{{ route('space.update.space') }}",
            type: 'POST',
            data: data,
            success: function(res) {
                $.notify({
                    message: "Space updated successfully",
                    title: "Success!",
                    icon: "fa fa-bell"
                }, {
                    type: 'success',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    time: 1000,
                    delay: 1200
                });

                modal.find('.editInputs').show();
                modal.find('.saveInputs').hide();
                modal.find('.modal-body input').prop('readonly', true);
                // Fix: Reload the page instead of DataTable AJAX reload
                // location.reload();
            },
            error: function() {
                $.notify({
                    message: "Update failed. Please try again.",
                    title: "Error!",
                    icon: "fa fa-bell"
                }, {
                    type: 'danger',
                    placement: {
                        from: 'top',
                        align: 'right'
                    },
                    time: 1000,
                    delay: 1200
                });
            }
        });
    });

    // Render modal content dynamically
    window.renderViewSpaceModal = function(response, spaceId) {
        var content = `
                <div class="text-center">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5f7JudMO8epnKMScVsWibdWV2Fk53D55dSQ&s" alt="Space Image" class="img-fluid view-space-img" />
                </div>
                <div class="space-name">${response.space_name}</div>
                <div class="view-space-fields">
                    <div class="row mb-3">
                        <div class="col">
                            <label><strong>Store Type:</strong></label>
                            <input type="text" class="form-control" name="store_type" value="${response.store_type}" readonly />
                        </div>
                        <div class="col">
                            <label><strong>Property Code:</strong></label>
                            <input type="text" class="form-control" name="property_code" value="${response.property_code}" readonly />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label><strong>Store Area:</strong></label>
                            <input type="text" class="form-control" name="space_area" value="${response.space_area}" readonly />
                        </div>
                        <div class="col">
                            <label><strong>Mall Code:</strong></label>
                            <input type="text" class="form-control" name="mall_code" value="${response.mall_code}" readonly />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label><strong>Building Number:</strong></label>
                            <input type="text" class="form-control" name="bldg_number" value="${response.bldg_number}" readonly />
                        </div>
                        <div class="col">
                            <label><strong>Unit Number:</strong></label>
                            <input type="text" class="form-control" name="unit_number" value="${response.unit_number}" readonly />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label><strong>Level Number:</strong></label>
                            <input type="text" class="form-control" name="level_number" value="${response.level_number}" readonly />
                        </div>
                    </div>
                </div>
            `;
        var modalBody = $('#viewSpaceModal .modal-body');
        modalBody.html(content);
        modalBody.attr('data-spaceid', spaceId);
    }
    </script>
</div>