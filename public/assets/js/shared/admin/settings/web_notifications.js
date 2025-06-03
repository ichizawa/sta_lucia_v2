document.addEventListener("DOMContentLoaded", () => {
    const announcementList = document.getElementById("announcementList");
    const createAnnouncement = document.getElementById("createAnnouncement");
    const formHeader = document.getElementById("announcementCardTitle");
    const saveBtnText = document.getElementById("announcementSaveText");

    const createBtn = document.getElementById("createAnnouncementBtn");
    const cancelBtn = document.getElementById("announcementCancelBtn");
    const container = document.getElementById("web_notifications");
    const searchInput = document.getElementById("announcementSearch");
    const noMsg = document.getElementById("noAnnouncementsMessage");

    const subtleColors = [
        "rgba(255, 193, 7, 0.15)",
        "rgba(23, 162, 184, 0.15)",
        "rgba(220, 53, 69, 0.15)",
        "rgba(0, 123, 255, 0.15)",
        "rgba(40, 167, 69, 0.15)",
        "rgba(108, 117, 125, 0.15)",
    ];

    const colorMap = {
        "rgba(255, 193, 7, 0.15)": "#fef6df",
        "rgba(23, 162, 184, 0.15)": "#cadee0",
        "rgba(220, 53, 69, 0.15)": "#f1dddf",
        "rgba(0, 123, 255, 0.15)": "#d7e8fa",
        "rgba(40, 167, 69, 0.15)": "#d7f2de",
        "rgba(108, 117, 125, 0.15)": "#dcdfe2",
    };

    const applyColorAlternating = () => {
        const currentItems = container.querySelectorAll(".list-group-item");
        currentItems.forEach((item, i) => {
            item.style.backgroundColor = subtleColors[i % subtleColors.length];
            item.classList.remove("text-white");
            item.classList.add("text-dark");
        });
    };

    const updateNoAnnouncementMessage = () => {
        const currentItems = container.querySelectorAll(".list-group-item");
        const anyVisible = Array.from(currentItems).some(
            (item) => item.style.display !== "none"
        );
        noMsg.classList.toggle("d-none", anyVisible);
    };

    if (createBtn) {
        createBtn.addEventListener("click", () => {
            announcementList.classList.add("d-none");
            createAnnouncement.classList.remove("d-none");
            createAnnouncement.scrollIntoView({ behavior: "smooth" });
        });
    }

    if (cancelBtn) {
        cancelBtn.addEventListener("click", () => {
            announcementList.classList.remove("d-none");
            createAnnouncement.classList.add("d-none");

            if (formHeader && saveBtnText) {
                formHeader.innerHTML =
                    'Create Announcement <i class="fa-solid fa-pen fa-sm"></i>';
                saveBtnText.textContent = "Save";
            }
        });
    }

    const viewButtons = document.querySelectorAll(
        ".dropdown-item[data-bs-target='#viewAnnouncementModal']"
    );

    viewButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const item = this.closest(".list-group-item");
            const title = item.querySelector("h5")?.textContent.trim();
            const body = item.querySelector("p")?.textContent.trim();
            const date = item
                .querySelector("span.text-muted")
                ?.textContent.trim();

            document.getElementById("viewAnnouncementModalLabel").textContent =
                title;
            document.getElementById("viewAnnouncementBody").textContent = body;
            document.getElementById("viewAnnouncementDate").textContent = date;

            const itemColor = window.getComputedStyle(item).backgroundColor;
            const header = document.querySelector(
                "#viewAnnouncementModal .modal-header"
            );
            header.style.backgroundColor = colorMap[itemColor] || "#f8f9fa";
        });
    });

    const updateButtons = document.querySelectorAll(
        ".dropdown-item:not([data-bs-target])"
    );

    updateButtons.forEach((button) => {
        button.addEventListener("click", function () {
            if (this.textContent.trim() === "Update Announcement") {
                formHeader.innerHTML =
                    'Update Announcement <i class="fa-solid fa-pen fa-sm"></i>';
                saveBtnText.textContent = "Save Changes";

                announcementList.classList.add("d-none");
                createAnnouncement.classList.remove("d-none");
                createAnnouncement.scrollIntoView({ behavior: "smooth" });
            }
        });
    });

    if (container) {
        applyColorAlternating();

        if (searchInput) {
            searchInput.addEventListener("input", () => {
                const query = searchInput.value.toLowerCase();
                const currentItems =
                    container.querySelectorAll(".list-group-item");

                currentItems.forEach((item) => {
                    const title =
                        item.querySelector("h5")?.textContent.toLowerCase() ||
                        "";
                    const body =
                        item.querySelector("p")?.textContent.toLowerCase() ||
                        "";
                    const matches =
                        title.includes(query) || body.includes(query);
                    item.style.display = matches ? "" : "none";
                });

                updateNoAnnouncementMessage();
            });
        }

        const deleteButtons = document.querySelectorAll(
            ".dropdown-item.delete-btn"
        );

        deleteButtons.forEach((button) => {
            button.addEventListener("click", function (e) {
                e.preventDefault();

                const announcementItem = this.closest(".list-group-item");

                Swal.fire({
                    title: "Announcement Deletion",
                    text: "You won't be able to revert this after deletion.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f25961",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Delete",
                }).then((result) => {
                    if (result.isConfirmed) {
                        announcementItem.remove();
                        applyColorAlternating();
                        updateNoAnnouncementMessage();

                        Swal.fire({
                            title: "Deleted!",
                            text: "The announcement has been deleted.",
                            icon: "success",
                            timer: 1600,
                            showConfirmButton: false,
                        });
                    }
                });
            });
        });

        updateNoAnnouncementMessage();
    }
});
