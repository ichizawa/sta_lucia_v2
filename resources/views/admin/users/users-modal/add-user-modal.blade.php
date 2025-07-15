<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.add.user') }}" method="POST">
                @csrf
                <div class="modal-header brown-border-top">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Enter Username" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Enter Address" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" name="phone" placeholder="Phone Number" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Role</label>
                                <select class="form-control" name="type" required>
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="bill">Bill</option>
                                    <option value="collect">Collect</option>
                                    <option value="operation">Operation</option>
                                    <option value="lease">Lease</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Category</label>
                                <select class="form-control" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="sample">Sample</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Sub - category</label>
                                <input type="text" class="form-control" name="subCategory" placeholder="Sub - category" required />
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <select class="form-control" name="status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 ">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" required />
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sta">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>

