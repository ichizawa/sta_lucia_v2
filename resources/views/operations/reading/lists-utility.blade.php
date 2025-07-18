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
                                <th class="text-center">Utility Name</th>
                                <th class="text-center">Utility Reading</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
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
    $(document).ready(function() {
        $('#contractUtilityLists').on('show.bs.modal', function(event) {
            var id = $(event.relatedTarget).data('proposal-id');
            var date = $(event.relatedTarget).data('date');

            // console.log('id from list utility:' + id);

            $('#backbtn').attr('data-date', date);

            $.ajax({
                url: "{{ route('reading.lists.utility') }}",
                type: "GET",
                dataType: "json",
                data: {
                    proposal_id: id
                },
                success: function(data) {
                    $('#contractTableUtility').empty();
                    $.each(data.utilities, function(key, value) {
                        $('#contractTableUtility').append(`
                            <tr>
                                <td class="text-center">${value.util_desc.utility_name}</td>
                                <td class="text-center">${value.util_read ? parseFloat(value.util_read.total_reading).toFixed(2) : 'No Reading Yet'}</td>
                                <td class="text-center">${value.util_read ? value.util_read.prepare ? 'Prepared' : 'Not Prepared' : 'No Reading Yet'}</td>
                                <td class="text-center">
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
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
