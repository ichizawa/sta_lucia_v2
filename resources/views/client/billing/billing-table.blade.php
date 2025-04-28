<style>
    .btn-brown {
        background-color: #8B7231 !important;
        color: white !important;
    }

    .modal-header {
        border-top: 5px solid #b0a166 !important;
        color: #8B7231 !important;
    }

    .modal-body {
        padding: 0px !important;
    }
</style>

@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Billing</h3>
                <h6 class="op-7 mb-2">Tenant Billing</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Billing Information</h4>
                            <button type="button" class="btn btn-sta ms-auto" data-bs-toggle="modal"
                                data-bs-target="#processBillingModal">
                                <i class="fa fa-plus"></i>
                                Process Billing
                            </button>
                            {{-- Modal --}}
                            <div class="modal fade modal-lg" id="processBillingModal" tabindex="-1"
                                aria-labelledby="processBillingModalLabel" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="processBillingModalLabel">
                                                Process Billing</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="finalOptionForm" method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-sm-12 mt-3">
                                                                    <div class="form-group">
                                                                        <div>
                                                                            <label for="contractSelect"
                                                                                class="form-label">Select Contract</label>
                                                                            <select class="form-control"
                                                                                id="contractSelect">
                                                                                <option selected disabled hidden>Choose
                                                                                    contract</option>
                                                                                <option value="094854">094854 (sample)
                                                                                </option>
                                                                                <option value="325064">325064 (sample)
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Select Payment
                                                                            Method</label>
                                                                        <select class="form-control" name="payment_method"
                                                                            id="payment_method" required>
                                                                            <option value="" selected hidden disabled>
                                                                                Select Payment Method</option>
                                                                            <option value="Cash">Cash</option>
                                                                            <option value="Check">Check</option>
                                                                            <option value="Online Banking">Online Banking
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="form-group d-none" id="ref_num_div">
                                                                        <label class="form-label">Reference Number</label>
                                                                        <input type="text" class="form-control"
                                                                            name="ref_num" id="ref_num"
                                                                            placeholder="Enter Reference Number" required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group d-none" id="encode_bank_div">
                                                                        <label class="form-label">Encode Bank</label>
                                                                        <input type="text" class="form-control"
                                                                            name="enc_bank" id="enc_bank"
                                                                            placeholder="Enter Encode Bank" required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group d-none" id="date_check_div">
                                                                        <label class="form-label">Date Check</label>
                                                                        <input type="text" class="form-control"
                                                                            name="date_check" id="date_check"
                                                                            placeholder="Enter Date Check" required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group d-none" id="check_num_div">
                                                                        <label class="form-label">Check Number</label>
                                                                        <input type="text" class="form-control"
                                                                            name="check_num" id="check_num"
                                                                            placeholder="Enter Check Number" required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group d-none" id="dep_slip_div">
                                                                        <label class="form-label">Deposit Slip
                                                                            Number</label>
                                                                        <input type="text" class="form-control"
                                                                            name="dep_slip_num" id="dep_slip_num"
                                                                            placeholder="Enter Deposit Slip Number"
                                                                            required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Total Amount
                                                                            Payable</label>
                                                                        <input type="text" class="form-control"
                                                                            name="total_amount_payable"
                                                                            id="total_amount_payable"
                                                                            placeholder="Total Payable" readonly />
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Enter Amount to
                                                                            Pay</label>
                                                                        <input type="text" class="form-control"
                                                                            name="amount_payment" id="amount_payment"
                                                                            placeholder="Enter Amount" required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Change</label>
                                                                        <input type="text" class="form-control"
                                                                            name="change" id="change"
                                                                            placeholder="0.00" readonly />
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Deposit Credit</label>
                                                                        <div class="selectgroup selectgroup-pills">
                                                                            <label class="selectgroup-item">
                                                                                <input type="checkbox" id="deposit_credit"
                                                                                    name="deposit_credit" value="true"
                                                                                    class="selectgroup-input" />
                                                                                <span
                                                                                    class="selectgroup-button">Deposit</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Total New Balance</label>
                                                                        <input type="text" class="form-control"
                                                                            name="new_bal" id="new_bal"
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
                                                    <input type="text" class="form-control" name="billing_id"
                                                        id="billing_id" placeholder="#" hidden />
                                                    <input type="text" class="form-control" name="biller_num"
                                                        id="biller_num" hidden />
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-brown"
                                                id="proceedPaymentFinal">Proceed</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="client" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Contract #</th>
                                        <th class="text-center">Process Status</th>
                                        <th class="text-center">Not Prepared</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">094854</td>
                                        <td class="text-center">Paid</td>
                                        <td class="text-center">Not Prepared</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">325064</td>
                                        <td class="text-center">Pending</td>
                                        <td class="text-center">Prepared</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethodSelect = document.getElementById('payment_method');

        function togglePaymentFields() {
            const method = paymentMethodSelect.value;

            document.getElementById('ref_num_div').classList.add('d-none');
            document.getElementById('encode_bank_div').classList.add('d-none');
            document.getElementById('date_check_div').classList.add('d-none');
            document.getElementById('check_num_div').classList.add('d-none');
            document.getElementById('dep_slip_div').classList.add('d-none');

            if (method === 'Check') {
                document.getElementById('ref_num_div').classList.remove('d-none');
                document.getElementById('encode_bank_div').classList.remove('d-none');
                document.getElementById('date_check_div').classList.remove('d-none');
                document.getElementById('check_num_div').classList.remove('d-none');
            } else if (method === 'Online Banking') {
                document.getElementById('ref_num_div').classList.remove('d-none');
                document.getElementById('dep_slip_div').classList.remove('d-none');
                document.getElementById('encode_bank_div').classList.remove('d-none');
                document.getElementById('date_check_div').classList.remove('d-none');
            }
        }

        paymentMethodSelect.addEventListener('change', togglePaymentFields);
    });
</script>
