document.addEventListener("DOMContentLoaded", () => {
    const mockDocuments = {
        "Lease Proposals": [
            {
                name: "lease_proposal_01.pdf",
                uploadedBy: "John Doe",
                date: "2025-05-15",
            },
            {
                name: "lease_proposal_02.pdf",
                uploadedBy: "Jane Smith",
                date: "2025-05-20",
            },
            {
                name: "lease_proposal_03.pdf",
                uploadedBy: "Ana Cruz",
                date: "2025-05-22",
            },
        ],
    };

    function setupViewAllButtons() {
        const viewAllButtons = document.querySelectorAll(".btn-warning");
        viewAllButtons.forEach((btn) => {
            btn.addEventListener("click", () => {
                const documentType = btn
                    .closest("tr")
                    .querySelector("td")
                    .innerText.trim();
                document.getElementById("documentTypeTitle").innerText =
                    documentType;

                const tableBody = document.getElementById("documentsTableBody");
                const table = $(".modal .datatable");

                if ($.fn.DataTable.isDataTable(table)) {
                    table.DataTable().clear().destroy();
                }
                tableBody.innerHTML = "";

                const docs = mockDocuments[documentType] || [];
                docs.forEach((doc) => {
                    tableBody.innerHTML += `
            <tr>
              <td class="text-center">${doc.name}</td>
              <td class="text-center">${doc.uploadedBy}</td>
              <td class="text-center">${doc.date}</td>
              <td class="text-center">
                <div class="d-grid d-md-flex gap-2 justify-content-center">
                  <a href="#" class="btn btn-sm btn-success">
                    <i class="fa-regular fa-eye"></i>
                  </a>
                  <a href="#" class="btn btn-sm btn-info">
                    <i class="fa-solid fa-download"></i>
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
                    destroy: true,
                });
            });
        });
    }

    function setupDownloadAllButtons() {
        const downloadAllButtons = document.querySelectorAll(
            '.btn-info[title="Download All"]'
        );
        downloadAllButtons.forEach((btn) => {
            btn.addEventListener("click", (e) => {
                e.preventDefault();

                const row = btn.closest("tr");
                const documentType = row.querySelector("td").innerText.trim();

                Swal.fire({
                    title: `Download All ${documentType}?`,
                    text: "You are trying to download all files in this category",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Download All",
                    confirmButtonColor: "#8F8258",
                    cancelButtonText: "Cancel",
                    reverseButtons: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Download started!",
                            icon: "success",
                            timer: 1500,
                            showConfirmButton: false,
                        });
                    }
                });
            });
        });
    }

    setupViewAllButtons();
    setupDownloadAllButtons();
});
