document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-btn").forEach((btn) => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const row = this.closest("tr");
            const accountName = row.querySelector("td").textContent;

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

    document.querySelectorAll(".disable-btn").forEach((btn) => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const row = this.closest("tr");
            const accountName = row.querySelector("td").textContent;
            const statusCell = row.querySelectorAll("td")[2];

            Swal.fire({
                title: `Disable ${accountName}?`,
                text: "This will disable the account's access to the system.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ffad46",
                cancelButtonColor: "#787e83",
                confirmButtonText: "Disable",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.isConfirmed) {
                    statusCell.innerHTML =
                        '<span class="badge bg-secondary">Disabled</span>';

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
});
