class QuillEditor {
    constructor(editorClass) {
        this.editorClass = editorClass;
        this.quills = [];

        document.addEventListener("DOMContentLoaded", () => {
            this.initQuills();
        });
    }

    initQuills() {
        const editors = document.querySelectorAll(`.${this.editorClass}`);
        editors.forEach((editorEl) => {
            const quill = new Quill(editorEl, {
                theme: "snow",
                placeholder: "Write your content here...",
                modules: {
                    toolbar: [
                        [
                            {
                                header: [1, 2, false],
                            },
                        ],
                        ["bold", "italic", "underline"],
                        ["link", "blockquote", "code-block"],
                        [
                            {
                                list: "ordered",
                            },
                            {
                                list: "bullet",
                            },
                        ],
                        ["image"],
                    ],
                },
            });
            this.quills.push(quill);
        });
    }
}

new QuillEditor("editor");

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
});
