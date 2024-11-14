<div class="modal fade" id="cashierLedgerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tenant Ledger</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table id="ledgerTable" class="table table-striped table-striped mt-3">
            <thead>
              <tr>
                <th scope="col">Bill #</th>
                <th scope="col">Amount</th>
                <th scope="col">Remarks</th>
                <th scope="col">Status</th>
                <th scope="col">Date Duration</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function (e) {
    $('.viewLedger').click(function (e) {
      e.stopPropagation();
      var ledger_id = $(this).data('account-uid');
      var datas = @json($companies);

      $.ajax({
        url: "{{ route('bill.cashier.ledger') }}",
        type: "GET",
        data: {
          acc_uid: ledger_id
        },
        success: function (data) {
          $('#ledgerTable').find('tbody').empty();
          
          $.each(data, function (key, value) {
            // var amount = value.total_sales == "0" ? value.total_brent : value.amount_payable;
            $('#ledgerTable').find('tbody').append(`
              <tr>
                <td>${value.bill_no}</td>
                <td>PHP ${parseFloat(value.total_amount_payable).toFixed(2)}</td>
                <td>${value.remarks ?? 'No Remarks Yet!'}</td>
                <td>${value.status ? '<span class="badge bg-success">Paid</span>' : '<span class="badge bg-warning">Pending</span>'}</td>
                <td>${formatDate(value.date_from)} - ${formatDate(value.date_to)}</td>
              </tr>
            `);
          });
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
      function formatDate(dateString) {
        const date = new Date(dateString);
        return new Intl.DateTimeFormat('en-US', { month: 'short', day: 'numeric', year: 'numeric' }).format(date);
      }
    });
  });
</script>