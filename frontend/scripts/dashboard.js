document.addEventListener("DOMContentLoaded", () => {
    const moreBtn = document.getElementById("more-button");
    const menu = document.getElementById("dropdown-menu");

    moreBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        menu.classList.toggle("show");
    });

    document.addEventListener("click", (e) => {
        if (!menu.contains(e.target) && !moreBtn.contains(e.target)) {
            menu.classList.remove("show");
        }
    });
});
