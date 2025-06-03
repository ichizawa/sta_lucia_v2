document.addEventListener("DOMContentLoaded", function () {
    const addBtn = document.getElementById("addContentBtn");
    if (addBtn) {
        addBtn.addEventListener("click", function () {
            document
                .getElementById("privacySafetyNewContent")
                .classList.remove("d-none");
            document
                .getElementById("contentListContainer")
                .classList.add("d-none");
            document
                .getElementById("privacySafetyNewContent")
                .scrollIntoView({ behavior: "smooth" });
        });
    }

    const cancelBtn = document.getElementById("cancelContentBtn");
    if (cancelBtn) {
        cancelBtn.addEventListener("click", function (e) {
            e.preventDefault();
            document
                .getElementById("contentListContainer")
                .classList.remove("d-none");
            document
                .getElementById("privacySafetyNewContent")
                .classList.add("d-none");
            document
                .getElementById("contentListContainer")
                .scrollIntoView({ behavior: "smooth" });
        });
    }

    const contentModal = document.getElementById("contentModal");
    if (contentModal) {
        contentModal.addEventListener("show.bs.modal", function (event) {
            const button = event.relatedTarget;
            document.getElementById("modalTitle").textContent =
                button.getAttribute("data-title");
            document.getElementById("modalDescription").textContent =
                button.getAttribute("data-description");
            document.getElementById("modalAuthor").textContent =
                button.getAttribute("data-author");
            document.getElementById("modalDate").textContent =
                button.getAttribute("data-date");
        });
    }

    if ($(".datatable").length) {
        $(".datatable").DataTable();
    }

    const updateEditorBtn = document.getElementById("updateContentBtn");
    if (updateEditorBtn) {
        updateEditorBtn.addEventListener("click", function () {
            const modalEl = document.getElementById("contentModal");
            const modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) modalInstance.hide();

            document
                .getElementById("privacySafetyNewContent")
                .classList.remove("d-none");
            document
                .getElementById("contentListContainer")
                .classList.add("d-none");
            document
                .getElementById("privacySafetyNewContent")
                .scrollIntoView({ behavior: "smooth" });

            document.getElementById("formHeaderTitle").innerHTML =
                'Update Content <i class="fa-solid fa-pen fa-sm"></i>';
            document.getElementById("saveContentBtn").innerHTML =
                '<i class="fa-solid fa-check"></i> Save Changes';
        });
    }

    document.querySelectorAll(".delete-content-btn").forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const title = btn.getAttribute("data-title") || "this content";

            Swal.fire({
                title: "Confirm Deletion",
                text: `You are deleting "${title}"`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f25961",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Delete",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: `"${title}" has been removed.`,
                        icon: "success",
                        confirmButtonColor: "#787e83",
                    });

                    const row = btn.closest("tr");
                    if (row) row.remove();
                }
            });
        });
    });
});
