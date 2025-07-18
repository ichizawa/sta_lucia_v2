@extends('layouts')

@section('content')
    <style>
        /* #headingOne,
                        #headingTwo,
                        #headingThree,
                        #headingFour,
                        #headingFive,
                        #headingSix,
                        #headingSeven {
                            border-radius: 10px !important;
                            -webkit-box-shadow: 9px 10px 5px 0px rgba(0, 0, 0, 0.11);
                            -moz-box-shadow: 9px 10px 5px 0px rgba(0, 0, 0, 0.11);
                            box-shadow: 9px 10px 5px 0px rgba(0, 0, 0, 0.11);
                        } */
    </style>
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Lease Proposal</h3>
            </div>
        </div>

        <div class="container-fluid bg-white p-4">
            <form action="{{ route('leaseSubmit.submit.lease.proposal', ['option' => 'proposal']) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="accordion" id="leaseProposalAccordion">

                    <div class="row">
                        <div class="col">
                            <div class="card card-round ">
                                <div class="card-header bg-white  w-100 justify-content-between"">
                                        <h5 class=" mb-0 fw-bold">
                                    General Information
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show bg-white" aria-labelledby="headingOne"
                                    data-bs-parent="#leaseProposalAccordion">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="company_prop">Company Name</label>
                                                <select class="form-control" name="companyprop" id="company_prop" required>
                                                    <option value="" selected disabled hidden>Select Company</option>
                                                    @foreach ($tenants as $tenant)
                                                        <option value="{{ $tenant->id }}" data-tenant-uid="{{ $tenant->id }}"
                                                            data-rep-name="{{ $tenant->rep_fname . ' ' . $tenant->rep_lname }}"
                                                            data-rep-pos="{{ $tenant->rep_position }}"
                                                            data-rep-mobile="{{ $tenant->rep_mobile }}"
                                                            data-rep-email="{{ $tenant->rep_email }}">
                                                            {{ ucfirst($tenant->company_name) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="business_nature">Business Type</label>
                                                <input name="businessnature" type="text" class="form-control"
                                                    id="business_nature" placeholder="Nature of Business" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="auth_rep">Authorized Representative</label>
                                                <input name="authrep" type="text" class="form-control" id="auth_rep"
                                                    placeholder="Authorized Representative" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="auth_designation">Designation</label>
                                                <input name="authdesignation" type="text" class="form-control"
                                                    id="auth_designation" placeholder="Designation" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="auth_contact">Contact Number</label>
                                                <input name="repcontact" type="text" class="form-control" id="auth_contact"
                                                    placeholder="Contact Number" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email_address">Email Address</label>
                                                <input name="compemail" type="email" class="form-control" id="email_address"
                                                    placeholder="Email Address" readonly>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col">
                            @include('lease-admin.leases.components.space-information')
                        </div>
                    </div>

                    <!-- @include('admin.leases.components.lease-details') -->
                    <div class="row">
                        <div class="col">
                            @include('lease-admin.leases.components.extra-charges')

                        </div>
                        <div class="col">
                            @include('lease-admin.leases.components.utilities')

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            @include('lease-admin.leases.components.lease-terms')

                        </div>
                        <div class="col">
                            @include('lease-admin.leases.components.payments')

                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sta">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $('.utility_names').on('change', function () {
                var selectedOption = $(this).find('option:selected').data('fee');
                $('#utility_fee').val(selectedOption || '');

            });


            $('#utility-container').on('change', '.utitlity_names', function () {
                var selectedOption = $(this).find('option:selected').data('fee');

                var rowId = $(this).closest('.row').attr('id');
                $(`#${rowId} .utility_fee`).val(selectedOption || '');
            })

            $('.extra_charge').on('change', function () {
                var value = $(this).find('option:selected').data('value');
                var freq = $(this).find('option:selected').data('frequency');


                $('#extra_value').val(value || '');
                $('#extra_frequency').val(freq || '');
            })

            $('#extra-charge-container').on('change', '.extra_charge', function () {
                var value = $(this).find('option:selected').data('value');
                var freq = $(this).find('option:selected').data('frequency');

                var rowId = $(this).closest('.row').attr('id');

                $(`#${rowId} .extra_value`).val(value || '');
                $(`#${rowId} .extra_frequency`).val(freq || '');
            });

            $('#company_prop').change(function () {
                var option = $(this).find('option:selected');
                var tenant_id = option.data('tenant-uid');
                var repName = option.data('repName');
                var repPos = option.data('repPos');
                var repMobile = option.data('repMobile');
                var repEmail = option.data('repEmail');

                $('#auth_rep').val(repName);
                $('#auth_designation').val(repPos);
                $('#auth_contact').val(repMobile);
                $('#email_address').val(repEmail);

                $.ajax({
                    type: "GET",
                    url: "{{ route('lease.business.info') }}",
                    data: {
                        'company_id': tenant_id,
                    },
                    success: function (response) {
                        $.each(response, function (key, value) {
                            $('#business_nature').val(value.name + ' - ' + value
                                .sub_name);
                        });

                    },
                });
            });

            $('#spaceprop').change(function () {
                $('.table-container-rate tbody').empty();
                $('.table-container-rate').attr('hidden', false);
                $('#brent').val('');
                $('#minimumMGR').val('');
                $('#selected_rent').val('');
                $('#total_min_guaranteed_rent').val('');
                if ($(this).find('option:selected').data('space-option') == 'Percentage Rental') {
                    $('.percentageSale').attr('hidden', false);
                } else {
                    $('.percentageSale').attr('hidden', true);
                }

                var totalFloorArea = 0;
                var lastSelectedOption = null;
                var spaceOptions = null;
                $(this).find('option:selected').each(function () {
                    var option = $(this);
                    var spaceFloorArea = option.data('space-floor-area');
                    var spaceType = option.data('space-type');
                    var spaceOption = option.data('space-option');
                    var spaceName = option.data('space-name');


                    $('.table-container-rate tbody').append(`
                        <tr>
                            <td>${spaceName}</td>
                            <td>${spaceFloorArea} - ${spaceType} (${spaceOption})</td>
                            <td></td>
                        </tr>
                    `);

                    totalFloorArea += spaceFloorArea;
                    lastSelectedOption = option;
                    spaceOptions = spaceOption;
                });

                $('.table-container-rate tbody').append(`
                    <tr>
                        <td><strong>Total Floor Area:</strong></td>
                        <td></td>
                        <td><strong>${totalFloorArea}</strong></td>
                    </tr>
                    <tr id="min_mgr_row">
                        <td><strong>Minimum Guaranteed Rent:</strong></td>
                        <td><td id="min_mgr"><strong></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Total Basic Rent:</strong></td>
                        <td><td id="total_brent"><strong></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Total Guaranteed Rent:</strong></td>
                        <td><td id="total_mgr"><strong></strong></td>
                    </tr>
                    <tr>
                        <td><strong>Percentage Sale Rate:</strong></td>
                        <td></td>
                        <td><strong id="percentage_sale_rate"></strong></td>
                    </tr>
                `);

                // $('.table-container-rate tbody tr').click(function () {
                //     if ($(this).index() >= $('.table-container-rate tbody tr').length - 2) {
                //         $(this).toggleClass('highlight').siblings().removeClass('highlight');

                //         var totalBasicRent = $('#total_brent').text();
                //         var totalGuaranteedRent = $('#total_mgr').text();

                //         if ($(this).find('td').eq(0).text().includes('Total Basic Rent')) {
                //             $('#selected_rent').val(totalBasicRent);
                //         } else if ($(this).find('td').eq(0).text().includes('Total Guaranteed Rent')) {
                //             $('#selected_rent').val(totalGuaranteedRent);
                //         }
                //     }
                // });

                $('#min_mgr_row').attr('hidden', false);
                if (lastSelectedOption) {
                    $('#brent, #payment_disc, #percentage_sale').off('input').on('input', function () {
                        $('#payment_disc').attr('readonly', false);
                        $('#percentage_sale').attr('readonly', false);

                        var value = parseFloat($('#brent').val()) || 0;
                        var discountValue = parseFloat($('#payment_disc').val()) || 0;
                        var discount = discountValue / 100;

                        var totalMGR = 0;
                        var totalbrent = 0;
                        var minMGR = 0;
                        var calminmgr = value + 150;
                        var discountedTotalBrent = 0;

                        var percentSale = parseFloat($('#percentage_sale').val()) || 0;

                        if (spaceOptions == 'Fixed Rental') {
                            $('#min_mgr_row').attr('hidden', true);
                            totalbrent = value * (1 - discount) * totalFloorArea;
                            minMGR = 0;
                            totalMGR = value * totalFloorArea;
                        } else {
                            totalbrent = value * (1 - discount) * totalFloorArea;
                            minMGR = calminmgr;
                            totalMGR = totalFloorArea * calminmgr;
                        }

                        $('#total_brent').html(totalbrent.toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }));
                        $('#min_mgr').html(minMGR.toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }));
                        $('#total_mgr').html(totalMGR.toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }));

                        $('#percentage_sale_rate').html(
                            percentSale.toLocaleString(undefined, {
                                minimumFractionDigits: 0,
                                maximumFractionDigits: 2
                            }) + '%'
                        );

                        $('#minimumMGR').val(minMGR);
                        $('#selected_rent').val(totalbrent);
                        $('#total_min_guaranteed_rent').val(totalMGR);
                        $('#percentage_sale_rate').val(percentSale);
                    });
                }

            });
        });

        let counter = 0;

        $('#add-another-utility').click(function () {
            counter++;
            const newFields = `
            <div class="row" id="utility_row_${counter}">
                <div class="form-group col-md-6">
                    <label for="utility-name-${counter}">Utility Name</label>
                    <select class="form-control utitlity_names" name="utilityid[]" id="utility_name_${counter}">
                        <option value="" selected hidden>Select Utility</option>
                        @foreach ($utilities as $utility)
                            <option value="{{ $utility->id }}" data-fee="{{ $utility->utility_price }}">{{ $utility->utility_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="utility-fee-${counter}">Utility Fee</label>
                    <input type="text" class="form-control utility_fee" id="utility_fee_${counter}" name="utilityfee[]"
                        placeholder="Utility Fee" readonly>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="d-flex justify-content-end ">
                        <button type="button" class="btn btn-danger btn-sm delete-utility" data-utility-id="${counter}">
                        <i class="bi bi-x-circle"></i> Delete
                    </button>
                    </div>
                </div>
            </div>
        `;

            $('#utility-container').append(newFields);
        });

        $('#utility-container').on('click', '.delete-utility', function () {
            const rowId = $(this).data('utility-id');
            $(`#utility_row_${rowId}`).remove();
        });


        let counters = 0;

        $('#add-another-charge').click(function () {
            counters++;
            const newFields = `
            <div class="row" id="charge_row_${counters}">
                <div class="form-group col-md-6">
                    <label for="charge_name_${counters}">Extra Charge Name</label>
                    <select class="form-control extra_charge" name="chargeid[]" id="charge_name_${counters}">
                        <option value="" selected disabled hidden>Select Extra Charge</option>
                        @foreach ($charges as $charge)
                            <option value="{{ $charge->id }}" 
                            data-value="{{ $charge->charge_fee }}"
                            data-frequency="{{ $charge->frequency }}">
                                {{ $charge->charge_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="extra_value_${counters}">Extra Charge Value</label>
                    <input type="text" class="form-control extra_value" id="extra_value_${counters}" name="chargeValue[]"
                        placeholder="Extra Charge Value" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="extra_frequency_${counters}">Frequency</label>
                    <input type="text" class="form-control extra_frequency" name="chargefrequency[]" id="extra_frequency_${counters}" readonly>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger btn-sm delete-charge" data-id="${counters}">
                            <i class="bi bi-x-circle"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
            `;

            $('#extra-charge-container').append(newFields);
        });

        $('#extra-charge-container').on('click', '.delete-charge', function () {
            const rowId = $(this).data('id');
            $(`#charge_row_${rowId}`).remove();
        });

        $('#space_prop').trigger('change');
    </script>
@endsection