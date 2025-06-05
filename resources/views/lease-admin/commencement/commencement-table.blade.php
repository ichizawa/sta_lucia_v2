@extends('layouts')

@section('content')
    <div class="modal fade" id="comm-date-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form id="comm-date-form" method="POST">
          @csrf
          <div class="modal-content">
            <div class="modal-header brown-border-top">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Commencement Date Update</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="prop_num">Proposal Number</label>
                      <select
                        id="prop_num"
                        name="prop_num"
                        class="form-control"
                        required
                        >
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="comm_date">Commencement Date</label>
                      <input
                        id="comm_date"
                        type="month"
                        name="comm_date"
                        class="form-control"
                        required
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-sta">Save changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3 title">Commencement</h3>
                <h6 class="op-7 mb-2">Lease Start Overview</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Commencements</h4>
                            <button class="btn btn-sta ms-auto edit-comm-date" data-bs-toggle="modal"
                                data-bs-target="#comm-date-modal">
                                <i class="fa fa-plus"></i>
                                Update Commencement
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                id="lease_admin_comm_table"
                                class="display table table-striped table-hover w-100"
                                style="width:100%;"
                            >
                                <thead>
                                    <tr>
                                        <th class="text-center">Proposal Number</th>
                                        <th class="text-center">Tenant Name</th>
                                        <th class="text-center">Date Created</th>
                                        <th class="text-center">Commencement Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


     <script>
$(document).ready(function() {
    var table = $('#lease_admin_comm_table').DataTable({
        pageLength: 10,
        responsive: true,
        ajax: {
            url: "{{ route('lease.admin.commencement.data') }}",
            dataSrc: 'data'
        },
        columns: [
            { data: 'proposal_uid',   className: 'text-center' },
            { data: 'tenant_name',    className: 'text-center' },
            { data: 'date_created',   className: 'text-center' },
            {

                data: 'commencement_date',
                className: 'text-center',
                render: function(data) {
                    return data && data !== 'Not Approved yet'
                        ? data
                        : 'Not Approved yet';
                }
            }
        ]
    });

    let proposals = @json($proposal);

    var $propSelect = $('#prop_num').selectize({
        sortField: 'text',
        maxItems: 1,
        placeholder: 'Select Proposal Number'
    });
    var selectize = $propSelect[0].selectize;

    function populateProposalDropdown() {
        selectize.clearOptions();
        selectize.clear();

        $.each(proposals, function(_, value) {
            if (
                ! value.commencement_proposal ||
                ! value.commencement_proposal.commencement_date
            ) {
                selectize.addOption({
                    value: value.id,
                    text: value.proposal_uid
                });
            }
        });

        selectize.refreshOptions(false);
        $('#comm_date').val('');
    }

    $('.edit-comm-date').on('click', function() {
        populateProposalDropdown();
    });

    $('#comm-date-form').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('lease.admin.commencement.update') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#comm-date-modal').modal('hide');

                if (response.status === 'success') {
                    swal('Success', 'Commencement Date Updated', 'success')
                        .then(() => {
                            window.location.reload();
                        });
                } else {
                    swal('Error', response.message, 'error');
                }
            },
            error: function() {
                swal('Error', 'An unexpected error occurred.', 'error');
            }
        });
    });

    Pusher.logToConsole = true;
    const pusher = new Pusher('1eedc3e004154aadb5dc', {
        cluster: 'ap1',
        forceTLS: true
    });
    var channel = pusher.subscribe('lease-admin-channel');
    channel.bind('lease-admin-event', function(data) {
        window.location.reload();
    });
});
</script>

@endsection
