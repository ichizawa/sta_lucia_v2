<div class="modal fade" id="collectOptionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="finalOptionForm" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Collection Option</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-label">Select Payment Method</label>
                                    <select class="form-control" name="payment_method" id="payment_method" required>
                                        <option value="" selected hidden disabled>Select Payment Method</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Check">Check</option>
                                        <option value="Online Banking">Online Banking</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group" id="ref_num_div" hidden>
                                    <label class="form-label">Reference Number</label>
                                    <input type="text" class="form-control" name="ref_num" id="ref_num"
                                        placeholder="Enter Reference Number" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Total Amount Payable</label>
                                    <input type="text" class="form-control" name="total_amount_payable"
                                        id="total_amount_payable" placeholder="Total Payable" readonly />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Enter Amount to Pay</label>
                                    <input type="text" class="form-control" name="amount_payment" id="amount_payment"
                                        placeholder="Enter Amount" required />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Remarks</label>
                                    <textarea class="form-control" name="remarks" id="remarks" rows="3"
                                        placeholder="Remarks" required>Paid for </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" class="form-control" name="billing_id" id="billing_id" placeholder="#" hidden />
                <input type="text" class="form-control" name="biller_num" id="biller_num" hidden />
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="proceedPaymentFinal">Proceed</button>
                </div>
            </div>
        </form>
    </div>
</div>