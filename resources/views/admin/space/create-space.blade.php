@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Space</h3>
            </div>
        </div>
        <form id="testrunonbroadcast" action="{{ route('space.submit.space') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between ">
                                <h4 class="card-title">Space Information</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="step1">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="space_name">Space Name</label>
                                        <input type="text" class="form-control" id="space_name" name="spacename"
                                            placeholder="Space Name" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="space_area">Floor Area (Sqm)</label>
                                        <input type="text" class="form-control" id="space_area" name="spacearea"
                                            placeholder="Floor Area" required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="mall_code">Mall Code</label>
                                        <!-- <input type="text" class="form-control" id="mall_code" name="mallCode"
                                            placeholder="Mall Code" required /> -->
                                        <select id="search-mall-code" placeholder="Select Mall Code..." name="mallCode"
                                            required>
                                            <option value="" selected hidden disabled>Select Mall Code</option>
                                            @foreach ($mallcode as $mall)
                                                <option value="{{ $mall->mallnum }}" data-mallid="{{ $mall->id }}">
                                                    {{ $mall->mallnum }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Building No.</label>
                                        <!-- <input type="text" class="form-control" id="bldg_number" name="bldgnumber"
                                            placeholder="Bldg No." required /> -->
                                        <select id="search-bldg-number" placeholder="Select Building Number..."
                                            name="bldgnumber" required>
                                            <option value="" selected hidden disabled>Select Building Number</option>
                                            <!-- @foreach ($building as $bldgnum)
    <option value="{{ $bldgnum->bldgnum }}">{{ $bldgnum->bldgnum }}</option>
    @endforeach -->
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Level No.</label>
                                        <!-- <input type="text" class="form-control" id="level_number" name="levelNumber"
                                            placeholder="Level No." required /> -->
                                        <select id="search-level-number" placeholder="Select Level Number..."
                                            name="levelNumber" required>
                                            <option value="" selected hidden disabled>Select Level Number</option>
                                            <!-- @foreach ($level as $lvl)
    <option value="{{ $lvl->lvlnum }}" data-lvl-id="{{ $lvl->bldgnumid }}">{{ $lvl->lvlnum }}</option>
    @endforeach -->
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Unit No.</label>
                                        <input type="text" class="form-control" id="unit_number" name="unitnumber"
                                            placeholder="Unit No." required />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Space Code</label>
                                        <input type="text" class="form-control" id="space_code" name="space_code"
                                            placeholder="Space Code" readonly required />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="propertytype">Space Type</label>

                                        <select class="form-control" name="storeType" id="property_type" required>
                                            <option value="" selected hidden>Select Space Type</option>
                                            <option value="FOOD">FOOD</option>
                                            <option value="RETAIL">RETAIL</option>
                                            <option value="KIOSK">KIOSK</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="propertytype">Space Option</label>
                                        <select class="form-control" name="spaceType" id="space_type" required>
                                            <option value="" selected hidden>Select Space Option</option>
                                            <option value="Fixed Rental">Fixed Rental</option>
                                            <option value="Percentage Rental">Percentage Rental</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="location">Location</label>
                                        <select class="form-control" name="location" id="location" required>
                                            <option value="" selected hidden>Select Location</option>
                                            <option value="Prime Space">Prime Space</option>
                                            <option value="Anchor Tenant">Anchor Tenant</option>
                                            <option value="Corner">Corner</option>
                                            <option value="Near the Escalator">Near the Escalator</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="space_tag">Space Tagging</label>
                                        <select class="form-control" name="spaceTag" id="space_tag" required>
                                            <option value="#" selected hidden>Select Space Tag</option>
                                            <option value="1">Available</option>
                                            <option value="2">Unavailable</option>
                                            <option value="3">Reserved</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Remarks</label>
                                        <input type="text" class="form-control" id="remarks" name="remarks"
                                            placeholder="Remarks" />
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-sta">Submit</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card" style="height: 35.5rem;">
                        <div class="card-header">
                            <div class="row d-flex justify-content-between">
                                <div class="col-auto">
                                    <h4 class="card-title">Space Image</h4>
                                </div>
                                <div class="col-auto">
                                    <input type="file" name="spaceIMG" class="form-control" id="space-img" />
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0 text-center">
                            <img src="https://images.pexels.com/photos/28216688/pexels-photo-28216688/free-photo-of-autumn-camping.png?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                class="img-fluid card-img" id="show-image" alt="..." />
                        </div>
                        <div class="card-footer mb-3">
                            <div class="container-fluid">
                                <h6>Amenities</h6>
                                <!-- <div class="row">
                                    @foreach ($amenities as $amenity)
    <div class="col-sm-auto">
                                            <div class="quiz_card_area">
                                                <input class="quiz_checkbox" type="checkbox" id="amenity_uid" name="amenity_ids[]" value="{{ $amenity->id }}"/>
                                                <div class="single_quiz_card">
                                                    <div class="quiz_card_content">
                                                        <div class="quiz_card_icon">
                                                           
                                                        </div>
                                                        <div class="quiz_card_title">
                                                            <h3>{{ $amenity->amenity_name }}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    @endforeach
                                </div> -->

                                <div class="selectgroup selectgroup-pills">
                                    @foreach ($amenities as $amenity)
                                        <label class="selectgroup-item">
                                            <input type="checkbox" id="amenity_uid" name="amenity_ids[]"
                                                value="{{ $amenity->id }}" class="selectgroup-input" />
                                            <span class="selectgroup-button">{{ $amenity->amenity_name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <style>
        .card-body {
            position: relative;

            overflow: hidden;
        }

        .card-img {
            padding: 2rem;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>


    <script>
        $(document).ready(function() {
            $('#space-img').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            var levelOption = @json($level);
            var bldgOptions = @json($building);
            var mallOptions = @json($mallcode);

            $('#search-mall-code').selectize({
                sortField: 'text'
            });

            $('#search-bldg-number').selectize({
                sortField: 'text',
            });

            $('#search-level-number').selectize({
                sortField: 'text'
            });

            var levelSelect = $('#search-level-number')[0].selectize;
            var bldgSelect = $('#search-bldg-number')[0].selectize;
            var mallCodes = $('#search-mall-code')[0].selectize;

            $('#search-mall-code').change(function() {
                bldgSelect.clear();
                bldgSelect.clearOptions();
                var getMallID = mallCodes.options[$(this).val()].mallid;
                bldgOptions.map((bldg) => {
                    if (bldg.mallid == getMallID) {
                        bldgSelect.addOption({
                            value: bldg.bldgnum,
                            text: bldg.bldgnum,
                            bldgId: bldg.id
                        });
                    }
                });

                bldgSelect.refreshOptions(false);
            });

            $('#search-bldg-number').change(function() {
                levelSelect.clear();
                levelSelect.clearOptions();
                var selectedOption = bldgSelect.options[$(this).val()].bldgId;
                levelOption.map((level) => {
                    if (level.bldgnumid == selectedOption) {
                        levelSelect.addOption({
                            value: level.lvlnum,
                            text: level.lvlnum,
                            levelId: level.id
                        });
                    }
                });
                levelSelect.refreshOptions(false);
            });

            $('#search-mall-code, #search-bldg-number, #search-level-number').on("change", function() {
                updateSpaceCode();
            });
            $('#unit_number').on("input", function() {
                updateSpaceCode();
            });

            function updateSpaceCode() {
                var mallCode = $('#search-mall-code')[0].selectize.getValue();
                var bldgNumber = $('#search-bldg-number')[0].selectize.getValue();
                var levelNumber = $('#search-level-number')[0].selectize.getValue();
                var unitNumber = $('#unit_number').val();

                $('#space_code').val(mallCode + bldgNumber + levelNumber + unitNumber);
            }

        });
    </script>
@endsection
