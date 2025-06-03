<div class="card">
    <div id="contentListContainer">
        <div class="card-header brown-border-top">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-auto">
                    <h5 class="card-title mb-0">
                        List of All Documents
                        <i class="fa-solid fa-folder-open fa-sm"></i>
                    </h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th class="text-center">Document Type</th>
                            <th class="text-center">Total Files</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">Lease Proposals</td>
                            <td class="text-center">49</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#viewAllselectedData" title="View All">
                                        <i class="fa fa-pen text-white"></i>
                                    </a>

                                    <a class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Download All">
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewAllselectedData" tabindex="-1" aria-labelledby="viewAllselectedDataLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header brown-border-top">
                <h5 class="modal-title" id="viewAllselectedDataLabel">
                    All <span id="documentTypeTitle">Lease Proposals</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th class="text-center">File Name</th>
                                <th class="text-center">Uploaded By</th>
                                <th class="text-center">Upload Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="documentsTableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
