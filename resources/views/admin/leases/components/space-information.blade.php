<style>
    .highlight {
        background-color: #8B7231;
        color: white;
    }
</style>
<div class="card">
    <div class="card-header bg-white w-100 justify-content-between">
        <h5 class="mb-0 fw-bold">
            Space Rental Rates
        </h5>
    </div>

    <div id="collapseTwo" class="collapse show bg-white" aria-labelledby="headingTwo"
        data-bs-parent="#leaseProposalAccordion">
        <div class="card-body">
            <div class="row">
                <div class="form-group">
                    <label for="space_prop">Select Space</label>
                    <select name="spaceprop[]" class="form-control" id="spaceprop" required multiple>
                        @foreach ($space as $spaces)
                            <option value="{{ $spaces->id }}" data-space-id="{{ $spaces->id }}"
                                data-space-type="{{ $spaces->store_type }}"
                                data-space-floor-area="{{ $spaces->space_area }}"
                                data-space-option="{{ $spaces->space_type }}"
                                data-space-name="{{ ucfirst($spaces->space_name) }}">
                                {{ ucfirst($spaces->space_name) }}
                            </option>
                        @endforeach
                    </select>

                </div>


            </div>


            <div class="row">
                <div class="form-group col-md-6">
                    <label for="brent">Basic Rent</label>
                    <input name="brent" type="text" class="form-control" id="brent" placeholder="Basic Rent"
                        required>
                </div>
                <div class="form-group col-md-6">
                    <label for="payment_disc">Discount</label>
                    <input type="text" class="form-control" id="payment_disc" name="paymentdisc"
                        placeholder="Payment Discount (Leave empty if no discount)" readonly />
                </div>
            </div>
            <input type="text" id="selected_rent" name="total_basic_rent" placeholder="Selected Rent" hidden />
            <input type="text" id="total_min_guaranteed_rent" name="total_guaranteed_rent"
                placeholder="Selected Rent" hidden />
            <input type="text" name="minmgr" placeholder="Selected MGR" id="minimumMGR" hidden />
            <div class="table-container-rate" hidden style="cursor: pointer;">
                <table>
                    <thead>
                        <tr>
                            <th>Space Name</th>
                            <th>Area - Type</th>
                            <th>Totals</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- <div class="row d-flex justify-content-center" style="gap: 5px; margin: 2px;">
                <div class="col" style="border: 1px solid black; text-align: center">
                    <h6>
                        Total Guaranteed Rent
                    </h6>
                </div>
                <div class="col" style="border: 1px solid black; text-align: center">
                    <h6>
                        Total Guaranteed Rent
                    </h6>
                </div>
            </div> -->

        </div>
    </div>
</div>
