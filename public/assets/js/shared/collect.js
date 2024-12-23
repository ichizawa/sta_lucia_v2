$(document).ready(function () {
    $('#cntr_search').selectize({
        sortField: 'text',
        maxItems: 1,
        placeholder: 'Select Contract'
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
                        value.billing.status,
                        value.billing.is_paid == 0 ? 'Waiting Payment' : value.billing.is_paid == 1 ? 'Paid' : 'Pending Process',
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
        if (data == null || data == undefined) {
            $('#bill_num').val('');
            $('#billTableShow tbody').html(`
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

            $('#billTableShow tbody').html(`
                <tr>
                    <td colspan="2">Discount</td>
                    <td>${parseFloat(data.optional.discount).toFixed(2)}</td>
                </tr>
                <tr>
                    <td colspan="2">Basic Rent (per sqm)</td>
                    <td>${parseFloat(data.optional.brent).toFixed(2)}</td>
                </tr>
                <tr>
                    <td colspan="2">Minimum Guaranteed Rent (per sqm)</td>
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

            $('#bill_num').val(rand(10000, 99999) + '-' + data?.billing_id);
        }
    });

    function rand(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
});
