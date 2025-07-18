<div class="modal fade" id="counterProposals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <form action="{{ route('lease.submit.lease.proposal', ['option' => 'counter']) }}" method="POST"
            id="counter-proposal" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Revised Leased Proposal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                @include('admin.leases.counter-proposal-components.general-information')
                            </div>
                            <div class="col-md-6">
                                @include('admin.leases.counter-proposal-components.space-information')
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @include('admin.leases.counter-proposal-components.extra-charges')
                            </div>
                            <div class="col-md-6">
                                @include('admin.leases.counter-proposal-components.utilities')
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @include('admin.leases.counter-proposal-components.lease-terms')
                            </div>
                            <div class="col-md-6">
                                @include('admin.leases.counter-proposal-components.payments')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.counterProposalsAdd').click(function (e) {
            var proposal_id = $(this).data('counter-prop-id');
            $('.table-container-rate tbody').empty();
            $('.extra-charge-container').empty();
            $('.utilities-container').empty();

            $.ajax({
                url: "{{ route('leaseShow.show.proposal') }}",
                type: "GET",
                data: {
                    proposal_id: proposal_id
                },
                success: function (response) {
                    charges_utilities(response);
                    var totalFloorArea = 0;
                    var check_fix = true;

                    $.each(response.data, function (key, value) {
                        $('#proposal_id').val(value.id);
                        $('#company_name').val(value.company_name);
                        $('#business_nature').val(value.bussiness_nature);
                        $('#auth_rep').val(value.rep_fname + ' ' + value.rep_lname);
                        $('#auth_designation').val(value.rep_position);
                        $('#auth_contact').val(value.owner_mobile);
                        $('#email_address').val(value.owner_email);

                        $('#brent').val(value.brent);
                        $('#payment_disc').val(value.discount);

                        $('#term_lease').val(value.lease_term);
                        $('#commencement_month').val(value.commencement);
                        $('#lease_monthending').val(value.end_contract);

                        $('#adv_rent').val(value.rent_deposit);
                        $('#sec_rent').val(value.sec_dep);
                        $('#esc_rent').val(value.escalation_rate);

                        $('#selected_rent').val(value.total_rent);
                        $('#ttl_gr_rnt').val(value.total_mgr);
                        $('#minimumMGR').val(value.min_mgr);

                        $.each(value.space_selected, function (key, value) {
                            totalFloorArea += parseFloat(value.space_area);

                            $('#spaceIDS').append(`
                                <input name="spaceprop[]" type="text" class="form-control" id="space_ids"
                                    value="${value.id}" hidden/>
                            `);

                            $('.table-container-rate tbody').append(`
                                <tr>
                                    <td>${value.space_name}</td>
                                    <td>${value.space_area} - ${value.store_type} (${value.space_type})</td>
                                    <td></td>
                                </tr>
                            `);

                            if (value.space_type == 'Fixed Rental') {
                                check_fix = true;
                            } else {
                                check_fix = false;
                            }
                        });

                        $('.table-container-rate tbody').append(`
                            <tr>
                                <td><strong>Total Floor Area:</strong></td>
                                <td></td>
                                <td><strong>${totalFloorArea}</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Minimum Guaranteed Rent:</strong></td>
                                <td><td><strong id="min_mgr">${parseFloat(value.min_mgr).toFixed(2)}</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Total Basic Rent:</strong></td>
                                <td><td><strong id="total_brent">${parseFloat(value.total_rent).toFixed(2)}</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Total Guaranteed Rent:</strong></td>
                                <td><td><strong id="total_mgr">${parseFloat(value.total_mgr).toFixed(2)}</strong></td>
                            </tr>
                        `);
                    });

                    $('#brent, #payment_disc1').keyup(function () {
                        var brent = parseFloat($('#brent').val()) || 0;
                        var discount = parseFloat($('#payment_disc1').val()) || 0;
                        var minMGR;
                        var total_brent = parseFloat(brent) * (1 - discount) * parseFloat(totalFloorArea);
                        var ttl_gr_r;

                        if (check_fix) {
                            $('#total_brent').html(parseFloat(total_brent).toFixed(2));
                            $('#total_mgr').html(parseFloat(total_brent).toFixed(2));

                            ttl_gr_r = parseFloat(total_brent).toFixed(2);
                            minMGR = 0;
                        } else {
                            ttl_gr_r = parseFloat(totalFloorArea) * parseFloat(minMGR);
                            minMGR = brent + 150;

                            $('#min_mgr').html(parseFloat(minMGR).toFixed(2));
                            $('#total_brent').html(parseFloat(total_brent).toFixed(2));
                            $('#total_mgr').html(parseFloat(ttl_gr_r).toFixed(2));
                        }

                        $('#minimumMGR').val(minMGR);
                        $('#selected_rent').val(parseFloat(total_brent).toFixed(2));
                        $('#ttl_gr_rnt').val(parseFloat(ttl_gr_r).toFixed(2));
                    });

                    $('.extra-charge-container').empty();
                    $.each(response.charges, function (key, value) {
                        $('.extra-charge-container').append(`
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="charge_name">Extra Charge Name</label>
                                <input type="text" class="form-control" id="charge_name" name="chargeName[]"
                                    value="${value.charge_name}"/>
                                <input type="text" class="form-control" id="charge_id" name="chargeid[]"
                                    value="${value.charge_id}" hidden/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="extra_value">Extra Charge Value</label>
                                <input type="text" class="form-control" id="extra_value" name="chargeValue[]"
                                    value="${value.charge_fee}" readonly/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="extra_frequency">Frequency</label>
                                <input type="text" class="form-control" name="chargefrequency[]" 
                                value="${value.frequency}"
                                id="extra_frequency" readonly>
                            </div>
                        </div>
                       `);
                    });

                    $('.utility-container').empty();
                    $.each(response.utilities, function (key, value) {
                        $('.utility-container').append(`
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="utilities">Utility Name</label>
                                    <input type="text" class="form-control" id="utilities" name="utilityname[]"" 
                                    value="${value.utility_name}"/>
                                    <input type="text" class="form-control" id="utilities" name="utilityid[]""
                                    value="${value.id}" hidden/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="utility_fee">Utility Fee</label>
                                    <input type="text" class="form-control" id="utility_fee" name="utilityfee[]" 
                                    value="${value.utility_price}" readonly/>
                                </div>
                            </div>
                        `);
                    });
                }
            });

            function charges_utilities(response) {
                let counters = 0;
                $('#add-another-charge').click(function () {
                    counters++;
                    const newFields = `
                    <div class="row" id="charge_row_${counters}">
                        <div class="form-group col-md-6">
                            <label for="charge_name_${counters}">Extra Charge Name</label>
                            <select class="form-control extra_charge" name="chargeid[]" id="charge_name_${counters}">
                                <option value="" selected disabled hidden>Select Extra Charge</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="extra_value_${counters}">Extra Charge Value</label>
                            <input type="text" class="form-control extra_value" id="extra_value_${counters}" name="chargeValue[]"
                                placeholder="Extra Charge Value">
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

                let counter = 0;
                $('#add-another-utility').click(function () {
                    counter++;
                    const newFields = `
                    <div class="row" id="utility_row_${counter}">
                        <div class="form-group col-md-6">
                            <label for="utility-name-${counter}">Utility Name</label>
                            <select class="form-control utitlity_names" name="utilityid[]" id="utility_name_${counter}">
                                <option value="" selected hidden>Select Utility</option>
                                
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
            }

        });
    });
</script>