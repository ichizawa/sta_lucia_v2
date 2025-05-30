<div class="modal fade" id="billingPeriodLists" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header brown-border-top">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Billing</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="periodBillings" class="table table-hover table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">Proposal #</th>
                                <th class="text-center">Date Started</th>
                                <th class="text-center">Due Date</th>
                                <th class="text-center">Bill Status</th>
                            </tr>
                        </thead>
                        <tbody id="billLists">

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
    $(document).ready(function() {
        const table = $('#periodBillings').DataTable();

        $('#billingPeriodLists').on('show.bs.modal', function(e) {
            const date = $(e.relatedTarget).data('date');
            $.ajax({
                url: "{{ route('biller.check.bills') }}",
                type: "GET",
                dataType: "json",
                data: {
                    date: date
                },
                success: function(response) {
                    table.clear();
                    $.each(response, function(key, value) {
                        $.each(value.proposals, function(key, proposal) {
                            const date = new Date(proposal.billing
                                .date_end);
                            const datefrom = new Date(proposal.billing
                                .date_start);
                            // date.setDate(date.getDate() + 4);
                            const formattedDate = new Intl.DateTimeFormat(
                                'en-US', {
                                    month: 'short',
                                    day: 'numeric',
                                    year: 'numeric'
                                }).format(date);
                            const formattedDatefrom = new Intl
                                .DateTimeFormat('en-US', {
                                    month: 'short',
                                    year: 'numeric'
                                }).format(datefrom);

                            table.row.add([
                                proposal.proposal_uid,
                                formattedDatefrom,
                                formattedDate,
                                proposal.billing.is_prepared == 0 ?
                                'Not Prepared' : proposal.billing
                                .is_prepared == 1 ? 'Processed' :
                                'Prepared'
                            ]);

                        });
                    });
                    table.draw();
                }
            });
        });
    });
</script>
