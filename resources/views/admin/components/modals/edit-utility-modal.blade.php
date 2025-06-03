<div class="modal fade" id="editUtilityModalAdmin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editUtilityForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="utility_id" id="edit_utility_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Utility</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Utility Name</label>
                        <input type="text" class="form-control" id="edit_utility_name" name="utility_name">
                    </div>
                    <div class="form-group">
                        <label>Utility Type</label>
                        <input type="text" class="form-control" id="edit_utility_type" name="utility_type">
                    </div>
                    <div class="form-group">
                        <label>Utility Description</label>
                        <input type="text" class="form-control" id="edit_utility_description" name="utility_description">
                    </div>
                    <div class="form-group">
                        <label>Utility Price</label>
                        <input type="number" class="form-control" id="edit_utility_price" name="utility_price">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Utility</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.editUtilityBTN').click(function() {
        $('#edit_utility_id').val($(this).data('id'));
        $('#edit_utility_name').val($(this).data('utility_name'));
        $('#edit_utility_type').val($(this).data('utility_type'));
        $('#edit_utility_description').val($(this).data('utility_description'));
        $('#edit_utility_price').val($(this).data('utility_price'));
        $('#editUtilityForm').attr('action', '/admin/utilities/' + $(this).data('id'));
    });
});
</script>
