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
  $(document).ready(function () {
    var table = $('#tenantBillings').DataTable({
      pagelength: 10,
    });
    $('#cashierBillingPeriod').on('show.bs.modal', function (event) {
      const date = $(event.relatedTarget).data('date');
      $.ajax({
        url: "{{route('biller.period.lists')}}",
        type: "GET",
        dataType: "json",
        data: {
          date: date
        },
        success: function (response) {
          $('.appendhere').empty();
          table.clear();
          $.each(response, function (key, tenant) {
            let nestedTableRows = '';

            $.each(tenant.proposal, function (proposalKey, proposal) {
              $.each(proposal.bill, function (billId, billDetails) {
                $('.appendhere').append(`
                  <input type="text" name="bill_id[]" value="${billDetails.id}" hidden/>
                  <input type="text" name="date" value="${date}" hidden/>
                `);

                nestedTableRows += `
                  <tr>
                      <td colspan="2">${proposal.proposal_uid}</td>
                      <td>
                        ${billDetails.status === 0
                            ? 'Processing'
                            : billDetails.status === 1
                              ? 'Processed'
                              : billDetails.status === 2
                                ? 'Pending'
                                : 'Unknown'
                          }
                      </td>
                      <td>
                          <input type="checkbox" class="" name="contracts[]" value="${proposal.id}">
                      </td>
                  </tr>
                `;
              });
            });

            table.row.add([
              `<div class="showContracts" data-bs-toggle="collapse" data-bs-target="#tenant_bill${key}" aria-expanded="false" aria-controls="tenant_bill${key}">
                  <td>${tenant.acc_id}</td>
              </div>
              <div class="collapse" id="tenant_bill${key}">
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
  // $(document).on('click', '.prepareBill', function () {
  //   const date = $(this).data('date');
  //   $.ajax({
  //     url: "{{route('biller.period.lists')}}",
  //     type: "GET",
  //     dataType: "json",
  //     data: {
  //       date: date
  //     },
  //     success: function (response) {
  //       $('#tenantLists').empty();
  //       $('.appendhere').empty();

  //   //     $.each(response, function (key, tenant) {
  //   //       // Filter proposals based on the logic provided
  //   //       const filteredProposals = tenant.proposal.filter(function (proposal) {
  //   //         // Use `date_end` if bill is not empty, otherwise use `commencement_date`
  //   //         if (proposal.bill && proposal.bill.length > 0) {
  //   //           return proposal.bill.some(function (bill) {
  //   //             return bill.date_end === date;
  //   //           });
  //   //         } else {
  //   //           return proposal.commencement.commencement_date === date;
  //   //         }
  //   //       });

  //   //       // If there are filtered proposals, render them
  //   //       if (filteredProposals.length > 0) {
  //   //         $('#tenantLists').append(`
  //   //   <tr class="showContracts" data-bs-toggle="collapse" data-bs-target="#tenant_bill${key}" aria-expanded="false" aria-controls="tenant_bill${key}">
  //   //     <td>${tenant.acc_id}</td>
  //   //   </tr>
  //   //   <tr class="collapse" id="tenant_bill${key}">
  //   //     <td colspan="2">
  //   //       <div id="contract-lists" class="table-responsive">
  //   //         <table>
  //   //           <thead>
  //   //             <tr>
  //   //               <th colspan="2">Contract #</th>
  //   //               <th>Action</th>
  //   //             </tr>
  //   //           </thead>
  //   //           <tbody id="proposalLists${key}">
  //   //           </tbody>
  //   //         </table>
  //   //       </div>
  //   //     </td>
  //   //   </tr>
  //   // `);

  //   //         // Render filtered proposals
  //   //         $.each(filteredProposals, function (index, proposal) {
  //   //           $(`#proposalLists${key}`).append(`
  //   //     <tr>
  //   //       <td colspan="2">${proposal.proposal_uid}</td>
  //   //       <td>
  //   //         <input type="checkbox" class="" name="contracts[]" value="${proposal.id}">
  //   //       </td>
  //   //     </tr>
  //   //   `);

  //   //           // If the proposal has bills, render hidden inputs
  //   //           if (proposal.bill) {
  //   //             $.each(proposal.bill, function (billId, billDetails) {
  //   //               $('.appendhere').append(`
  //   //         <input type="text" name="bill_id[]" value="${billDetails.id}" hidden/>
  //   //         <input type="text" name="date" value="${date}" hidden/>
  //   //       `);
  //   //             });
  //   //           }
  //   //         });
  //   //       }
  //   //     });

  //     }
  //   });

  // });
</script>