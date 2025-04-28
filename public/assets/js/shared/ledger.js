$(document).ready(function () {
    const ledger = $('#ledgerTable').DataTable({
        pageLength: 10,
        columns: [
            { data: 'bill_no', className: 'text-center' },
            { data: 'transaction_id', className: 'text-center' },
            {
                data: 'debit',
                className: 'text-center',
                render: function (data) {
                    return parseFloat(data).toFixed(2);
                },
            },
            {
                data: 'credit', className: 'text-center',
                render: function (data) {
                    return parseFloat(data).toFixed(2);
                },
            },
            { data: 'remarks', className: 'text-center' }, 
            // { data: 'status' },
            {
                data: 'created_at', className: 'text-center',
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
