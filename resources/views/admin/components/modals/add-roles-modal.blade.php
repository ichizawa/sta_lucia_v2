<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {{-- <form action="{{ route('admin.add.roles') }}" method="POST"> --}}
            @csrf
            <div class="modal-header brown-border-top">
                <h5 class="modal-title">Create Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Role Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name"
                                required />
                        </div>
                        <div class="col-md-6">
                            <label>Role</label>
                            <input type="text" class="form-control" name="role_type" placeholder="Enter Role Type"
                                required />
                            <small class="text-muted form-text">e.g., admin, super admin, biller, collector, operator,
                                lease admin</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                <button type="submit" class="btn btn-sta">Add Role</button>
            </div>
            </form>
        </div>
    </div>
</div>
