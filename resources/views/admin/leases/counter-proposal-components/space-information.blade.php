<style>
    .highlight {
        background-color: #8B7231;
        color: white;
    }
</style>
<h5 class="mb-0 fw-bold">
    Space Rental Rates
</h5>

<div class="row">
    <!-- <div class="form-group">
        <label for="space_prop">Select Space</label>
        <select name="spaceprop[]" class="form-control" id="spaceprop" multiple>
            {{-- @foreach ($space as $spaces)
                <option value="{{$spaces->id}}" data-space-id="{{$spaces->id}}" data-space-type="{{$spaces->store_type}}"
                    data-space-floor-area="{{$spaces->space_area}}" data-space-option="{{$spaces->space_type}}"
                    data-space-name="{{ucfirst($spaces->space_name)}}">
                    {{ ucfirst($spaces->space_name) }}
                </option>
            @endforeach --}}
        </select>

    </div> -->


</div>

<div class="row">
    <div class="form-group col-md-6">
        <label for="brent">Basic Rent</label>
        <input name="brent" type="text" class="form-control" id="brent" placeholder="Basic Rent">
    </div>
    <div class="form-group col-md-6">
        <label for="payment_disc">Discount</label>
        <input type="text" class="form-control" id="payment_disc1" name="paymentdisc"
            placeholder="Payment Discount (Leave empty if no discount)"/>
    </div>
</div>
<input type="text" id="selected_rent" name="total_rent" hidden/>
<input type="text" name="minmgr" id="minimumMGR" hidden/>

<div class="table-container-rate rentalRates" style="cursor: pointer;">
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