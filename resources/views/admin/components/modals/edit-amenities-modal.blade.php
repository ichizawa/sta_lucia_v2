<div class="modal fade" id="editAmenityModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="editAmenityForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="amenity_id" name="amenity_id" />
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold"> Update</span>
                        <span class="fw-light"> Amenity </span>
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <p class="small">
                    Create a new row using this form, make
                    sure you fill them all
                </p> -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Amenity Name</label>
                                <input type="text" id="amenity_name" name="amenity_name" class="form-control"
                                    placeholder="Amenity Name" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" id="addRowButton" class="btn btn-md btn-sta">
                        Update
                    </button>
                    <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.editAmenitiesBTN').click(function() {
            var amenities = $(this).data('amenity');
            $('#amenity_name').val(amenities.amenity_name);
            $('#amenity_id').val(amenities.id);
            $('#editAmenityForm').attr('action', '/admin/amenities/' + amenities.id);
        });
    });
</script>