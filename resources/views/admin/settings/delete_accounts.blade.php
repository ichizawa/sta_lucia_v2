<div class="card">
    <div id="contentListContainer">
        <div class="card-header brown-border-top">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-auto">
                    <h5 class="card-title mb-0">
                        List of All Accounts
                    </h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">Faye Macs</td>
                            <td class="text-center">Admin</td>
                            <td class="text-center"><span class="badge badge-success">Active</span></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#viewAccountModal" title="View">
                                        <i class="fa fa-eye text-white"></i>
                                    </a>

                                    <a class="btn btn-sm btn-warning" title="Update" data-bs-toggle="modal"
                                        data-bs-target="#updateAccountModal">
                                        <i class="fa fa-pen text-white"></i>
                                    </a>
                                    <a class="btn btn-sm btn-secondary disable-btn" data-bs-toggle="tooltip"
                                        title="Disable">
                                        <i class="fa-solid fa-user-slash text-white"></i>
                                    </a>
                                    <a class="btn btn-sm btn-danger delete-btn" data-bs-toggle="tooltip" title="Delete">
                                        <i class="fa fa-trash text-white"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="modal fade" id="updateAccountModal" tabindex="-1" aria-labelledby="updateAccountModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header brown-border-top">
                                <h5 class="modal-title" id="updateAccountModalLabel">Account
                                    Details
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div>
                                <form class="px-3 mt-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="account_name">Account Name</label>
                                                <input type="text" class="form-control" id="account_name">
                                            </div>

                                            <div class="form-group">
                                                <label for="user_email">Email</label>
                                                <input type="email" class="form-control" id="user_email">
                                            </div>
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <input type="text" class="form-control" id="role">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone #</label>
                                                <input type="number" class="form-control" id="phone">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" id="address">
                                            </div>
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" id="city">
                                            </div>
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <input type="text" class="form-control" id="state">
                                            </div>
                                            <div class="form-group">
                                                <label for="zip_code">Zip</label>
                                                <input type="number" class="form-control" id="zip_code">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <div class="form-group p-0">
                                    <button id="accountDetailsSaveBtn" class="btn btn-sta">
                                        <i class="fa-solid fa-check"></i> Save Changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewAccountModal" tabindex="-1" aria-labelledby="viewAccountModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content shadow-sm">
            <div class="modal-body bg-light p-5">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="User Photo"
                        class="rounded-circle img-thumbnail shadow-sm mb-3" width="128" height="128">
                    <h5 class="fw-semibold" id="userName">Faye Macs</h5>
                    <span class="badge badge-success">Active</span>
                    <p class="text-muted">fayemacs@gmail.com</p>
                </div>
                <hr>
                <h6 class="text-center text-uppercase text-muted fw-bold mt-3">Account Details</h6>
                <div class="row mt-4" id="accountDetails">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Role</label>
                        <input type="text" class="form-control" id="view_role" value="Tenant" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Phone</label>
                        <input type="text" class="form-control" id="view_phone" value="09485421203" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Address</label>
                        <input type="text" class="form-control" id="view_commencement_address"
                            value="123 Main St, Anytown, USA" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">City</label>
                        <input type="text" class="form-control" id="view_city" value="Sample City" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">State</label>
                        <input type="text" class="form-control" id="view_state" value="Sample States" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Zip</label>
                        <input type="text" class="form-control" id="view_zip" value="1234" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
