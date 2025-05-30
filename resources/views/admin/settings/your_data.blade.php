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
                                    <a class="btn btn-sm btn-warning" title="View" data-bs-toggle="modal"
                                        data-bs-target="#viewAccountModal" title="View All">
                                        <i class="fa fa-pen text-white"></i> View All
                                    </a>
                                    <a class="btn btn-sm btn-danger delete-btn" data-bs-toggle="tooltip"
                                        title="Download All">
                                        <i class="fa-solid fa-download"></i> Download All

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
<!-- Modal -->
<div class="modal fade" id="viewAccountModal" tabindex="-1" aria-labelledby="viewAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header brown-border-top">
                <h5 class="modal-title" id="viewAccountModalLabel">
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
<script>
    const mockDocuments = {
        "Lease Proposals": [{
                name: "lease_proposal_01.pdf",
                uploadedBy: "John Doe",
                date: "2025-05-15"
            },
            {
                name: "lease_proposal_02.pdf",
                uploadedBy: "Jane Smith",
                date: "2025-05-20"
            },
            {
                name: "lease_proposal_03.pdf",
                uploadedBy: "Ana Cruz",
                date: "2025-05-22"
            }
        ],
    };
    document.querySelectorAll('.btn-warning').forEach((btn) => {
        btn.addEventListener('click', function() {
            const documentType = this.closest('tr').querySelector('td').innerText.trim();
            document.getElementById('documentTypeTitle').innerText = documentType;

            const tableBody = document.getElementById('documentsTableBody');
            const table = $('.modal .datatable');

            if ($.fn.DataTable.isDataTable(table)) {
                table.DataTable().clear().destroy();
            }
            tableBody.innerHTML = '';
            const docs = mockDocuments[documentType] || [];
            docs.forEach(doc => {
                tableBody.innerHTML += `
                    <tr>
                        <td class="text-center">${doc.name}</td>
                        <td class="text-center">${doc.uploadedBy}</td>
                        <td class="text-center">${doc.date}</td>
                        <td class="text-center">
                            <div class="d-grid d-md-flex gap-2 justify-content-center">
                                <a href="#" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-download"></i> Download
                                </a>
                                <a href="#" class="btn btn-sm btn-warning">
                                    <i class="fa-regular fa-eye"></i> Preview
                                </a>
                            </div>
                        </td>
                    </tr>
                `;
            });
            table.DataTable({
                paging: true,
                searching: true,
                ordering: true,
                destroy: true
            });
        });
    });
</script>
