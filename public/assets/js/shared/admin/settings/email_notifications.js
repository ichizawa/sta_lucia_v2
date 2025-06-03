document.addEventListener("DOMContentLoaded", () => {
    const createBtn = document.getElementById("createTemplateBtn");
    const cancelBtn = document.getElementById("cancelTemplateBtn");
    const templateList = document.getElementById("templateList");
    const templateForm = document.getElementById("templateForm");
    const themeColorSelect = document.getElementById("themeColorSelect");
    const colorSwatch = document.getElementById("colorSwatch");

    const updateSwatch = () => {
        const selectedColor = themeColorSelect.value;
        colorSwatch.style.backgroundColor = selectedColor;
    };

    createBtn.addEventListener("click", () => {
        templateList.classList.add("d-none");
        templateForm.classList.remove("d-none");

        document.getElementById("emailTemplateForm").reset();
        themeColorSelect.value = "#f44336";
        updateSwatch();
    });

    cancelBtn?.addEventListener("click", () => {
        templateForm.classList.add("d-none");
        templateList.classList.remove("d-none");
    });

    themeColorSelect.addEventListener("change", updateSwatch);

    document
        .getElementById("previewTemplateBtn")
        .addEventListener("click", () => {
            const subject =
                document.getElementById("subject").value || "Subject";
            const bannerText =
                document.getElementById("bannerText").value || "Banner Text";
            const themeColor = themeColorSelect.value;
            const emailBody = document.getElementById("emailBody").value || "";
            const footerText =
                document.getElementById("footerText").value ||
                "© 2025 Sta. Lucia. All rights reserved.";

            const preview = document.getElementById("templatePreviewContent");
            preview.style.setProperty("--theme-color", themeColor);

            document.getElementById("previewSubject").textContent = subject;
            document.getElementById("previewBannerText").textContent =
                bannerText;
            document.getElementById("previewEmailBody").innerHTML =
                emailBody.replace(/\n/g, "<br>");
            document.getElementById("previewFooterText").textContent =
                footerText;

            const modal = new bootstrap.Modal(
                document.getElementById("viewTemplateModal")
            );
            modal.show();
        });

    updateSwatch();

    document.querySelectorAll(".edit-template-btn").forEach((btn) => {
        btn.addEventListener("click", (e) => {
            templateList.classList.add("d-none");
            templateForm.classList.remove("d-none");

            const formHeader = templateForm.querySelector(".card-title");
            if (formHeader) {
                formHeader.innerHTML = `Update Template <i class="fa-solid fa-pen fa-sm"></i>`;
            }

            const submitBtn = templateForm.querySelector(
                'button[type="submit"]'
            );
            if (submitBtn) {
                submitBtn.innerHTML =
                    '<i class="fa fa-refresh"></i> Update Template';
            }

            document.getElementById("templateName").value =
                "Registration Rejected";
            document.getElementById("subject").value = "Registration Status";
            document.getElementById("bannerText").value = "Rejected";
            document.getElementById("themeColorSelect").value = "#f44336";
            document.getElementById("emailBody").value =
                "Your registration has been rejected.";
            document.getElementById("footerText").value =
                "© 2025 Sta. Lucia. All rights reserved.";

            updateSwatch();
        });
    });

    document.querySelectorAll(".delete-template-btn").forEach((btn) => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure?",
                text: "This action will permanently delete the template.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#f25961",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Delete",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: "success",
                        title: "Deleted",
                        text: "Template has been successfully deleted.",
                        confirmButtonColor: "#787e83",
                    });

                    const row = btn.closest("tr");
                    if (row) {
                        row.remove();
                    }
                }
            });
        });
    });
});
