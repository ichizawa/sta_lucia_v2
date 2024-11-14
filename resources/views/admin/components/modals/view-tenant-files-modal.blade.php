<div class="modal fade" id="tenantDocuments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tenant Documents</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <table class="table table-fluid table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Document Name</th>
                                <th>Document Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tenant-documents">

                        <tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer" id="tenant-doc-stats">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="tenantCheckDocument" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
    tabindex="-1">
    <div class="modal-dialog modal-lg modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Tenant Documents</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid d-flex justify-content-center align-items-center text-center" id="tenant-documents-pdf" style="height: 84vh;">
                    <!-- <iframe id="tenant-documents-pdf" src="" width="100%" height="100%" style="border: none;"></iframe> -->
                </div>
            </div>
            <div class="modal-footer" id="tenant-documents-footer">

            </div>
        </div>
    </div>
</div>