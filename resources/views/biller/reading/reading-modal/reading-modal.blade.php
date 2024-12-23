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
    $(document).ready(function () {
        const table = $("#utilityreading-datatable").DataTable({
            pageLength: 10,
        });

        $('#utilityListModal').on('show.bs.modal', function (event) {
            var date = $(event.relatedTarget).data('date');

            $.ajax({
                url: "{{ route('utility.reading.get') }}",
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
                                    <td>${val.billing.is_prepared == 0 ? 'Not Prepared' : val.billing.is_prepared == 1 ? 'Processed' : 'Prepared'}</td>
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
                url: "{{ route('utility.reading.save') }}",
                method: 'POST',
                data: formdata,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                },
                error: function (status, xhr, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>