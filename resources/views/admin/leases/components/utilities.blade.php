<div class="card">
    <div class="card-header bg-white w-100 justify-content-between" id="headingFive" data-bs-toggle="collapse"
        data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
        <h5 class="mb-0 fw-bold">
            Utilities
        </h5>
        <span class="caret"></span>
    </div>

    <div id="collapseFive" class="collapse show bg-white" aria-labelledby="headingFive"
        data-bs-parent="#leaseProposalAccordion">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-sta" id="add-another-utility">Add Utility
                </button>
            </div>
            <div id="utility-container" class="row">
                <div class="form-group col-md-6">
                    <label for="utilities">Utility Name</label>
                    <select class="form-control utility_names" id="utilities" name="utilityid[]" required>
                        <option value="" selected hidden>Select Utility</option>
                        @foreach ($utilities as $utility)
                            <option value="{{$utility->id}}" data-fee="{{$utility->utility_price}}">
                                {{$utility->utility_name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="utility_fee">Utility Fee</label>
                    <input type="text" class="form-control" id="utility_fee" name="utilityfee[]"
                        placeholder="Utility Fee" readonly />
                </div>
            </div>
        </div>
    </div>
</div>