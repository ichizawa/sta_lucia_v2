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
                    <button type="submit" class="btn btn-sta" data-bs-dismiss="modal">Prepare Billing</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('#tenantBillings').DataTable({
            pagelength: 10,
        });
        $('#cashierBillingPeriod').on('show.bs.modal', function(event) {
            const date = $(event.relatedTarget).data('date');
            $.ajax({
                url: "{{ route('biller.period.lists') }}",
                type: "GET",
                dataType: "json",
                data: {
                    date: date
                },
                success: function(response) {
                    $('.appendhere').empty();

                    table.clear();
                    $.each(response, function(key, value) {
                        let nestedTableRows = '';

                        $.each(value.proposals, function(proposalKey, proposal) {
                            var showproposal = false;

                            if (proposal.billing.date_end == null) {
                                if (proposal.billing.date_start == date) {
                                    nestedTableRows += `
                    <tr>
                      <td colspan="2">${proposal.proposal_uid}</td>
                      <td>${proposal.billing.is_paid == 0 ? 'Pending' : proposal.billing.is_paid == 1 ? 'Paid' : 'On Hold'}</td>
                      <td>${proposal.billing.is_prepared == 0 ? 'Not Prepared' : proposal.billing.is_prepared == 1 ? 'Processed' : 'Prepared'}</td>
                      <td><input type="checkbox" class="" name="contracts[]" value="${proposal.id}"></td>
                    </tr>
                  `;
                                }
                            } else {
                                var dateEnd = proposal.billing.date_end
                                    .substr(0, 7);
                                if (dateEnd == date) {
                                    nestedTableRows += `
                    <tr>
                      <td colspan="2" class="text-center">${proposal.proposal_uid}</td>
                      <td class="text-center">${proposal.billing.is_paid == 0 ? 'Pending' : proposal.billing.is_paid == 1 ? 'Paid' : 'On Hold'}</td>
                      <td class="text-center">${proposal.billing.is_prepared == 0 ? 'Not Prepared' : proposal.billing.is_prepared == 1 ? 'Processed' : 'Prepared'}</td>
                      <td class="text-center"><input type="checkbox" class="" name="contracts[]" value="${proposal.id}"></td>
                    </tr>
                  `;
                                }
                            }

                            $('.appendhere').append(`
                <input type="text" name="bill_id[]" value="${proposal.billing.id}" hidden/>
                <input type="text" name="date" value="${date}" hidden/>
              `);
                        });

                        table.row.add([
                            `<div class="showContracts" data-bs-toggle="collapse" data-bs-target="#tenant_bill${key}" aria-expanded="false" aria-controls="tenant_bill${key}">
                  <td>${value.acc_id}</td>
              </div>
              <div class="collapse" id="tenant_bill${key}">
                  <td colspan="2">
                      <div id="contract-lists" class="table-responsive">
                          <table>
                              <thead>
                                  <tr>
                                      <th colspan="2" class="text-center">Contract #</th>
                                      <th class="text-center">Process Status</th>
                                      <th class="text-center">Status</th>
                                      <th class="text-center">Action</th>
                                  </tr>
                              </thead>
                              <tbody id="proposalLists${key}">
                                ${nestedTableRows}
                              </tbody>
                          </table>
                      </div>
                  </td>
              </div>`
                        ]);
                    });

                    table.draw();
                }
            });
        });
    });
</script>
