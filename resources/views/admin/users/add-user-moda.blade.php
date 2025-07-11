<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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