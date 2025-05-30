// CKEditor setup
ClassicEditor.create(document.querySelector("#editor"), {
    toolbar: [
        "heading",
        "|",
        "bold",
        "italic",
        "underline",
        "link",
        "bulletedList",
        "numberedList",
        "blockQuote",
        "|",
        "insertTable",
        "imageUpload",
        "mediaEmbed",
        "undo",
        "redo",
    ],
});

// SweetAlert for widgets
document.addEventListener("DOMContentLoaded", function () {
    const widgetsAlertBtn = document.getElementById("widgets-alert");
    if (widgetsAlertBtn) {
        widgetsAlertBtn.addEventListener("click", function () {
            Swal.fire({
                icon: "info",
                title: "Coming Soon...",
                text: "This feature is under development",
                confirmButtonColor: "#8B7231",
            });
        });
    }
    const disableAlertBtn = document.getElementById("disable-alert");
    if (disableAlertBtn) {
        widgetsAlertBtn.addEventListener("click", function () {
            Swal.fire({
                icon: "info",
                title: "Coming Soon...",
                text: "This feature is under development",
                confirmButtonColor: "#8B7231",
            });
        });
    }

    // Save Content - Privacy & Safety
    const saveBtn = document.getElementById("saveContent");
    if (saveBtn) {
        saveBtn.addEventListener("click", function (e) {
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

    // Add Content
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

    // Modal fill content
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
});

// Modal button: go to editor
function openPrivacySafetyEditor() {
    const modalEl = document.getElementById("contentModal");
    const modalInstance = bootstrap.Modal.getInstance(modalEl);
    if (modalInstance) modalInstance.hide();

    document.getElementById("contentListContainer").classList.add("d-none");
    document
        .getElementById("privacySafetyNewContent")
        .classList.remove("d-none");
    document
        .getElementById("privacySafetyNewContent")
        .scrollIntoView({ behavior: "smooth" });
}

$(".datatable").DataTable();

//compose email
document.getElementById("composeButton").addEventListener("click", function () {
    document.getElementById("emailList").classList.add("d-none");
    document.getElementById("writeEmail").classList.remove("d-none");
});

//create announcement
document
    .getElementById("createAnnouncementBtn")
    .addEventListener("click", function () {
        document.getElementById("announcementList").classList.add("d-none");
        document
            .getElementById("createAnnouncement")
            .classList.remove("d-none");
    });

//make the cms a class
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".editor").forEach((editorEl) => {
        ClassicEditor.create(editorEl).catch((error) => {
            console.error(error);
        });
    });
});

//temporary save email - redirect to #emailList
document.getElementById("saveEmail").addEventListener("click", function () {
    document.getElementById("writeEmail").classList.add("d-none");
    document.getElementById("emailList").classList.remove("d-none");
});

$(document).ready(function () {
    $(".delete-btn").on("click", function (e) {
        e.preventDefault();
        let row = $(this).closest("tr");
        let accountName = row.find("td").eq(0).text();

        Swal.fire({
            title: "Confirm Deletion",
            text: `Do you want to remove ${accountName}?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f25961",
            cancelButtonColor: "#787e83",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                row.remove();
                Swal.fire({
                    icon: "success",
                    title: "Deleted",
                    text: "User has been deleted successfully.",
                    confirmButtonColor: "#787e83",
                });
            }
        });
    });
});

$(document).ready(function () {
    $(".disable-btn").on("click", function (e) {
        e.preventDefault();
        let row = $(this).closest("tr");
        let accountName = row.find("td").eq(0).text();

        Swal.fire({
            title: `Disable ${accountName}?`,
            text: "This will disable the account's access to the system.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f25961",
            cancelButtonColor: "#787e83",
            confirmButtonText: "Disable",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                row.remove();
                Swal.fire({
                    icon: "success",
                    title: "Disabled",
                    text: "Account has been successfully disabled.",
                    confirmButtonColor: "#787e83",
                });
            }
        });
    });
});
