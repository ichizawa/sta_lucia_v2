<div class="modal fade" id="editBuildingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="modalEditBuilding" action="{{ route('lease.option.space', 'submitBuilding') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header brown-border-top">
                    <h5 class="modal-title">Edit Building Number</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="mallListCodes" class="container-fluid">
                                    <div class="row">
                                        <!-- <div class="col-md-12 d-flex justify-content-end">
                                    <a class="btn btn-sm btn-sta" id="addRow"><i class="fa fa-plus"></i> Add Row</a>
                                </div> -->
                                        <div class="col-md-12">
                                            <label>Mall Code</label>
                                            <select id="edit-building-search-mall-code" class="form-control"
                                                placeholder="Select Mall Code..." name="mallCode" disabled>
                                                <option value="" selected hidden disabled>Select Mall Code
                                                </option>
                                                @foreach ($mallCodes as $mall)
                                                    <option value="{{ $mall->id }}">{{ $mall->mallname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Building Number</label>
                                            <input type="text" id="editBuildingID" class="form-control"
                                                name="bldg_number" />
                                            <input type="text" id="bldgid" class="form-control" name="bldgid"
                                                hidden />
                                        </div>
                                        <div class="col-md-12">
                                            <label>Total Area of Building</label>
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
                                            <label>Building Image</label>
                                            <input type="file" id="image-upload2" class="form-control"
                                                name="bldg_image" />
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <img src="https://images.pexels.com/photos/28216688/pexels-photo-28216688/free-photo-of-autumn-camping.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                                class="img-fluid card-img" id="show-image2" alt="..."
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
        // $('#edit-building-search-mall-code').selectize({
        //   sortField: 'text'
        // });
        $('#modalEditBuilding').submit(function() {
            $('#edit-building-search-mall-code').prop('disabled', false);
        });

        $('#image-upload2').change(function() {
            const reader = new FileReader();
            reader.onload = (e) => {
                $('#show-image2').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });

        $('.editBuilding').click(function() {
            $('#modalEditBuilding').trigger('reset');

            $.ajax({
                url: "{{ route('lease.edit.building', 'editBuilding') }}",
                type: "GET",
                data: {
                    buildingID: $(this).data('building-uid')
                },
                success: function(data) {
                    $.each(data, function(key, value) {
                        // console.log(data);
                        $('#edit-building-search-mall-code').val(value.mallcodes
                            .id);
                        $('#editBuildingID').val(value.bldgnum);
                        $('#bldgid').val(value.id);
                        $('#total_area').val(data[0].mallcodes.total_area);
                        $('#total_available').val(data[0].mallcodes
                            .total_available);
                        $('#total_leased').val(data[0].mallcodes.total_leased);
                        var img = data[0].bldgimage ?
                            `{{ asset('storage/bldg_image') }}/${data[0].bldgimage}` :
                            'https://images.pexels.com/photos/28216688/pexels-photo-28216688/free-photo-of-autumn-camping.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1';
                        $('#show-image2').attr('src', img);
                    });
                }
            });
        });
    });
</script>
