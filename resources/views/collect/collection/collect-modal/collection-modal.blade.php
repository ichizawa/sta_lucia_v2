<form method="POST">
    @csrf
    <div class="offcanvas offcanvas-end" tabindex="-1" id="paymentCanvas" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Collection Panel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluid mt--3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Select Contract</label>
                            <select id="cntr_search" class="form-control" name="contract_id"
                                placeholder="Search Contract" name="tenant_contract" required>
                                <option value="" selected hidden disabled></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Bill Number</label>
                            <input type="text" class="form-control billnumber text-danger fw-bold" name="bill_num" id="bill_num"
                                placeholder="Billing Number" readonly />
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h5 class="text-center">Payment Breakdown</h5>
                    <div class="table-responsive">
                        <table id="billTableShow" class="table-striped table-hover" style="cursor: pointer;">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th colspan="2">Item Desc</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3">No Data Yet!</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <h5 class="text-center">Penalties</h5>
                    <div class="table-responsive">
                        <table id="penaltyTableShow" class="table-striped table-hover" style="cursor: pointer;">
                            <thead class="bg-danger text-white">
                                <tr>
                                    <th colspan="2">Item Desc</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3">No Data Yet!</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas-foot p-3 bg-light">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control fw-bold" name="total_amoumnt" id="totalamount"
                            placeholder="Total" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="button" class="btn btn-sta">Pay Bill</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    const BILL_PAY = "{{ route('collect.get.bills') }}";
</script>