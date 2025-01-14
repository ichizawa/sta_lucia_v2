<div class="modal fade" id="ledgerTableModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ledger Table</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="ledgerTable" class="table table-striped table-striped table-hover mt-3">
                        <thead>
                            <tr>
                                <th>Billing #</th>
                                <th>Transaction Number</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <!-- <th>Beginning Balance</th> -->
                                <th>Remarks</th>
                                <!-- <th>Status</th> -->
                                <th>Transaction Date</th>
                                <!-- <th>Due Date</th> -->
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sta" id="backtocontractlist" data-bs-toggle="modal" data-bs-target="#collectionLedgerModal">Back</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    const LEDGER_TABLE = "{{ route('collect.ledger.table') }}";
</script>