import './bootstrap';


document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.querySelector(".sidebar");
    const header = document.querySelector("header");

    // Ensure animation runs only once on page load
    if (!sidebar.classList.contains("animated")) {
        sidebar.classList.add("animated");
    }

    if (!header.classList.contains("animated")) {
        header.classList.add("animated");
    }
});
