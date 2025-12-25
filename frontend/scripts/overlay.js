document.addEventListener("DOMContentLoaded", function () {
    if (window.success) {
        document.querySelector(".overlay").classList.add("active");
        document.querySelector(".modal").classList.add("active");
        document.body.classList.add("modal-open");
    }
});