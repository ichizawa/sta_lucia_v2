<div class="modal fade" id="addLevelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('space.option.space', 'submitLevel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header brown-border-top">
                    <h5 class="modal-title">Add Level Number</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>Mall Code</label>
                                            <select id="level-mall-code" placeholder="Select Mall Code..."
                                                name="mallCode" class="form-control" required>
                                                <option value="" selected hidden disabled>Select Mall Code
                                                </option>
                                                @foreach ($mallCodes as $mall)
                                                    <option value="{{ $mall->id }}">{{ $mall->mallname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label>Building Number</label>
                                            <select id="level-bldg-number" placeholder="Select Building Number..."
                                                name="buildingNum" class="form-control" required>
                                                <option value="" selected hidden disabled>Select Building Number
                                                </option>

                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label>Level Number</label>
                                            <input type="text" class="form-control" name="lvlNum" maxlength="3"
                                                placeholder="Enter Level Number" required />
                                        </div>
                                        <div class="col-md-12">
                                            <label>Total Area of Level</label>
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
                                            <label>Level Image</label>
                                            <input type="file" id="image-upload" class="form-control"
                                                name="lvl_image" />
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
        $('#level-mall-code').selectize({
            sortField: 'text'
        });
        $('#level-bldg-number').selectize({
            sortField: 'text'
        });

        var bldgSelect = $('#level-bldg-number')[0].selectize;

        $('#level-mall-code').change(function() {
            bldgSelect.clearOptions();
            $.ajax({
                url: "{{ route('space.get.level') }}",
                type: "GET",
                data: {
                    id: $(this).val()
                },
                success: function(data) {
                    $.each(data, function(key, value) {
                        bldgSelect.addOption({
                            value: value.id,
                            text: value.bldgnum
                        });
                    });
                    bldgSelect.refreshOptions(false);
                }
            });
        });
    });
</script>
