<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
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
        <button type="button" class="btn btn-sta"
                data-bs-toggle="modal"
                data-bs-target="#utilityListModal"
                id="backbtn">Back
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {

    let utilTable;
    let lastProposalId = null;
    let lastDate       = null;

    if (!$.fn.DataTable.isDataTable('#utilityreading-datatable')) {
      utilTable = $('#utilityreading-datatable').DataTable({
        ordering: false,
        paging:   false,
        searching:false,
        info:     false,
        columns: [
          { title: "Utility Name",    className: 'text-center' },
          { title: "Utility Reading", className: 'text-center' },
          { title: "Status",          className: 'text-center' },
          { title: "Action",          className: 'text-center' }
        ]
      });
    } else {
      utilTable = $('#utilityreading-datatable').DataTable();
    }

    function loadUtilityRows(proposalId, date) {
      lastProposalId = proposalId;
      lastDate       = date;

      $('#contractTableUtility').empty();
      utilTable.clear().draw();

      $.ajax({
        url: "{{ url('utility/utility-lists') }}",
        type: "GET",
        dataType: "json",
        data: {
          proposal_id: proposalId
        },
        success: function(data) {

          if (!data.utilities || data.utilities.length === 0) {
            const noRowHtml = `
              <tr>
                <td colspan="4" class="text-center text-muted">
                  No utilities found for this proposal.
                </td>
              </tr>`;
            $('#contractTableUtility').append(noRowHtml);
            utilTable.row.add([
              `<td colspan="4" class="text-center text-muted">
                 No utilities found for this proposal.
               </td>`
            ]).draw();
            return;
          }

          const seen    = new Set();
          const uniqueU = [];
          data.utilities.forEach(function(u) {
            if (!seen.has(u.id)) {
              seen.add(u.id);
              uniqueU.push(u);
            }
          });

          uniqueU.forEach(function(u) {
            const readingVal = u.util_read
                             ? parseFloat(u.util_read.total_reading).toFixed(2)
                             : 'No Reading Yet';

            const statusVal  = u.util_read
                             ? (u.util_read.prepare ? 'Prepared' : 'Not Prepared')
                             : 'No Reading Yet';

            $('#appendInputHere').append(`
              <input type="hidden" name="bill_id[]" value="${data.billing.id}" />
            `);

            const rowHtml = `
              <tr>
                <td class="text-center">${u.util_desc.utility_name}</td>
                <td class="text-center">${readingVal}</td>
                <td class="text-center">${statusVal}</td>
                <td class="text-center">
                  <button
                    class="btn btn-sm btn-warning"
                    data-date="${date}"
                    data-proposal-id="${proposalId}"
                    data-bill-id="${data.billing.id}"
                    data-utility-id="${u.id}"
                    data-bs-toggle="modal"
                    data-bs-target="#utilityReadingModal"
                  >
                    <i class="fa fa-pen"></i>
                  </button>
                </td>
              </tr>`;

            $('#contractTableUtility').append(rowHtml);

            utilTable.row.add([
              `<td class="text-center">${u.util_desc.utility_name}</td>`,
              `<td class="text-center">${readingVal}</td>`,
              `<td class="text-center">${statusVal}</td>`,
              `<td class="text-center">
                 <button
                   class="btn btn-sm btn-warning"
                   data-date="${date}"
                   data-proposal-id="${proposalId}"
                   data-bill-id="${data.billing.id}"
                   data-utility-id="${u.id}"
                   data-bs-toggle="modal"
                   data-bs-target="#utilityReadingModal"
                 >
                   <i class="fa fa-pen"></i>
                 </button>
               </td>`
            ]).draw();
          });
        },
        error: function(xhr) {
          console.error("AJAX error in utility-lists:", xhr.responseText);
          const errorRow = `
            <tr>
              <td colspan="4" class="text-center text-danger">
                Error loading utilities.
              </td>
            </tr>`;
          $('#contractTableUtility').append(errorRow);
          utilTable.row.add([
            `<td colspan="4" class="text-center text-danger">Error loading utilities.</td>`
          ]).draw();
        }
      });
    }

    $('#contractUtilityLists').off('show.bs.modal');
    $('#contractUtilityLists').on('show.bs.modal', function(event) {
      const button      = $(event.relatedTarget);
      const proposalId  = button.data('proposal-id');
      const date        = button.data('date');
      $('#backbtn').attr('data-date', date);
      loadUtilityRows(proposalId, date);
    });

    $('.prepareBilling').click(function() {
      const formEl  = $('#billReadingForm')[0];
      const formData = new FormData(formEl);
      $.ajax({
        url: "{{ url('utility/save-reading') }}",
        method: 'POST',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
          $('#contractUtilityLists').modal('hide');
          $.notify({
            message: response.message,
            title: response.status,
            icon: "fa fa-bell"
          }, {
            type: response.status,
            placement: { from: 'top', align: 'right' },
            time: 1000,
            delay: 2500,
          });
        },
        error: function(xhr) {
          console.error("AJAX error in reading.save:", xhr.responseText);
        }
      });
    });

    console.log("[Pusher] Initializing…");
    Pusher.logToConsole = true;

    const pusher = new Pusher('1eedc3e004154aadb5dc', {
      cluster: 'ap1',
      forceTLS: true
    });

    const channel = pusher.subscribe('utilityreading-channel');

    channel.bind('pusher:subscription_succeeded', function() {
      console.log("[Pusher] Subscribed to channel 'utilityreading-channel'");
    });
    channel.bind('pusher:subscription_error', function(status) {
      console.error("[Pusher] Subscription error:", status);
    });

    channel.bind('my-utilityreading', function(payload) {
      console.log("🔁 [Pusher] 'my-utilityreading' event received:", payload);

      const proposalId   = payload.proposal_id;
      const newDateReading = payload.date_reading;

      if ($('#contractUtilityLists').hasClass('show')) {
        console.log(`[Pusher] reload loadUtilityRows(${proposalId}, ${newDateReading})`);
        loadUtilityRows(proposalId, newDateReading);
      }

      else {
        lastProposalId = proposalId;
        lastDate       = newDateReading;
        console.log(`[Pusher] modal is closed; saved lastProposalId=${proposalId}, lastDate=${newDateReading}`);
      }
    });
  });
</script>
