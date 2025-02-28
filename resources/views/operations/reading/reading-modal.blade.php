<div class="modal fade" id="utilityListModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="billReadingForm" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Utility Reading Lists</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="operations-tenant-reading"
                            class="table table-hover table-striped table-bordered w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tenant #</th>
                                </tr>
                            </thead>
                            <tbody id="utilityTableList">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="appendInputHere">
                    <input type="text" name="dateToRead" id="dateToRead" hidden />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sta prepareBilling">Process Reading</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        // let data = '';
        // $('#utilityListModal').on('show.bs.modal', function (event) {
        //     data = $(event.relatedTarget).data('date');
        // });
        // const table = $("#operations-tenant-reading").DataTable({
        //     pageLength: 10,
        //     processing: true,
        //     serverSide: false,
        //     responsive: true,
        //     autoWidth: false,
        //     ajax: {
        //         url: "{{ route('reading.get.list') }}",
        //         method: 'GET',
        //         dataType: 'json',
        //         data: {
        //             date: data
        //         },
        //         dataSrc: "",
        //     },
        //     columns: [
        //         { data: "acc_id", title: "Tenant #" }
        //     ],
        //     rowCallback: function (row, data, dataIndex) {
        //         $(row).attr({
        //             "data-bs-toggle": "collapse",
        //             "data-bs-target": `#utility_bill_${dataIndex}`,
        //             "aria-expanded": "false",
        //             "aria-controls": `utility_bill_${dataIndex}`,
        //             "style": "cursor: pointer;"
        //         });
        //         let collapseDiv = `
        //         <tr class="collapse" id="utility_bill_${dataIndex}">
        //             <td colspan="4">
        //                 <div class="mt-4">
        //                     <table class="table table-bordered">
        //                         <thead class="thead-light">
        //                             <tr>   
        //                                 <th>Contract #</th>
        //                                 <th>Status</th>
        //                                 <th>Reading Status</th>
        //                                 <th>Action</th>
        //                             </tr>
        //                         </thead>
        //                         <tbody>        
        //                         </tbody>
        //                     </table>
        //                 </div>
        //             </td>
        //         </tr>
        //         `;
        //         $(row).after(collapseDiv);
        //     }
        // });

        const table = $("#operations-tenant-reading").DataTable({
            pageLength: 10,
        });

        $('#utilityListModal').on('show.bs.modal', function (event) {
            var date = $(event.relatedTarget).data('date');

            $.ajax({
                url: "{{ route('reading.get.list') }}",
                method: 'GET',
                dataType: 'json',
                data: {
                    date: date
                },
                success: function (data) {
                    $('#appendInputHere').empty();
                    table.clear();
                    $.each(data, function (key, value) {
                        let nestedRows = '';

                        $.each(value.proposals, function (ke, val) {
                            let hasReading = false;
                            let noReading = true;

                            $.each(val.utilities, function (idx, utility) {
                                if (utility.readings !== null) {
                                    hasReading = true;
                                    noReading = false;
                                }
                            });

                            let readingStatus = '';
                            if (noReading) {
                                readingStatus = 'No reading yet';
                            } else if (hasReading && val.utilities.length === 1) {
                                readingStatus = 'All have readings';
                            } else {
                                readingStatus = 'Some have readings';
                            }

                            $('#appendInputHere').append(`
                                <input type="text" name="bill_id[]" value="${val.billing.id}" hidden/>
                            `);

                            nestedRows += `
                                <tr>
                                    <td>${val.proposal_uid}</td>
                                    <td>${val.billing.is_reading == 0 ? 'Not Prepared' : val.billing.is_reading == 1 ? 'Processed' : 'Prepared'}</td>
                                    <td>${readingStatus}</td>
                                    <td>
                                        <a class="btn btn-sm btn-warning"
                                            data-bs-toggle="modal"
                                            data-bs-target="#contractUtilityLists"
                                            data-date="${date}"
                                            data-proposal-id="${val.id}" 
                                            data-id="${val.billing.id}">
                                        <i class="fa fa-pen"></i>
                                        </a>
                                    </td>
                                </tr>
                            `;
                        });

                        table.row.add([
                            `<div data-bs-toggle="collapse" data-bs-target="#utility_bill${key}" aria-expanded="false" aria-controls="utility_bill${key}" style="cursor: pointer;">
                                ${value.acc_id}
                            </div>
                            <div class="collapse mt-4" id="utility_bill${key}">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>   
                                            <th>Contract #</th>
                                            <th>Status</th>
                                            <th>Reading Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${nestedRows}
                                    </tbody>
                                </table>
                            </div>`
                        ]);
                    });

                    table.draw();
                },
                error: function (status, xhr, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('.prepareBilling').click(function () {
            var form = $('#billReadingForm')[0];
            var formdata = new FormData(form);

            $.ajax({
                url: "{{ route('reading.save') }}",
                method: 'POST',
                data: formdata,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    $('#utilityListModal').modal('hide');
                    var content;

                    if (response.status == 'success') {
                        content = {
                            message: response.message,
                            title: response.status,
                            icon: "fa fa-bell"
                        }
                    } else {
                        content = {
                            message: response.message,
                            title: response.status,
                            icon: "fa fa-bell"
                        }
                    }
                    $.notify(content, {
                        type: response.status,
                        placement: {
                            from: 'top',
                            align: 'right',
                        },
                        time: 1000,
                        delay: 2500,
                    })
                },
                error: function (status, xhr, error) {
                    console.log(xhr.responseText);
                }
            });
        });

    });
</script>