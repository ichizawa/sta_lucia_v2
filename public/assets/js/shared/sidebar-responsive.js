function autoToggleSidebarForIpadPro() {
    const screenWidth = window.innerWidth;
    const isIpadPro = screenWidth >= 1024 && screenWidth <= 1366;
    if (isIpadPro) {

        setTimeout(() => {
            const toggleButton = document.querySelector(".toggle-sidebar");
            if (toggleButton && !document.body.classList.contains('sidebar-toggled')) {
                toggleButton.click();
                document.body.classList.add(
                    'sidebar-toggled');
            }
        }, 300);
    }
}
document.addEventListener("DOMContentLoaded", autoToggleSidebarForIpadPro);