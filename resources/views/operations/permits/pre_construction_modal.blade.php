<div class="modal fade" id="showLisstPermit" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Permits Table</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-row w-full align-items-center justify-content-end mb-3">
                    <button class="btn btn-sta me-3">
                        <i class="fa fa-plus"></i>
                        Release Permit
                    </button>
                </div>
                <div class="table-responsive">
                    <table id="showPermitsTable" class="display table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Permit #</th>
                                <th>Permit Name</th>
                                <th>Permit Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        const tablecontractlists = $('#showPermitsTable').DataTable({
            pageLength: 10,
        });
    });

</script>