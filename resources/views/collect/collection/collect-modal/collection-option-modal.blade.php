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
                                <div class="form-group d-none" id="ref_num_div">
                                    <label class="form-label">Reference Number</label>
                                    <input type="text" class="form-control" name="ref_num" id="ref_num"
                                        placeholder="Enter Reference Number" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group d-none" id="encode_bank_div">
                                    <label class="form-label">Encode Bank</label>
                                    <input type="text" class="form-control" name="enc_bank" id="enc_bank"
                                        placeholder="Enter Encode Bank" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group d-none" id="date_check_div">
                                    <label class="form-label">Date Check</label>
                                    <input type="text" class="form-control" name="date_check" id="date_check"
                                        placeholder="Enter Date Check" required />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group d-none" id="check_num_div">
                                    <label class="form-label">Check Number</label>
                                    <input type="text" class="form-control" name="check_num" id="check_num"
                                        placeholder="Enter Check Number" required />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group d-none" id="dep_slip_div">
                                    <label class="form-label">Deposit Slip Number</label>
                                    <input type="text" class="form-control" name="dep_slip_num" id="dep_slip_num"
                                        placeholder="Enter Deposit Slip Number" required />
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
                            <div class="col-sm-9">
                                <div class="form-group">
                                    <label class="form-label">Change</label>
                                    <input type="text" class="form-control" name="change" id="change"
                                        placeholder="0.00" readonly />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="form-label">Deposit Credit</label>
                                    <div class="selectgroup selectgroup-pills">
                                        <label class="selectgroup-item">
                                            <input type="checkbox" id="deposit_credit" name="deposit_credit"
                                                value="true" class="selectgroup-input" />
                                            <span class="selectgroup-button">Deposit</span>
                                        </label>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <div class="selectgroup selectgroup-pills">
                                        <label class="selectgroup-item">
                                            <input type="checkbox" id="deposit_credit" name="deposit_credit" value=""
                                                class="selectgroup-input" />
                                            <span class="selectgroup-button">Deposit Credit</span>
                                        </label>
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Total New Balance</label>
                                    <input type="text" class="form-control" name="new_bal" id="new_bal"
                                        placeholder="0.00" readonly />
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-label">Remarks</label>
                                    <textarea class="form-control" name="remarks" id="remarks" rows="3" placeholder="Remarks" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" class="form-control" name="billing_id" id="billing_id" placeholder="#"
                    hidden />
                <input type="text" class="form-control" name="biller_num" id="biller_num" hidden />
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="proceedPaymentFinal">Proceed</button>
                </div>
            </div>
        </form>
    </div>
</div>
