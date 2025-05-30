<div class="modal fade" id="editMallModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="editMallForm" action="{{ route('space.option.space', 'submitMall') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header brown-border-top">
                    <h5 class="modal-title">Edit Mall Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="mallListCodes" class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Mall Codes</label>
                                            <input type="text" class="form-control" id="mall_code" name="mall_code"
                                                placeholder="Enter Mall Code" />
                                            <input type="text" class="form-control" id="mall_id" name="mall_id"
                                                hidden />
                                        </div>
                                        <div class="col-md-6">
                                            <label>Mall Name</label>
                                            <input type="text" class="form-control" id="mall_name" name="mall_name"
                                                placeholder="Enter Mall Name" />
                                        </div>
                                        <div class="col-md-12">
                                            <label>Mall Address</label>
                                            <input type="text" class="form-control" id="mall_address"
                                                name="mall_address" placeholder="Enter Mall Address" required />
                                        </div>
                                        <div class="col-md-12">
                                            <label>Mall Facilities</label>
                                            <textarea class="form-control" id="mall_facility" name="mall_facility" rows="5"
                                                placeholder="Enter Mall Facilities"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Total Area of Mall</label>
                                            <input type="text" class="form-control" id="total_area" name="total_area"
                                                placeholder="Total Area" readonly />
                                        </div>
                                        <div class="col-md-12">
                                            <label>Total Available Area</label>
                                            <input type="text" class="form-control" id="total_available"
                                                name="total_available" placeholder="Total Available Area" readonly />
                                        </div>
                                        <div class="col-md-12">
                                            <label>Total Leased Area</label>
                                            <input type="text" class="form-control" id="total_leased"
                                                name="total_leased" placeholder="Total Leased Area" readonly />

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Mall Image</label>
                                            <input type="file" id="edit-image-upload" class="form-control"
                                                name="mall_image" />
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <img src="" class="img-fluid card-img" id="edit-show-image"
                                                alt="..." style="height: 55vh; object-fit: cover" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sta">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.editMall').click(function() {
            $('#editMallForm').trigger('reset');
            $.ajax({
                url: "{{ route('space.edit.mall', 'editMall') }}",
                type: "GET",
                data: {
                    mall_id: $(this).data('mall-id'),
                },
                success: function(data) {
                    $('#mall_code').val(data.mallnum);
                    $('#mall_name').val(data.mallname);
                    $('#mall_address').val(data.malladdress);
                    $('#mall_facility').val(data.mallfacility);
                    $('#total_area').val(data.total_area);
                    $('#total_available').val(data.total_available);
                    $('#total_leased').val(data.total_leased);
                    $('#mall_id').val(data.id);
                    if (data.mallimage == null) {
                        $('#edit-show-image').attr('src',
                            'https://images.pexels.com/photos/28216688/pexels-photo-28216688/free-photo-of-autumn-camping.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
                            );
                    } else {
                        $('#edit-show-image').attr('src',
                            '{{ asset('storage/mall_images') }}' + '/' + data.mallimage);
                    }
                },
                error: function(xhr, status, error) {

                }
            });
        });

        $('#edit-image-upload').change(function() {
            const reader = new FileReader();
            reader.onload = (e) => {
                $('#edit-show-image').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
