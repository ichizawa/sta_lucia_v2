<div class="modal fade" id="contractUtilityLists" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Utilities</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="utilityreading-datatable" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Utility Name</th>
                                <th>Utility Reading</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="contractTableUtility">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sta" data-bs-toggle="modal" data-bs-target="#utilityListModal"
                    id="backbtn">Back</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#contractUtilityLists').on('show.bs.modal', function (event) {
            var id = $(event.relatedTarget).data('proposal-id');
            var date = $(event.relatedTarget).data('date');
            $('#backbtn').attr('data-date', date);

            $.ajax({
                url: "{{ route('utility.reading.lists') }}",
                type: "GET",
                dataType: "json",
                data: {
                    proposal_id: id
                },
                success: function (data) {
                    $('#contractTableUtility').empty();
                    $.each(data.utilities, function (key, value) {
                        $('#contractTableUtility').append(`
                            <tr>
                                <td>${value.util_desc.utility_name}</td>
                                <td>${value.utilities_reading == null ? 'No Reading Yet' : value.utilities_reading?.prepare == 2 ? 'Prepared Reading' : value.utilities_reading.prepare == 0 ? 'Pending Reading' : 'Paid Reading'}</td>
                                <td>
                                <button class="btn btn-sm btn-warning"
                                    data-date="${date}"
                                    data-proposal-id="${id}"
                                    data-bill-id="${data.billing.id}"
                                    data-utility-id="${value.id}" 
                                    data-bs-toggle="modal" data-bs-target="#utilityReadingModal">
                                        <i class="fa fa-pen"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>