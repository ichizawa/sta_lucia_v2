<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold"> New</span>
                    <span class="fw-light"> Branch </span>
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <p class="small">
                    Create a new row using this form, make
                    sure you fill them all
                </p> -->
                <form>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Branch Name</label>
                                <input type="text" class="form-control" placeholder="Branch Name"/>
                            </div>
                        </div>
                        <div class="col-md-6 pe-0">
                            <div class="form-group form-group-default">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="Branch Email"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Registration Date</label>
                                <input type="date" class="form-control" placeholder="Registration Date"/>
                            </div>
                        </div>
                        <div class="col-md-6 pe-0">
                            <div class="form-group form-group-default">
                                <label>Valid ID's</label>
                                <input type="file" class="form-control" placeholder=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>City</label>
                                <input type="text" class="form-control" placeholder="City"/>
                            </div>
                        </div>
                        <div class="col-md-6 pe-0">
                            <div class="form-group form-group-default">
                                <label>Postal Address</label>
                                <input type="text" class="form-control" placeholder="Postal Address" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Physical Address</label>
                                <input type="text" class="form-control" placeholder="Physical Address"/>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Residential Address</label>
                                <input type="text" class="form-control" placeholder="Residential Address"/>
                            </div>
                        </div>
                        <div class="col-md-6 pe-0">
                            <div class="form-group form-group-default">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" placeholder="Confirm Password" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" id="addRowButton" class="btn btn-md btn-outline-success">
                    Submit
                </button>
                <button type="button" class="btn btn-md btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>