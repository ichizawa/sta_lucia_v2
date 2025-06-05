<div class="modal fade" id="leaseProposal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid" style="height: 84vh;">
                    <iframe id="proposal-pdf" src="" width="100%" height="100%"
                        style="border: none;"></iframe>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="rejectNewProposal" class="btn btn-danger">Reject</button>
                <button type="button" id="approveNewProposal" class="btn btn-success">Approve</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProposal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Revised Leased Proposals</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Proposals</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">

                            </tbody>
                        </table>
                    </div>
                    <div class="container-fluid" id="counterProposalBTN">
                        <div class="row justify-content-end">
                            <div class="col-auto ">
                                <a class="btn btn-sta counterProposalsAdd" data-bs-toggle="modal"
                                    id="counterProposalsAdd" data-bs-target="#counterProposals">Add Revised Leased
                                    Proposal</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-sta">Save changes</button> -->
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="viewCounterProposal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Revised Leased Proposals</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid" style="height: 84vh;">
                    <iframe id="counter-proposal-pdf" src="" width="100%" height="100%"
                        style="border: none;"></iframe>
                </div>
            </div>
            <div class="modal-footer" id="counter-proposal-footer">
                <button type="button" id="rejectCounter" class="btn btn-danger">Reject</button>
                <button type="button" id="approveCounter" class="btn btn-success">Approve</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
  // ───────────── 0) Initialize DataTable with rowId: 'id' ─────────────────
  let dtProposal;
  if (! $.fn.DataTable.isDataTable('#multi-filter-select')) {
    dtProposal = $('#multi-filter-select').DataTable({
      rowId: 'id', // ← each <tr> becomes id="row_<rowData.id>"
      processing: false,
      serverSide: false,
      ajax: {
        url: "{{ route('leases.proposal.data') }}",
        dataSrc: ''
      },
      columns: [
        {
          data: 'company_name',
          className: 'text-center',
          render: data => data || 'N/A'
        },
        {
          data: 'property_codes',
          className: 'text-center',
          render: data => data || 'N/A'
        },
        {
          data: 'total_space_area',
          className: 'text-center',
          render: data => (data ? data + ' sqm' : 'N/A')
        },
        {
          data: 'tenant_type',
          className: 'text-center',
          render: data => data || 'N/A'
        },
        {
          data: 'status',
          className: 'text-center',
          render: val => {
            if (val === null || val === undefined) {
              return '<span class="badge bg-secondary">N/A</span>';
            }
            const st = parseInt(val, 10);
            if (st === 1) {
              return '<span class="badge bg-success">Approved</span>';
            } else if (st === 2) {
              return '<span class="badge bg-danger">Rejected</span>';
            } else {
              return '<span class="badge bg-warning">Pending</span>';
            }
          }
        },
        {
          data: null,
          orderable: false,
          searchable: false,
          className: 'text-center',
          render: row => `
            <button class="btn btn-sm btn-success showProposalContents"
                    data-show-proposal-id="${row.id}"
                    data-bs-toggle="modal"
                    data-bs-target="#leaseProposal">
              <i class="fa fa-eye"></i>
            </button>
            <button class="btn btn-sm btn-warning editProposalContents"
                    data-edit-proposal-id="${row.id}"
                    data-bs-toggle="modal"
                    data-bs-target="#editProposal">
              <i class="fa fa-pen"></i>
            </button>`
        }
      ],
      autoWidth: false,
      responsive: true,
      language: {
        info: "_START_-_END_ of _TOTAL_ proposals",
        searchPlaceholder: "Search proposals",
        paginate: {
          next: '<i class="dw dw-right-chevron"></i>',
          previous: '<i class="dw dw-left-chevron"></i>'
        }
      },
      order: [[0, 'asc']]
    });
  }

  // ───────────── 1) Pusher: full table reload on other-user updates ─────────────────
  Pusher.logToConsole = true;
  const pusher  = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
    cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
    forceTLS: true
  });
  const channel = pusher.subscribe('lease-channel');
  channel.bind('proposal-updated', () => {
    console.log('Pusher event: reloading full proposals table');
    dtProposal.ajax.reload(null, false);
  });

  // ───────────── 2) SHOW PROPOSAL (attach proposal_id to modal buttons) ─────────────────
  $(document).on('click', '.showProposalContents', function() {
    $('#exampleModalLabel').empty();
    const proposal_id = $(this).data('show-proposal-id');
    console.log("Opening modal for proposal_id =", proposal_id);

    // Clear PDF iframe + ensure both buttons are visible & enabled
    $('#proposal-pdf').attr('src', '');
    $('#rejectNewProposal').attr('disabled', false).show();
    $('#approveNewProposal').attr('disabled', false).show();

    // Attach ID to modal buttons
    $('#rejectNewProposal').attr('data-proposal-id', proposal_id);
    $('#approveNewProposal').attr('data-proposal-id', proposal_id);

    // Fetch PDF & status from server
    $.ajax({
      url: "{{ route('lease.show.proposal') }}",
      type: "GET",
      data: { proposal_id: proposal_id },
      success: function(data) {
        if (data.pdf_url) {
          $('#proposal-pdf').attr('src', data.pdf_url + '#zoom=175');
        }
        if (data.document_status.status == 0) {
          $('#exampleModalLabel').append(
            `Lease Proposal <span class="badge bg-danger">Files still not uploaded!</span>`
          );
          $('#approveNewProposal').attr('disabled', true);
        } else {
          $('#exampleModalLabel').append(`Lease Proposal`);
          if (data.data[0].status == 1) {
            $('#rejectNewProposal, #approveNewProposal').hide();
          } else {
            $('#rejectNewProposal, #approveNewProposal').show().removeAttr('disabled');
          }
        }
      }
    });
  });

  // ───────────── 3) APPROVE NEW PROPOSAL → immediate row update ─────────────────
  $(document).on('click', '#approveNewProposal', function() {
    const proposal_id = $(this).data('proposal-id');
    console.log("Approve clicked (new) → proposal_id =", proposal_id);

    swal({
      title: "Are you sure?",
      text: "You want to approve this proposal!",
      icon: "warning",
      buttons: ["Cancel", "Confirm"],
      dangerMode: true
    }).then(willApprove => {
      if (willApprove) {
        proposalOptions(proposal_id, 1, 'new');
      }
    });
  });

  // ───────────── 4) REJECT NEW PROPOSAL → immediate row update ─────────────────
  $(document).on('click', '#rejectNewProposal', function() {
    const proposal_id = $(this).data('proposal-id');
    console.log("Reject clicked (new) → proposal_id =", proposal_id);

    swal({
      title: "Are you sure?",
      text: "You want to reject this proposal!",
      icon: "warning",
      buttons: ["Cancel", "Confirm"],
      dangerMode: true
    }).then(willReject => {
      if (willReject) {
        proposalOptions(proposal_id, 2, 'new');
      }
    });
  });

  // ───────────── 5) CORE AJAX FUNCTION: update DataTable row in place ─────────────────
  function proposalOptions(proposal_id, option, set) {
    console.log("AJAX →", { proposal_id, option, set });

    $.ajax({
      url: "/admin/leases/lease-option-proposal/" + set,
      type: "POST",
      data: {
        _token: "{{ csrf_token() }}",
        proposal_id: proposal_id,
        option: option
      },
      success: function(data) {
        // 5a) Close modals
        $('#leaseProposal').modal('hide');
        $('#viewCounterProposal').modal('hide');

        // 5b) Show toast/notification
        $.notify({
          message: data.message,
          title: data.status,
          icon: "fa fa-bell"
        }, {
          type: data.status,
          placement: { from: 'top', align: 'right' },
          time: 1000,
          delay: 1200,
          z_index: 10000
        });

        // 5c) Find the DataTable row by its DOM <tr id="row_<proposal_id>">
        if (set === 'new') {
          // prepend "row_" because DataTables added that prefix automatically
          const rowSelector = '#row_' + proposal_id;
          const rowApi = dtProposal.row(rowSelector);
          if (rowApi.any()) {
            // 5c-i) Update underlying data object
            let rowData = rowApi.data();
            rowData.status = option; // 1 = Approved, 2 = Rejected

            // 5c-ii) Write it back and redraw only that row
            rowApi.data(rowData).draw(false);

            // 5c-iii) Overwrite the status cell's HTML for immediate effect
            let badgeHtml = (option === 1)
              ? '<span class="badge bg-success">Approved</span>'
              : '<span class="badge bg-danger">Rejected</span>';
            $(rowSelector).find('td').eq(4).html(badgeHtml);
          }
        }
      },
      error: function(xhr, status, error) {
        console.error("AJAX error:", status, error);
      }
    });
  }

  // ───────────── 6) (Optional) APPROVE COUNTER PROPOSAL ─────────────────
  $(document).on('click', '#approveCounter', function() {
    const counter_id = $(this).data('counter-proposal-id');

    swal({
      title: "Are you sure?",
      text: "You want to approve this counter proposal!",
      icon: "warning",
      buttons: ["Cancel", "Confirm"],
      dangerMode: true
    }).then(willApprove => {
      if (willApprove) {
        proposalOptions(counter_id, 1, 'counter');
      }
    });
  });

  // ───────────── 7) (Optional) REJECT COUNTER PROPOSAL ─────────────────
  $(document).on('click', '#rejectCounter', function() {
    const counter_id = $(this).data('counter-proposal-id');

    swal({
      title: "Are you sure?",
      text: "You want to reject this counter proposal!",
      icon: "warning",
      buttons: ["Cancel", "Confirm"],
      dangerMode: true
    }).then(willReject => {
      if (willReject) {
        proposalOptions(counter_id, 2, 'counter');
      }
    });
  });
});
</script>
