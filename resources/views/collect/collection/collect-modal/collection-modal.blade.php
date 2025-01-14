<form id="collectionForm" method="POST">
    @csrf
    <div class="offcanvas offcanvas-end" tabindex="-1" id="paymentCanvas" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Collection Panel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluid mt--3">
                <div class="row" id="tenantInfo">
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
                            <label class="form-label">Transaction #</label>
                            <input type="text" class="form-control billnumber text-danger fw-bold" name="bill_num" id="bill_num"
                                placeholder="Transaction Number" readonly/>
                            <!-- <input type="text" class="form-control" name="billing_id" id="billing_id"
                                placeholder="#" hidden/> -->
                        </div>
                    </div>
                    <div class="col-md-12" id="tenantSales" hidden>
                        <div class="form-group">
                            <label class="form-label">Enter Total Sales</label>
                            <input type="text" class="form-control" name="total_sales" id="total_sales"
                                placeholder="Enter Total Sales" required/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="recent_payments" hidden>
                    <h5 class="text-center">Recent Payments</h5>
                    <div class="table-responsive">
                        <table id="recentPaymentsTable" class="table-striped table-hover table-sm" style="cursor: pointer;">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th>Transaction Number</th>
                                    <th>Amount</th>
                                    <th>Transaction Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <td colspan="3">No Data Yet!</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <h5 class="text-center">Space Breakdown</h5>
                    <div class="table-responsive">
                        <table id="spaceTableShow" class="table-striped table-hover table-sm" style="cursor: pointer;">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th colspan="2">Item Desc</th>
                                    <th></th>
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
                    <h5 class="text-center">Payment Breakdown</h5>
                    <div class="table-responsive">
                        <table id="billTableShow" class="table-striped table-hover table-sm" style="cursor: pointer;">
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
                        <table id="penaltyTableShow" class="table-striped table-hover table-sm" style="cursor: pointer;">
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
                        <label for="totalamount">Total Balance:</label>
                        <input type="text" class="form-control fw-bold" name="total_amoumnt" id="totalamount"
                            placeholder="Total" readonly/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="button" id="bill_pay_btn" class="btn btn-sta">Collect Bill</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    const BILL_PAY = "{{ route('collect.get.bills') }}";
    const BILL_PAY_STORE = "{{ route('collect.store.bills') }}";
</script>