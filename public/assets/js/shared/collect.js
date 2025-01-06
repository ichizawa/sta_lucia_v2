$(document).ready(function () {
    $('#cntr_search').selectize({
        sortField: 'text',
        maxItems: 1,
        placeholder: 'Select Contract',
    });

    const ledgertable = $('#ledgerTable').DataTable({
        pageLength: 10,
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
                ledgertable.clear();
                $.each(data, function (key, value) {
                    ledgertable.row.add([
                        value.billing.billing_uid,
                        value.proposal_uid,
                        value.billing.remarks,
                        null,
                        value.billing.is_paid == 0
                            ? 'Waiting Payment'
                            : value.billing.is_paid == 1
                            ? 'Paid'
                            : 'Pending Process',
                        value.billing.date_end,
                    ]);
                });
                ledgertable.draw();
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

            $.each(data?.optional.selected_space, function (key, value) {
                if(value.space.space_type == 'Fixed Rental') {
                    $('#tenantSales').attr('hidden', true);
                }else{
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

            $('#totalamount').val(parseFloat(data?.optional.billing.amount).toFixed(2));
            $('#total_amount_payable').val($('#totalamount').val());

            $('#bill_num').val(rand(10000, 99999) + '-' + data?.billing_id);
            $('#biller_num').val($('#bill_num').val());
            $('#billing_id').val(data?.optional.billing.id);
        }
    });

    function rand(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    $('#bill_pay_btn').click(function () {
        let form = new FormData($('#collectionForm')[0]);

        $('#collectOptionModal').modal('show');
        // $.ajax({
        //     url: BILL_PAY_STORE,
        //     type: 'POST',
        //     data: form,
        //     contentType: false,
        //     cache: false,
        //     processData: false,
        //     dataType: 'json',
        //     success: function (response) {
        //         console.log(response);
        //         if(response.status == 'success'){
        //             swal('Success', response.message, 'success').then(() => {
        //                 // ledgertable.ajax.reload();
        //             });
        //         }else{
        //             swal('Error', response.message, 'error');
        //         }
        //     },
        //     error: function (status, xhr, error) {
        //         console.log(xhr.responseText);
        //     },
        // });
    });

    $('#payment_method').change(function() {
        var val = $(this).val();
        $('#ref_num_div').attr('hidden', true);

        if(val !== 'Cash'){
            $('#ref_num_div').attr('hidden', false);
        }
    });

    $('#proceedPaymentFinal').click(function() {
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
                // if(response.status == 'success'){
                //     swal('Success', response.message, 'success').then(() => {
                //     });
                // }else{
                //     swal('Error', response.message, 'error');
                // }
            },
            error: function (status, xhr, error) {
                console.log(xhr.responseText);
            },
        });
    });
});
