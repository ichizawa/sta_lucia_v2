<div class="modal fade" id="editChargeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editChargeForm" action="{{route('submit.charges')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Charge</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Charge Name</label>
                                <input type="text" class="form-control" id="charge_name" name="chargename">
                                </input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Charge Fee</label>
                                <input type="number" class="form-control" id="charge_fee" name="chargefee" step="any">
                                </input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Charge Frequency</label>
                                <input type="text" class="form-control" id="charge_freq" name="chargefrequency">
                                </input>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sta">
                        Update
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#editChargeForm')[0].reset();
        $('.editCharge').click(function(){
            var charges = $(this).data('charges');
            $('#charge_id').val(charges.id);
            $('#charge_name').val(charges.charge_name);
            $('#charge_fee').val(charges.charge_fee);
            $('#charge_freq').val(charges.frequency);

            // Set the form action to the update route
            $('#editChargeForm').attr('action', '/admin/charges/' + charges.id + '/update');
        });
    });
</script>