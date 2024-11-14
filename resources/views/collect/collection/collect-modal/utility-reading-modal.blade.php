<div class="modal fade" id="utilityReadingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Meter Reading</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Previous Reading Date</label>
                            <input type="date" id="previous_reading_date" name="previous_reading_date"
                                class="form-control" placeholder="Enter Previous Reading Date" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Present Reading Date</label>
                            <input type="date" id="present_reading_date" name="present_reading_date"
                                class="form-control" placeholder="Enter Present Reading Date" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Previous Meter Reading</label>
                            <input type="text" id="previous_reading" name="previous_reading" class="form-control"
                                placeholder="Enter Previous Meter Reading" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Present Meter Reading</label>
                            <input type="text" id="bill_id" class="form-control" name="bill_id" hidden />
                            <input type="text" class="form-control" id="present_reading" name="present_reading"
                                placeholder="Enter Present Meter Reading" />
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Consumption</label>
                            <input type="text" id="consumption" name="consumption" class="form-control"
                                placeholder="Enter Consumption" />
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">Total Reading Charge</label>
                            <input type="text" id="total_reading_charge" name="total_reading_charge"
                                class="form-control" placeholder="Total Reading Charge" readonly />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-target="#utilityListModal"
                    data-bs-toggle="modal">Back</button>
                <button type="button" class="btn btn-sta">Update</button>
            </div>
        </div>
    </div>
</div>