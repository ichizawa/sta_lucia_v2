<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editUserForm" method="POST" enctype="multipart/form-data" 
            {{-- action="{{ route('admin.update.user') }}" --}}
            >
                @csrf
                @method('PUT') 
                <input type="hidden" name="id" id="user_id">
                <div class="modal-header brown-border-top">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label>Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Role</label>
                                <select class="form-control" name="type" id="type" required>
                                    <option value="">Select Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="bill">Bill</option>
                                    <option value="collect">Collect</option>
                                    <option value="operation">Operation</option>
                                    <option value="lease">Lease</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sta">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('.editUserBtn').on('click', function () {
            let userData = $(this).attr('data-user');

            try {
                // Parse data (if stored as JSON string)
                let user = typeof userData === "object" ? userData : JSON.parse(userData);

                // Optional: debug output
                console.log("User data loaded:", user);

                // Populate form fields
                $('#user_id').val(user.id);
                $('#name').val(user.name);
                $('#username').val(user.username);
                $('#address').val(user.address);
                $('#email').val(user.email);
                $('#phone').val(user.phone);
                $('#type').val(user.type);
                $('#status').val(user.status);
            } catch (error) {
                console.error("Error parsing user data:", error, userData);
            }
        });
    });
</script>
