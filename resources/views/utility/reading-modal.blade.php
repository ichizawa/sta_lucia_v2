
<script src="https://js.pusher.com/7.2/pusher.min.js"></script><!-- ============================
     1️⃣ Modal HTML
     ============================ -->
<div class="modal fade" id="utilityListModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form id="billReadingForm" method="POST">
      @csrf

      <div class="modal-content">
        <div class="modal-header brown-border-top">
          <h1 class="modal-title fs-5">Utility Reading Lists</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="table-responsive">
            <table id="utility-tenant-reading"
                   class="table table-hover table-striped table-bordered w-100">
              <thead class="thead-light">
                <tr>
                  <th>Tenant #</th>
                </tr>
              </thead>
              <tbody id="utilityTableList">
                {{-- DataTables will append rows here --}}
              </tbody>
            </table>
          </div>
        </div>

        <!-- This DIV holds one <input name="bill_id[]" value="…"> for each proposal -->
        <div id="appendInputHere">
          <input type="hidden" name="dateToRead" id="dateToRead" />
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-sta prepareBilling">Process Reading</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- =======================================
     2️⃣ JavaScript / jQuery + DataTables
     ======================================= -->
<script>
  $(function() {
    // ──────────────────────────────────────────────────────────
    //  A) Initialize the DataTable on #utility-tenant-reading.
    //     Because our <thead> has exactly ONE <th>, each row MUST
    //     supply exactly ONE <td> (which itself wraps a nested table).
    // ──────────────────────────────────────────────────────────
    const tenantTable = $('#utility-tenant-reading').DataTable({
      pageLength: 10,
      ordering:   false,
      searching:  false,
      paging:     false,
      info:       false
    });

    // Keep track of the last “date” so we know what to reload
    let lastDate = null;

    // ───────────────────────────────────────────────────────
    //  B) loadTenantReading(date): AJAX‐fetch _and_ re‐populate that table
    // ───────────────────────────────────────────────────────
    function loadTenantReading(date) {
      console.log("[loadTenantReading] called with date =", date);
      lastDate = date;

      // 1) Remove any old hidden inputs & clear the DataTable rows
      $('#appendInputHere').empty();
      tenantTable.clear().draw();

      // 2) Fire one AJAX request to fetch the "company→proposals→billing" data:
      $.ajax({
        url: "{{ url('utility/lists') }}",
        method: 'GET',
        dataType: 'json',
        data: { date: date },
        success: function(data) {
          console.log("[loadTenantReading] AJAX success, data:", data);

          // 2a) If the back‐end returns an empty array, show "no tenants found"
          if (!Array.isArray(data) || data.length === 0) {
            tenantTable.row.add([
              `<div class="text-center text-muted">
                 No tenants found for ${date}.
               </div>`
            ]).draw();
            return;
          }

          // 2b) Otherwise, loop through each "company":
          data.forEach(function(company, idx) {
            let nestedRows = "";

            // Build each proposal’s <tr> inside THIS company's nested <table>
            company.proposals.forEach(function(proposal) {
              const isReading = proposal.billing.is_reading;
              const billingStatusText = (isReading === 0)
                ? 'Not Prepared'
                : (isReading === 1)
                  ? 'Processed'
                  : 'Prepared';
              const readingStatusText = (isReading === 0)
                ? 'No reading yet'
                : (isReading === 1)
                  ? 'Some have readings'
                  : 'All have readings';

              // Append one hidden <input name="bill_id[]" …> to #appendInputHere:
              $('#appendInputHere').append(`
                <input type="hidden" name="bill_id[]" value="${proposal.billing.id}" />
              `);

              // Build a single <tr> for this proposal:
              nestedRows += `
                <tr>
                  <td class="text-center">${proposal.proposal_uid}</td>
                  <td class="text-center">${billingStatusText}</td>
                  <td class="text-center">${readingStatusText}</td>
                  <td class="text-center">
                    <a class="btn btn-sm btn-warning"
                       data-bs-toggle="modal"
                       data-bs-target="#contractUtilityLists"
                       data-date="${date}"
                       data-proposal-id="${proposal.id}"
                       data-id="${proposal.billing.id}">
                      <i class="fa fa-pen"></i>
                    </a>
                  </td>
                </tr>
              `;
            });

            // Finally, add exactly ONE row to the DataTable:
            //    • column #0 = a clickable <div> with company.acc_id
            //    • inside that single <td>, we also embed a nested <table> (collapsible)
            tenantTable.row.add([
              `
              <div
                data-bs-toggle="collapse"
                data-bs-target="#utility_bill${idx}"
                aria-expanded="false"
                aria-controls="utility_bill${idx}"
                style="cursor: pointer; font-weight: 500;"
              >
                ${company.acc_id}
              </div>
              <div class="collapse mt-3" id="utility_bill${idx}">
                <table class="table table-bordered table-striped w-100">
                  <thead class="thead-light">
                    <tr>
                      <th class="text-center">Contract #</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Reading Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    ${nestedRows}
                  </tbody>
                </table>
              </div>
              `
            ]).draw();
          });
        },
        error: function(xhr) {
          console.error("[loadTenantReading] AJAX error:", xhr.responseText);
          tenantTable.row.add([
            `<div class="text-center text-danger">
               Error loading data.
             </div>`
          ]).draw();
        }
      });
    }

    $('#utilityListModal').on('show.bs.modal', function(event) {
      const date = $(event.relatedTarget).data('date');
      console.log("[Modal opened] calling loadTenantReading with", date);
      loadTenantReading(date);
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
          $('#utilityListModal').modal('hide');
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
      console.log("🔁 [Pusher] 'my-utilityreading' received:", payload);

      if (lastDate) {
        console.log("[Pusher] force‐reloading loadTenantReading(", lastDate, ")");
        loadTenantReading(lastDate);
      } else {
        console.log("[Pusher] lastDate is still null, cannot reload yet.");
      }
    });
  });
</script>


