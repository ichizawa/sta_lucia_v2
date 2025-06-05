<!-- Billing Modal (blade) -->
<div class="modal fade" id="cashierBillingPeriod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('biller.prepare.process') }}" method="POST">
            @csrf

            <!-- Single hidden date field -->
            <input type="hidden" name="date" value="" id="billingDateField">

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Billing</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- (no hidden bill_id[] inputs here) -->
                    <div class="appendhere"></div>

                    <div class="table-responsive">
                        <table id="tenantBillings" class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tenant #</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <!-- “Select All” button -->
                    <button type="button" id="selectAllContracts" class="btn btn-info">
                        Select All
                    </button>

                    <button type="submit" class="btn btn-sta" data-bs-dismiss="modal">Prepare Billing</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- jQuery, DataTables, Pusher libraries must be loaded before this script -->
<script>
    $(document).ready(function() {
        let selectedDate = '';
        const table = $('#tenantBillings').DataTable({
            ordering: false,
            paging: true,
            pageLength: 10,
            searching: false,
            info: false,
            columns: [
                { data: 'acc_id' }
            ],
            drawCallback: function() {
                $('[data-bs-toggle="collapse"]').off('click').on('click', function() {
                    const target = $(this).data('bs-target');
                    $(target).collapse('toggle');
                });
            }
        });

        function loadBillingTable(date) {
            table.clear().draw();

            $.ajax({
                url: "{{ route('biller.period.lists') }}",
                type: "GET",
                dataType: "json",
                data: { date: date },
                success: function(response) {
                    const rows = [];

                    $.each(response, function(key, value) {
                        let nestedTableRows = '';

                        $.each(value.proposals, function(_, proposal) {
                            if (!proposal.billing) {
                                return;
                            }

                            const bill = proposal.billing;
                            const dateStartYYYYMM = bill.date_start.substr(0, 7);
                            const dateEndYYYYMM   = bill.date_end ? bill.date_end.substr(0, 7) : null;

                            if ((dateEndYYYYMM === null && dateStartYYYYMM === date)
                                || (dateEndYYYYMM === date)) {
                                nestedTableRows += `
                                    <tr>
                                        <td colspan="2">${proposal.proposal_uid}</td>
                                        <td>${
                                            bill.is_paid == 0
                                                ? 'Pending'
                                                : (bill.is_paid == 1 ? 'Paid' : 'On Hold')
                                        }</td>
                                        <td>${
                                            bill.is_prepared == 0
                                                ? 'Not Prepared'
                                                : (bill.is_prepared == 1 ? 'Processed' : 'Prepared')
                                        }</td>
                                        <td><input type="checkbox" name="bill_id[]" value="${bill.id}"></td>
                                    </tr>
                                `;
                            }
                        });

                        const rowHtml = `
                            <div>
                                <div class="showContracts" data-bs-toggle="collapse"
                                     data-bs-target="#tenant_bill${key}"
                                     aria-expanded="false"
                                     aria-controls="tenant_bill${key}"
                                     style="cursor: pointer;">
                                    ${value.acc_id}
                                </div>
                                <div class="collapse" id="tenant_bill${key}">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th colspan="2" class="text-center">Contract #</th>
                                                    <th class="text-center">Process Status</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                ${nestedTableRows}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        `;

                        rows.push({ acc_id: rowHtml });
                    });

                    table.rows.add(rows).draw();
                }
            });
        }

        $('#cashierBillingPeriod').on('show.bs.modal', function(event) {
            selectedDate = $(event.relatedTarget).data('date');
            $('#billingDateField').val(selectedDate);
            subscribeToBillingChannel(selectedDate);
            loadBillingTable(selectedDate);
        });

        $('#selectAllContracts').on('click', function() {
            $('#tenantBillings').find('input[name="bill_id[]"]').prop('checked', true);
        });

        Pusher.logToConsole = true;
        let pusher = null;
        let channel = null;

        function subscribeToBillingChannel(date) {
            if (channel) {
                pusher.unsubscribe(channel.name);
            }
            if (!pusher) {
                pusher = new Pusher('1eedc3e004154aadb5dc', {
                    cluster: 'ap1',
                    forceTLS: true
                });
            }
            const channelName = 'biller-period.' + date;
            channel = pusher.subscribe(channelName);

            channel.bind('billing-updated', function(data) {
                loadBillingTable(selectedDate);
            });
        }
    });
</script>
