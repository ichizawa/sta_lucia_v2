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
                <button type="button" class="btn btn-sta" data-bs-toggle="modal"
                    data-bs-target="#utilityListModal">Back</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#contractUtilityLists').on('show.bs.modal', function (event) {
            var id = $(event.relatedTarget).data('id');
            var date = $(event.relatedTarget).data('date');

            $.ajax({
                url: "{{ route('utility.reading.lists') }}",
                type: "GET",
                dataType: "json",
                data: {
                    id: id
                },
                success: function (data) {
                    $('#contractTableUtility').empty();
                    $.each(data.utilities, function (key, value) {
                        $('#contractTableUtility').append(`
                            <tr>
                                <td>${value.utility_name}</td>
                                <td>${value.reading == null ? '-' : parseFloat(value.reading.total_reading).toFixed(2)}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-id="${data.id}" data-date-reading="${date}" data-utility-id="${value.selected_utility_id}" data-bs-toggle="modal" data-bs-target="#utilityReadingModal">
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