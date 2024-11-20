<div class="modal fade" id="cashierBillingPeriod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <th>Tenant #</th>
                </tr>
              </thead>
              <tbody id="tenantLists">

              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-sta" data-bs-dismiss="modal">Process Billing</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  $(document).on('click', '.prepareBill', function () {
    const date = $(this).data('date');
    $.ajax({
      url: "{{route('biller.period.lists')}}",
      type: "GET",
      dataType: "json",
      data: {
        date: date
      },
      success: function (response) {
        $('#tenantLists').empty();
        // console.log(response);
        $('.appendhere').empty();
        $.each(response, function (key, value) {
          // var total_pay = value.min_mgr ? value.total_mgr : total_rent;
          $('.appendhere').append(`<input type="text" name="bill_id[]" value="${value.id}" hidden/>
          <input type="text" name="date" value="${date}" hidden/>`);
          $('#tenantLists').append(`
            <tr class="showContracts" data-bs-toggle="collapse" data-bs-target="#tenant_bill${key}" aria-expanded="false" aria-controls="tenant_bill${key}">
              <td>${value.acc_id}</td>
            </tr>
            <tr class="collapse" id="tenant_bill${key}">
              <td colspan="2">
                <div id="contract-lists" class="table-responsive">
                  <table>
                    <thead>
                      <tr>
                        <th colspan="2">Contract #</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td colspan="2">${value.proposal_uid}</td>
                          <td>${value.status ? '<span class="badge bg-success">Prepared</span>' : '<span class="badge bg-warning">Pending</span>'}</td>
                          <td><input type="checkbox" class="" name="contracts[]" value="${value.id}"></td>
                        </tr>
                    </tbody>
                  </table>
                </div>
              </td>
            </tr>
          `);
        });
      }
    });
  });
</script>