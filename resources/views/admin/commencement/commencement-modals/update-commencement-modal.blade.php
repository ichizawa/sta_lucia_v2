<div class="modal fade" id="comm-date-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="comm-date-form" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Commencement Date Update</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Proposal Number</label>
                                    <select id="prop_num" name="prop_num[]" placeholder="Proposal Number" required>
                                        <option value="" selected hidden disabled>Select Proposal Number</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Commencement Date</label>
                                    <input type="month" name="comm_date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#comm_table').DataTable({
            pagelength: 10,
        });

        var $prop = $('#prop_num').selectize({
            sortField: 'text',
            maxItems: null,
            placeholder: 'Select Proposal Number'
        });

        $('.edit-comm-date').click(function () {
            var data = @json($proposal);
            var select = $prop[0].selectize;
            $.each(data, function (key, value) {
                if(value.commencement_date == null){
                    select.addOption({
                        value: value.id,
                        text: value.proposal_uid
                    });
                    select.refreshOptions(false);
                }
            });
        });

        $('#comm-date-form').submit(function (e) {
            e.preventDefault();
            var form = new FormData(this);
            $.ajax({
                url: "{{ route('commencement.update') }}",
                type: 'POST',
                data: form,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#comm-date-modal').modal('hide');
                    if(response.status == 'success'){
                        swal('Success', 'Commencement Date Updated', 'success').then(() => {
                            window.location.reload();
                        });
                    }
                }
            });
        });
    });
</script>