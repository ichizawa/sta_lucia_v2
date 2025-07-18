
<!-- EDIT MODAL-->
<div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="editRoleForm" action="{{ route('admin.update.roles') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="edit_role_id">
            <div class="modal-content">
                <div class="modal-header border-0 brown-border-top">
                    <h5 class="modal-title">
                        <span class="fw-mediumbold">Update Role</span>
                    </h5>
                    
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 mb-3">
                            <div class="form-group form-group-default">
                                <label>Role Name</label>
                                <input type="text" id="edit_role_name" name="name" class="form-control" placeholder="Enter Role Name" required />
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Role Type</label>
                                <input type="text" id="edit_role_type" name="type" class="form-control" placeholder="Enter Role Type" required />
                                <small class="text-muted form-text">e.g., admin, super admin, biller, etc.</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-md btn-sta">Update</button>
                    
                </div>
            </div>
        </form>
    </div>
</div>
