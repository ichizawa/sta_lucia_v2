<div class="modal fade" id="utilityReadingModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form id="readingForm" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Meter Reading</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="previous_reading_date">Previous Reading Date</label>
                <input
                  type="date"
                  id="previous_reading_date"
                  name="previous_reading_date"
                  class="form-control"
                  placeholder="Enter Previous Reading Date"
                />
              </div>
              <div class="form-group col-md-6">
                <label for="present_reading_date">Present Reading Date</label>
                <input
                  type="date"
                  id="present_reading_date"
                  name="present_reading_date"
                  class="form-control"
                  placeholder="Enter Present Reading Date"
                />
              </div>
              <div class="form-group col-md-6">
                <label for="previous_reading">Previous Meter Reading</label>
                <input
                  type="text"
                  id="previous_reading"
                  name="previous_reading"
                  class="form-control"
                  placeholder="Enter Previous Meter Reading"
                />
              </div>
              <div class="form-group col-md-6">
                <input type="hidden" id="bill_id" name="bill_id" />
                <input type="hidden" id="utility_id" name="utility_id" />
                <input type="hidden" id="date_reading" name="date_reading" />
                <input type="hidden" id="proposal_id" name="proposal_id" />

                <label for="present_reading">Present Meter Reading</label>
                <input
                  type="text"
                  id="present_reading"
                  name="present_reading"
                  class="form-control"
                  placeholder="Enter Present Meter Reading"
                />
              </div>
              <div class="form-group col-md-12">
                <label for="consumption">Consumption</label>
                <input
                  type="text"
                  id="consumption"
                  name="consumption"
                  class="form-control"
                  placeholder="Enter Consumption"
                />
              </div>
              <div class="form-group col-md-12">
                <label for="total_reading_charge">Total Reading Charge</label>
                <input
                  type="text"
                  id="total_reading_charge"
                  name="total_reading_charge"
                  class="form-control"
                  placeholder="Total Reading Charge"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            id="back"
            data-bs-toggle="modal"
            data-bs-target="#contractUtilityLists"
          >
            Back
          </button>
          <button type="button" class="btn btn-sta createReading">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#utilityReadingModal').on('show.bs.modal', function (e) {
      var util_id   = $(e.relatedTarget).data('utility-id');
      var date      = $(e.relatedTarget).data('date');
      var bill_id   = $(e.relatedTarget).data('bill-id');
      var prop_id   = $(e.relatedTarget).data('proposal-id');

      $('#back').data('proposal-id', prop_id);
      $('#back').data('date', date);

      $('#readingForm')[0].reset();

      $('#bill_id').val(bill_id);
      $('#utility_id').val(util_id);
      $('#date_reading').val(date);
      $('#proposal_id').val(prop_id);

      $.ajax({
        url: "{{ url('utility/utility-reading') }}",
        type: "GET",
        dataType: "json",
        data: {
          id: util_id,
          prop_id: prop_id
        },
        success: function (response) {
          if (response && response.present_reading !== undefined) {
            $('#previous_reading').val(response.present_reading);
            $('#previous_reading_date').val(response.present_reading_date);
          } else {
            $('#previous_reading').val('');
            $('#previous_reading_date').val('');
          }
        },
        error: function (xhr) {
          console.error("AJAX error in reading.bills.utility:", xhr.responseText);
        }
      });
    });

    $('.createReading').click(function () {
      var formEl   = $('#readingForm')[0];
      var formData = new FormData(formEl);

      $.ajax({
        url: "{{ url('utility/prepare-reading') }}",
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function (data) {
          if (data.status === 'success') {
            swal('Success', data.message, 'success').then(() => {
              $('#back').trigger('click');
            });
          }
        },
        error: function (xhr) {
          console.error("AJAX error in reading.store:", xhr.responseText);
        }
      });
    });
  });
//    console.log("[Pusher] Initializing…");
//     Pusher.logToConsole = true;
//     const pusher = new Pusher('1eedc3e004154aadb5dc', {
//       cluster: 'ap1',
//       forceTLS: true
//     });

    // 1) Subscribe to the channel your event uses
    // const channel = pusher.subscribe('utilityreading-channel');

    // // 2) Log subscription success/failure
    // channel.bind('pusher:subscription_succeeded', function() {
    //   console.log("[Pusher] Subscribed to channel 'utilityreading-channel'");
    // });
    // channel.bind('pusher:subscription_error', function(status) {
    //   console.error("[Pusher] Subscription error:", status);
    // });

    // // 3) Bind your custom event name (broadcastAs())
    // channel.bind('my-utilityreading', function(payload) {
    //   console.log("🔁 [Pusher] 'my-utilityreading' event received:", payload);

    //   // For now, just force a reload as soon as the event arrives (ignore modal visibility)
    //   if (lastDate) {
    //     console.log("[Pusher] force‐reloading loadTenantReading(", lastDate, ")");
    //     loadTenantReading(lastDate);
    //   } else {
    //     console.log("[Pusher] lastDate is still null, cannot reload yet.");
    //   }
    // });
</script>
