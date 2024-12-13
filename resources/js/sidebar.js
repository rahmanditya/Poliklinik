document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.querySelector(".sidebar");
    const header = document.querySelector("header");

    if (!sessionStorage.getItem("hasAnimated")) {
        sidebar?.classList.add("animated");
        header?.classList.add("animated");
        sessionStorage.setItem("hasAnimated", "true");
    }
});
