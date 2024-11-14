<div class="modal fade" id="cashierBillingPeriod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form action="{{ route('biller.prepare.period') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Billing Periods</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body appendhere">
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
        console.log(response);
        $.each(response, function (key, value) {
          if(value.min_mgr == 0){
            
          }
          $('.appendhere').append(`<input type="text" name="contract_id[]" value="${value.id}" hidden/>`);
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
                        <th>Contract #</th>
                        <th></th>
                        <th>Total Payment</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td>${value.proposal_uid}</td>
                          <td></td>
                          <td></td>
                          <td></td>
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