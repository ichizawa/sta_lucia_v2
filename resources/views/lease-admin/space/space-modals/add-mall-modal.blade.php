<div class="modal fade" id="addMallModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('lease.option.space', 'submitMall') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header brown-border-top">
                    <h5 class="modal-title">Add Mall Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="mallListCodes" class="container-fluid">
                                    <div class="row">
                                        <!-- <div class="col-md-12 d-flex justify-content-end">
                      <a class="btn btn-sta" id="addRow"><i class="fa fa-plus"></i> Add Facilities</a>
                    </div> -->
                                        <div class="col-md-6">
                                            <label>Mall Codes</label>
                                            <input type="text" class="form-control" name="mall_code"
                                                placeholder="Enter Mall Code" maxlength="3" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label>Mall Name</label>
                                            <input type="text" class="form-control" name="mall_name"
                                                placeholder="Enter Mall Name" required />
                                        </div>
                                        <div class="col-md-12">
                                            <label>Mall Address</label>
                                            <input type="text" class="form-control" name="mall_address"
                                                placeholder="Enter Mall Address" required />
                                        </div>
                                        <div class="col-md-12">
                                            <label>Mall Facilities</label>
                                            <!-- <input type="text" class="form-control" name="mall_facility" placeholder="Enter Mall Facilities"
                        required/> -->
                                            <textarea class="form-control" name="mall_facility" rows="5" placeholder="Enter Mall Facilities" required></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Total Area of Mall</label>
                                            <input type="text" class="form-control" name="total_area"
                                                placeholder="Total Area" readonly />
                                        </div>
                                        <div class="col-md-12">
                                            <label>Total Available Area</label>
                                            <input type="text" class="form-control" name="total_available"
                                                placeholder="Total Available Area" readonly />
                                        </div>
                                        <div class="col-md-12">
                                            <label>Total Leased Area</label>
                                            <input type="text" class="form-control" name="total_leased"
                                                placeholder="Total Leased Area" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Mall Image</label>
                                            <input type="file" id="image-upload" class="form-control"
                                                name="mall_image" />
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <img src="https://images.pexels.com/photos/28216688/pexels-photo-28216688/free-photo-of-autumn-camping.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                                class="img-fluid card-img" id="show-image" alt="..."
                                                style="height: 55vh; object-fit: cover" />
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
        $('#image-upload').change(function() {
            const reader = new FileReader();
            reader.onload = (e) => {
                $('#show-image').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
