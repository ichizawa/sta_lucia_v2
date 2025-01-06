<div class="modal fade" id="collectionLedgerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Billing Ledger</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="ledgerTable" class="table table-striped table-striped mt-3">
                        <thead>
                            <tr>
                                <th>Billing #</th>
                                <th>Contract #</th>
                                <th>Remarks</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Due Date</th>
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
    const BILL_LEDGER = "{{ route('collect.ledger.index') }}";
</script>