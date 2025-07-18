<!-- <style>
    .modal-dialog {
        max-width: 900px;
        margin-top: 10%;
    }

    .modal-content {
        border-radius: 0.5rem;
    }

    .modal-header {
        border-bottom: none;
        padding: 1rem 1.5rem;
    }

    .modal-footer {
        border-top: none;
        padding: 1rem 1.5rem;
    }

    .form-group label {
        font-weight: 500;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }
</style> -->
<div class="modal fade" id="addChargesModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('submit.charges') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header brown-border-top">
                    <h5 class="modal-title">Categories</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Charge Name</label>
                                <input type="text" class="form-control" id="charge_name" name="chargename">
                                </input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Charge Fee</label>
                                <input type="text" class="form-control" id="charge_fee" name="chargefee">
                                </input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Charge Frequency</label>
                                <input type="text" class="form-control" id="charge_freq" name="chargefrequency">
                                </input>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="addRowButton" class="btn btn-sta">
                        Add
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
