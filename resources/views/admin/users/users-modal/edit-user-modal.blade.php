<div class="modal fade editUserModal" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editUserForm" method="POST" enctype="multipart/form-data" {{--
                action="{{ route('admin.update.user') }}" --}}>
                @csrf
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
                                <input type="text" class="form-control" id="name" name="name"
                                    required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Enter Username" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter Address" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Email" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Phone Number" required />
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
                                <label>Category</label>
                                <select class="form-control" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="sample">Sample</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Sub - category</label>
                                <input type="text" class="form-control" name="subCategory" placeholder="Sub - category"
                                    required />
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


{{--
<script>
    $(document).on('click', '.editUserBtn', function () {
        let userData = $(this).attr('user-details');

        try {
            let user = JSON.parse(userData);
            console.log("Test");
            console.log("User data loaded:", user);

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
</script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.editUserBtn', function () {
            $('#editUserForm').trigger('reset');

            let userId = $(this).data('user-id');

            $.ajax({
                url: "{{ route('admin.user.details') }}",
                type: "GET",
                data: {
                    id: userId,
                },
                success: function (response) {
                    $('#user_id').val(response.id);
                    $('#name').val(response.name);
                    $('#username').val(response.username);
                    $('#address').val(response.address);
                    $('#email').val(response.email);
                    $('#phone').val(response.phone);
                    $('#type').val(response.type);
                    $('#status').val(response.status);
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        });
    });

    console.log('Script Loaded');
</script>
