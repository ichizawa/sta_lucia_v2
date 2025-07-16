<div class="modal fade" id="editLevelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="modalEditLevel" action="{{ route('lease.option.space', 'submitLevel') }}" method="POST">
                @csrf
                <div class="modal-header brown-border-top">
                    <h5 class="modal-title">Edit Level Number</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="mallListCodes" class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Mall Code</label>
                                            <select id="mallcodeLevel" class="form-control" name="mallCode" disabled>
                                                @foreach ($mallCodes as $mall)
                                                    <option value="{{ $mall->id }}">{{ $mall->mallname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Building Number</label>
                                            <select id="bldgnumber" class="form-control"
                                                placeholder="Select Building Number..." name="buildingNum" disabled>
                                                @foreach ($levelCode as $levels)
                                                    <option value="{{ $levels->lvlnumid }}">{{ $levels->bldgnum }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Level Number</label>
                                            <input type="text" class="form-control" id="lvlNumbers" name="lvlNum"
                                                placeholder="Enter Level Number" required />
                                            <input type="text" class="form-control" id="lvlID" name="lvlNumID"
                                                hidden />
                                        </div>
                                        <div class="col-md-12">
                                            <label>Total Area of Level</label>
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
                                            <label>Level Image</label>
                                            <input type="file" id="image-upload2" class="form-control"
                                                name="lvl_image" />
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
        $('#modalEditLevel').submit(function(e) {
            $('#mallcodeLevel').attr('disabled', false);
            $('#bldgnumber').attr('disabled', false);
        });

        $('.editspecificLevels').click(function() {
            $.ajax({
                url: "{{ route('lease.edit.level', 'editLevel') }}",
                type: "GET",
                data: {
                    levelID: $(this).data('level-id')
                },
                success: function(data) {
                    $.each(data, function(key, value) {
                        // console.log(data);
                        $('#lvlID').val(data.level[0].lvlnumid);
                        $('#lvlNumbers').val(data.level[0].lvlnum);
                        $('#mallcodeLevel').val(data.level[0].mallid);
                        $('#bldgnumber').val(data.level[0].bldgid);
                        $('#total_area').val(data.blding[0].mallcodes.total_area);
                        $('#total_available').val(data.blding[0].mallcodes
                            .total_available);
                        $('#total_leased').val(data.blding[0].mallcodes
                            .total_leased);
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
