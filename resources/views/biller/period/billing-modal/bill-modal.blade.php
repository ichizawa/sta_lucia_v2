<div class="modal fade" id="billingPeriodLists" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form action="{{ route('biller.prepare.process') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Billing</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="appendhere">

          </div>
          <div class="table-responsive">
            <table id="tenantBillings" class="table">
              <thead class="thead-light">
                <tr>
                  <th colspan="2">Billing #</th>
                  <th>Date of Billing</th>
                  <th>Bill Status</th>
                </tr>
              </thead>
              <tbody id="billLists">

              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-sta" data-bs-dismiss="modal">Process Billing</button> -->
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  $(document).on('click', '.periodLists', function () {
    const date = $(this).data('date');
    $.ajax({
      url: "{{route('biller.check.bills')}}",
      type: "GET",
      dataType: "json",
      data: {
        date: date
      },
      success: function (response) {
        $('#billLists').empty();
        // console.log(response);
        $('.appendhere').empty();
        $.each(response, function (key, value) {
          const date = new Date(value.date_to + "-01");
          date.setDate(date.getDate() + 4);
          const formattedDate = new Intl.DateTimeFormat('en-US', { month: 'short', day: 'numeric', year: 'numeric' }).format(date);
          $('#billLists').append(`
            <tr>
              <td colspan="2">${value.bill_no}</td>
              <td>${formattedDate}</td>
              <td>${value.status ? '<span class="badge bg-success">Paid</span>' : '<span class="badge bg-warning">Pending Payment</span>'}</td>
            </tr>
          `);
        });
      }
    });
  });
</script>