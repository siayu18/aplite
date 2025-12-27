document.addEventListener("DOMContentLoaded", function () {
    const addUserBtn = document.getElementById("add-user-btn");
    const addUserModal = document.getElementById("add-user-modal");
    const closeBtn = document.getElementById("close-add-user");
    const cancelBtn = document.getElementById("cancel-add-user");

    // Open modal
    addUserBtn.addEventListener("click", function (e) {
        e.preventDefault(); // Prevent form/button default behavior
        addUserModal.classList.add("active");
        document.body.classList.add("modal-open");
    });

    // Close modal
    function closeModal() {
        addUserModal.classList.remove("active");
        document.body.classList.remove("modal-open");
    }

    closeBtn.addEventListener("click", closeModal);
    cancelBtn.addEventListener("click", closeModal);

    // Optional: click outside modal content closes it
    addUserModal.addEventListener("click", function (e) {
        if (e.target === addUserModal) {
            closeModal();
        }
    });
});
