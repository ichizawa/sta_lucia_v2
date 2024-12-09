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
                        <table id="utilityreading-datatable" class="table table-hover">
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
                    <button type="button" class="btn btn-sta prepareBilling">Prepare Reading</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        const table = $("#utilityreading-datatable").DataTable({
            pageLength: 10,
        });

        $('#utilityListModal').on('show.bs.modal', function(event) {
            var date = $(event.relatedTarget).data('date');

            $.ajax({
                url: "{{ route('utility.reading.get') }}",
                method: 'GET',
                dataType: 'json',
                data: {
                    date: date
                },
                success: function(data) {
                    $('#appendInputHere').empty();
                    table.clear();
                    $.each(data, function(key, value) {
                        let nestedRows = '';
                        let utilRows = '';
                        let utilTDRows = '';
                        console.log(value);
                        $.map(value.proposals, function(util, ind) {
                            $.each(util.utilities, function(k, v){
                                utilRows += `
                                    <th>${v.util_desc.utility_name}</th>
                                `;
                                utilTDRows += `
                                    <td>${v.utilities_reading == null ? 'No Reading Yet' : ''}</td>
                                `;
                            });
                        });

                        $.each(value.proposals, function(ke, val) {
                            nestedRows += `
                                <tr>
                                    <td>${val.proposal_uid}</td>
                                    <td>${val.billing.is_prepared == 0 ? 'Not Prepared' : val.billing.is_prepared == 1 ? 'Processed' : 'Prepared'}</td>
                                    <td></td>
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
                                            ${utilRows}
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

                    // $.each(data, function (key, value) {
                    //     if (value.proposal.length !== 0) {
                    //         let nestedTableRows = '';
                    //         $.map(value.proposal, function (val, index) {
                    //             let allUtilitiesPrepared = true;
                    //             let allUtilitiesPaid = true;

                    //             val.utilities.forEach(function (utility) {
                    //                 if (utility.prepare !== 2) {
                    //                     allUtilitiesPrepared = false;
                    //                 }
                    //                 if (utility.prepare !== 0) {
                    //                     allUtilitiesPaid = false;
                    //                 }
                    //             });

                    //             let readingStatus = '';
                    //             if (allUtilitiesPrepared) {
                    //                 readingStatus = 'Reading Prepared';
                    //             } else if (allUtilitiesPaid) {
                    //                 readingStatus = 'Reading Paid';
                    //             } else {
                    //                 readingStatus = 'Reading Pending';
                    //             }

                    //             nestedTableRows += `
                    //             <tr>
                    //                 <td>${val.contract_uid}</td>
                    //                 <td>${val.bill_status == 2 ? 'Bill Prepared' : val.bill_status == 1 ? 'Bill Paid' : 'Bill Pending'}</td>
                    //                 <td>${readingStatus}</td>
                    //                 <td>
                    //                     <a class="btn btn-sm btn-warning"
                    //                         data-bs-toggle="modal"
                    //                         data-bs-target="#contractUtilityLists"
                    //                         data-date="${date}" 
                    //                         data-proposal-id="${val.proposal_id}" 
                    //                         data-id="${val.bill_id}">
                    //                     <i class="fa fa-pen"></i>
                    //                     </a>
                    //                 </td>
                    //             </tr>`;

                    //             $('#appendInputHere').append(`
                    //                 <input type="text" value="${val.bill_id}" name="bill_id[]" hidden/>
                    //             `);
                    //         });


                    //         table.row.add([
                    //             `<div data-bs-toggle="collapse" data-bs-target="#utility_bill${key}" aria-expanded="false" aria-controls="utility_bill${key}" style="cursor: pointer;">
                    //                 ${value.acc_id}
                    //             </div>
                    //             <div class="collapse mt-4" id="utility_bill${key}">
                    //                 <table class="table table-bordered">
                    //                     <thead class="thead-light">
                    //                         <tr>   
                    //                             <th>Contract #</th>
                    //                             <th>Status</th>
                    //                             <th>Reading Status</th>
                    //                             <th>Action</th>
                    //                         </tr>
                    //                     </thead>
                    //                     <tbody>
                    //                         ${nestedTableRows}
                    //                     </tbody>
                    //                 </table>
                    //             </div>`,
                    //         ]);
                    //     }
                    // });

                },
                error: function(status, xhr, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('.prepareBilling').click(function() {
            var form = $('#billReadingForm')[0];
            var formdata = new FormData(form);

            $.ajax({
                url: "{{ route('utility.reading.save') }}",
                method: 'POST',
                data: formdata,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                },
                error: function(status, xhr, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>