$(document).ready(function () {
    const currentYear = new Date().getFullYear();
    const range = (start, stop, step) =>
        Array.from({ length: (stop - start) / step + 1 }, (_, i) => start + i * step);
    const years = range(currentYear + 1, currentYear - 10, -1);
    const table = years.map((year) => ({ index: year }));

    $('#collect-datatables').DataTable({
        pageLength: 5,
        data: table,
        columns: [{ data: 'index' }],
        order: [[0, 'desc']],
        dom: 'rt<"bottom"p><"clear">',
        columnDefs: [{ targets: 0, className: 'text-center' }],
        rowCallback: function (row, data, indexRow) {
            $(row)
                .attr({
                    'data-year': data.index,
                    style: 'cursor: pointer',
                    'data-bs-toggle': 'collapse',
                    'data-bs-target': `#year-detail-${indexRow}`,
                    'aria-expanded': 'false',
                    'aria-controls': `#year-detail-${indexRow}`,
                })
                .addClass('year-selector');
        },
    });

    const tenant_table = $('#tenant-datatables').DataTable({
        pageLength: 10,
        columns: [
            { data: 'acc_id' },
            { data: 'store_name' },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-sta btn-sm action-view" data-bs-toggle="modal" data-bs-target="#collectionLedgerModal" data-id="${row.owner_id}">
                            <i class="fa fa-eye"></i>
                        </button>
                        <button class="btn btn-warning btn-sm action-pay" data-bs-toggle="offcanvas" data-bs-target="#paymentCanvas" data-id="${row.owner_id}">
                            <i class="fa fa-pencil"></i>
                        </button>
                    `;
                },
            },
        ],
        order: [[0, 'desc']],
        rowCallback: function (row, data, index) {
            $(row)
                .attr({
                    style: 'cursor: pointer',
                })
                .addClass('tenant-selector');
        },
    });

    $('.year-selector').click(function (e) {
        let tr = e.target.closest('tr');
        let row = $('#collect-datatables').DataTable().row(tr);

        if (row.child.isShown()) {
            row.child.hide();
        } else {
            row.child(format(row.data())).show();
        }

        $('.monthLists').click(function () {
            var date = $(this).data('date');

            showLists(date);
        });
    });

    function format(data) {
        let year = data.index;
        let dataRows = '';

        for (let month = 0; month < 12; month++) {
            const monthNumber = String(month + 1).padStart(2, '0');
            const monthName = new Date(year, month).toLocaleString('default', { month: 'short' });
            dataRows += `<div class="col-sm-4 monthLists" data-date="${year}-${month + 1}">
                <p class="text-center border rounded monthNames">${monthName}</p>
            </div>`;
        }

        return `
            <div class="container-fluid">
                <div class="row">
                    ${dataRows}
                </div>
            </div>
        `;
    }

    function showLists(date) {
        $.ajax({
            url: BILL_CHECK,
            type: 'GET',
            dataType: 'json',
            data: {
                date: date,
            },
            success: function (response) {
                tenant_table.clear();
                tenant_table.rows.add(response);
                tenant_table.draw();
                if(response.length == 0){
                    $.notify(
                        {
                            message: 'No Bills Were Found For This Month',
                            title: 'No Tenants Found',
                            icon: 'fa fa-bell',
                        },
                        {
                            type: 'danger',
                            placement: {
                                from: 'top',
                                align: 'right',
                            },
                            time: 1000,
                            delay: 1500,
                        },
                    );
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            },
        });
    }
});
