<div class="modal fade" id="utilityListModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    $(document).on('click', '.utilityReadingModal', function () {
        var date = $(this).data('date');

        $.ajax({
            url: "{{ route('utility.reading.get') }}",
            method: 'GET',
            dataType: 'json',
            data: {
                date: date
            },
            success: function (data) {
                // $('#utilityTableList').empty();
                // $.each(data, function (key, value) {
                //     $('#utilityTableList').append(`
                //         <tr data-bs-toggle="collapse" data-bs-target="#utility_bill${key}" aria-expanded="false" aria-controls="#utility_bill${key}">
                //             <td>${value.company.acc_id}</td>
                //         </tr>
                //         <tr class="collapse" id="utility_bill${key}">
                //             <td>
                //                 <table class="table">
                //                     <thead class="thead-light">
                //                         <tr>
                //                             <th scope="col" colspan="2">Contract #</th>
                //                             <th scope="col">Action</th>
                //                         </tr>
                //                     </thead>
                //                     <tbody>
                //                         <tr>
                //                             <td colspan="2">${value.proposal.proposal_uid}</td>
                //                             <td>
                //                                 <button class="btn btn-sm btn-warning contractUtil" data-bs-toggle="modal" data-bs-target="#contractUtilityLists" data-id="${value.billing_id}">
                //                                 <i class="fa fa-pen"></i>
                //                                 </button>
                //                             </td>
                //                         </tr>
                //                     </tbody>
                //                 </table>
                //             </td>
                //         </tr>
                //     `);
                // });

            },
            error: function (status, xhr, error) {
                console.log(xhr.responseText);
            }
        });
    });
</script> -->