document.addEventListener("DOMContentLoaded", function () {
    // Default Overlay
    if (window.success) {
        document.querySelector(".overlay").classList.add("active");
        document.querySelector(".modal").classList.add("active");
        document.body.classList.add("modal-open");
    }

    // Special Type: Article Claim Points Overlay
    if (window.claimStatus === 'success') {
        document.querySelector(".overlay").classList.add("active");
        document.querySelector(".modal").classList.add("active");
        document.body.classList.add("modal-open");
        document.querySelector(".modal .modal-img").src = "../../image/verify.svg"
        document.querySelector(".modal .modal-img").alt = "Verify"
        document.querySelector(".modal .medium-green-title").innerText = "Points Claimed!";
        document.querySelector(".modal .green-description").innerText = "You have successfully claimed the points, thanks for reading.";
    }
    if (window.claimStatus === 'already') {
        document.querySelector(".overlay").classList.add("active");
        document.querySelector(".modal").classList.add("active");
        document.body.classList.add("modal-open");
        document.querySelector(".modal .modal-img").src = "../../image/wrong.svg"
        document.querySelector(".modal .modal-img").alt = "Failed"
        document.querySelector(".modal .medium-green-title").innerText = "Already Claimed!";
        document.querySelector(".modal .green-description").innerText = "You have already claimed points for this article.";
    }
});