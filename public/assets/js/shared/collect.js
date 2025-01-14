$(document).ready(function () {
    $('#cntr_search').selectize({
        sortField: 'text',
        maxItems: 1,
        placeholder: 'Select Contract',
    });

    const contractLists = $('#contractListTable').DataTable({
        pageLength: 10,
        columns: [{ data: 'proposal_uid' }],
        rowCallback: function (row, data, index) {
            $(row).attr({
                style: 'cursor: pointer',
                'data-bs-toggle': 'modal',
                'data-bs-target': '#ledgerTableModal',
                'data-id': data.id,
            });
        },
    });
    var proposals = $('#cntr_search')[0].selectize;

    // Ledger
    $('#collectionLedgerModal').on('show.bs.modal', function (event) {
        var id = $(event.relatedTarget).data('id');
        $.ajax({
            url: BILL_LEDGER,
            type: 'GET',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function (data) {
                contractLists.clear();
                contractLists.rows.add(data);
                contractLists.draw();
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });

    // Payment
    $('#paymentCanvas').on('show.bs.offcanvas', function (event) {
        var id = $(event.relatedTarget).data('id');

        $.ajax({
            url: BILL_PAY,
            type: 'GET',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function (data) {
                proposals.clearOptions();
                $.each(data, function (key, value) {
                    proposals.addOption({
                        value: value.id,
                        text: value.proposal_uid,
                        data: {
                            acc_id: value.tenant_id,
                            billing_id: value.billing.billing_uid,
                            optional: value,
                        },
                    });
                });
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });

    $('#cntr_search').change(function () {
        var data = $('#cntr_search')[0].selectize.options[$(this).val()]?.data;
        var util_rows = '';
        const check = true;
        if (data == null || data == undefined) {
            $('#total_amount_payable').val('');
            $('#totalamount').val('');
            $('#billing_id').val('');
            $('#bill_num').val('');
            $('#biller_num').val('');
            $('#tenantSales').attr('hidden', true);
            $('#recent_payments').attr('hidden', true);
            $('#recentPaymentsTable tbody').empty();
            $('#billTableShow tbody').html(`
                <tr>
                    <td colspan="3">No Data Yet!</td>
                </tr>    
            `);
            $('#spaceTableShow tbody').html(`
                <tr>
                    <td colspan="3">No Data Yet!</td>
                </tr>    
            `);
        } else {
            $.each(data?.optional.utilities, function (key, value) {
                util_rows += `
                    <tr>
                        <td colspan="2">${value.util_desc.utility_name}</td>
                        <td>${
                            value.reading
                                ? parseFloat(value.reading.utility_price).toFixed(2)
                                : 'No Reading Yet'
                        }</td>
                    </tr>
                `;
            });

            if (
                data?.optional.billing.bill_details !== null ||
                data?.optional.billing.bill_details !== undefined
            ) {
                $('#recent_payments').attr('hidden', false);
                $.each(
                    data?.optional.billing.bill_details.sort((a, b) => b.id - a.id).slice(0, 5),
                    function (key, value) {
                        if (value.is_paid == 1) {
                            $('#recentPaymentsTable tbody').append(`
                                <tr>
                                    <td>${value.transaction_id}</td>
                                    <td>-${parseFloat(value.credit).toFixed(2)}</td>
                                    <td>${formatDate(value.created_at)}</td>
                                </tr>
                            `);
                        }
                    },
                );
                // if ($('#recentPaymentsTable tbody tr').length > 5) {
                //     $('#recentPaymentsTable tbody tr:last').remove();
                // }
            }

            $.each(data?.optional.selected_space, function (key, value) {
                if (value.space.space_type == 'Fixed Rental') {
                    $('#tenantSales').attr('hidden', true);
                } else {
                    $('#tenantSales').attr('hidden', false);
                }

                $('#spaceTableShow tbody').html(`
                    <tr>
                        <td colspan="2">Space Name</td>
                        <td colspan="2">${value.space.space_name}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Space Area</td>
                        <td>${value.space.space_area}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Space Type</td>
                        <td>${value.space.space_type}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Store Type</td>
                        <td>${value.space.store_type}</td>
                    </tr>
                `);
            });

            $('#billTableShow tbody').html(`
                <tr>
                    <td colspan="2">Discount</td>
                    <td>${parseFloat(data.optional.discount).toFixed(2)}</td>
                </tr>
                <tr>
                    <td colspan="2">Basic Rent</td>
                    <td>${parseFloat(data.optional.brent).toFixed(2)}</td>
                </tr>
                <tr>
                    <td colspan="2">Minimum Guaranteed Rent</td>
                    <td>${parseFloat(data.optional.min_mgr).toFixed(2)}</td>
                </tr>
                <tr>
                    <td colspan="2">Total Basic Rent</td>
                    <td>${parseFloat(data.optional.total_rent).toFixed(2)}</td>
                </tr>
                <tr>
                    <td colspan="2">Total Minimum Guaranteed Rent</td>
                    <td>${parseFloat(data.optional.total_mgr).toFixed(2)}</td>
                </tr>
                <tr class="bg-light">
                    <td colspan="3" class="text-center fw-bold">Utilities</td>
                </tr>
                ${util_rows}
            `);

            $('#totalamount').val(parseFloat(data?.optional.billing.debit).toFixed(2));
            $('#total_amount_payable').val($('#totalamount').val());

            $('#bill_num').val(rand(10000, 99999) + '-' + data?.billing_id);
            // $('#bill_num').val(data?.billing_id);
            $('#biller_num').val($('#bill_num').val());
            $('#billing_id').val(data?.optional.billing.id);
        }
    });

    function rand(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function formatDate(date) {
        const options = {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
        };
        return new Date(date).toLocaleDateString('en-US', options);
    }

    $('#bill_pay_btn').click(function () {
        var data = $('#cntr_search').val();
        var check = data ? true : false;
        if (check == true) {
            $('#collectOptionModal').modal('show');
        } else {
            $.notify(
                {
                    title: 'Warning!',
                    message: 'Please select a contract first!',
                    icon: 'fa fa-bell',
                },
                {
                    type: 'warning',
                    placement: {
                        from: 'top',
                        align: 'left',
                    },
                    time: 1000,
                    delay: 1500,
                    z_index: 999999,
                },
            );
        }
    });

    $('#payment_method').change(function () {
        var val = $(this).val();
        $('#ref_num_div').attr('hidden', true);

        if (val !== 'Cash') {
            $('#ref_num_div').attr('hidden', false);
        }
    });

    $('#amount_payment').keyup(function () {
        var amount = $(this).val();
        var payable = $('#total_amount_payable').val();
        var change = parseFloat(amount) - parseFloat(payable);
        var new_bal = parseFloat(payable) - parseFloat(amount);
        $('#change').val('');
        $('#new_bal').val('');
        if (amount != '') {
            if (change >= 0) {
                $('#change').val(parseFloat(change).toFixed(2));
            }else{
                $('#change').val(0);
            }

            if (new_bal >= 0) {
                $('#new_bal').val(parseFloat(new_bal).toFixed(2));
            }else{
                $('#new_bal').val(0);
            }
        }
    });

    $('#proceedPaymentFinal').click(function () {
        var form = new FormData($('#finalOptionForm')[0]);

        $.ajax({
            url: BILL_PAY_STORE,
            type: 'POST',
            data: form,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.status == 'success') {
                    swal('Success', 'Bill paid successfuly, you can now proceed', 'success').then(
                        () => {
                            $('#collectOptionModal').modal('hide');
                            $('#totalamount').val(parseFloat(response.amount ?? 0).toFixed(2));
                            $('#recentPaymentsTable tbody').prepend(`
                                <tr>
                                    <td>${response.transaction_id}</td>
                                    <td>-${parseFloat(response.val).toFixed(2)}</td>
                                    <td>${formatDate(response.transaction_date)}</td>
                                </tr>
                            `);

                            if ($('#recentPaymentsTable tbody tr').length > 5) {
                                $('#recentPaymentsTable tbody tr:last').remove();
                            }
                        },
                    );
                } else {
                    swal('Error', 'Something went wrong, please try again!', 'error');
                }
            },
            error: function (status, xhr, error) {
                console.log(xhr.responseText);
            },
        });
    });
});
