<div class="card">
    <div id="contentListContainer">
        <div class="card-header brown-border-top">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-auto">
                    <h5 class="card-title mb-0">
                        Privacy & Safety
                        <i class="fa-solid fa-user-shield"></i>
                    </h5>
                </div>
                <div class="col-auto">
                    <button id="addContentBtn" class="btn btn-sta">
                        <i class="fa-solid fa-plus"></i> Add Content
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display table table-striped table-hover datatable">
                    <thead>
                        <tr>
                            <th class="text-center">Title</th>
                            <th class="text-center">Author</th>
                            <th class="text-center">Created at</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">Privacy Policy Update</td>
                            <td class="text-center">Faye Macs</td>
                            <td class="text-center">May 23, 2025</td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#contentModal"
                                    data-title="Privacy Policy Update"
                                    data-description="An update to how we collect, use, and protect your personal data. We are committed to transparency and ensuring your privacy rights are respected. This update clarifies data retention periods and user consent options."
                                    data-author="Faye Macs" data-date="May 23, 2025">
                                    <i class="fa fa-pen text-white"></i>
                                </a>
                                <a class="btn btn-sm btn-danger delete-content-btn" data-title="Privacy Policy Update">
                                    <i class="fa fa-trash text-white"></i>
                                </a>
                            </td>
                            <div class="modal fade" id="contentModal" tabindex="-1" aria-labelledby="contentModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header brown-border-top">
                                            <h5 class="modal-title" id="contentModalLabel">Content
                                                Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Title:</strong> <span id="modalTitle"></span></p>
                                            <p class="mb-0"><strong>Description:</strong></p>
                                            <p id="modalDescription"></p>
                                            <p class="text-muted mt-5 mb-0 small">
                                                <strong>Author:</strong>
                                                <span id="modalAuthor"></span> | <strong>Date
                                                    Created:</strong> <span id="modalDate"></span>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-sta btn-sm" id="updateContentBtn">
                                                <i class="far fa-edit"></i> Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="privacySafetyNewContent" class="d-none">
        <div class="card-header brown-border-top">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-auto">
                    <h5 class="card-title mb-0" id="formHeaderTitle">New Content <i class="fa-solid fa-pen fa-sm"></i>
                    </h5>

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row d-flex mb-3">
                <div class="col-sm-3 d-flex justify-content-start mt-1">
                    <input type="text" class="form-control" id="authorName" placeholder="Author Name">
                </div>
                <div class="col-sm-3 ms-auto">

                </div>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="date" placeholder="Date">
                </div>
            </div>
            <input type="text" class="form-control form-control-lg mb-3" placeholder="Add Title">

            <div class="editor"></div>

            <div class="d-flex justify-content-end">
                <a class="btn btn-secondary mt-3 me-2" id="cancelContentBtn">
                    <i class="fa-solid fa-times"></i> Cancel
                </a>
                <a class="btn btn-kt mt-3" id="saveContentBtn">
                    <i class="fa-solid fa-check"></i> Save
                </a>
            </div>
        </div>
    </div>
</div>
