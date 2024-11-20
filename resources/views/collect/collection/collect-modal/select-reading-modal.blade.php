<div class="modal fade" id="utilityListModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Utility Reading Lists</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Utility Name</th>
                                <th scope="col">Reading Charge</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="utilityTableList">
                        <!-- <tr>
                                <td scope="row">Gas</td>
                                <td>1855.50</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#utilityReadingModal">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </td>
                            </tr> -->
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
<script>
    $(document).ready(function () {
        $('.utilityList').click(function () {
            var id = $(this).data('id');
            var data = @json($billing);

            $.map(data, function (value, index) {
                if (value.id == id) {
                    var utilities = value.proposal[0].utilities;
                    // ${ parseFloat(value.utility_price).toFixed(2) }
                    $('#utilityTableList').empty();
                    $.each(utilities, function (key, value) {
                        $('#utilityTableList').append(`
                           <tr>
                               <td scope="row">${value.utility_name}</td>
                               <td></td>
                               <td>
                                   <button class="btn btn-warning btn-sm specificMeterReading" data-bs-toggle="modal"
                                       data-bs-target="#utilityReadingModal" data-soa-id="${id}" data-reading-id="${value.id}">
                                       <i class="fa fa-edit"></i>
                                   </button>
                               </td>
                           </tr>
                       `);
                    });

                    $('.specificMeterReading').click(function () {
                        var soaId = $(this).data('soa-id');
                        var readingId = $(this).data('reading-id');
                        $('#bill_id').val(soaId);
                        // $.map(value.proposal[0].utilities, function(value, index) {
                        //     if (value.id == readingId) {

                        //     }
                        // });
                    });
                }
            });
        });
    });
</script>