$(document).ready(function () {
    const ledger = $('#ledgerTable').DataTable({
        pageLength: 10,
        columns: [
            { data: 'bill_no' },
            { data: 'transaction_id' },
            {
                data: 'debit',
                render: function (data) {
                    return parseFloat(data).toFixed(2);
                },
            },
            {
                data: 'credit',
                render: function (data) {
                    return parseFloat(data).toFixed(2);
                },
            },
            { data: 'remarks' },
            // { data: 'status' },
            {
                data: 'created_at',
                render: function (data) {
                    return formatDate(data);
                },
            },
            // { data: 'date_to' },
        ],
    });

    $('#ledgerTableModal').on('show.bs.modal', function (event) {
        var id = $(event.relatedTarget).data('id');

        $.ajax({
            url: LEDGER_TABLE,
            type: 'GET',
            dataType: 'json',
            data: {
                id: id,
            },
            success: function (data) {
                ledger.clear();
                ledger.rows.add(data);
                ledger.draw();
                $('#backtocontractlist').data('id', id);
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    });

    function formatDate(date) {
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return new Date(date).toLocaleDateString('en-US', options);
    }
});
