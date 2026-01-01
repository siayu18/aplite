document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("add-user-modal");
    const form = document.getElementById("add-user-form");
    const modalTitle = document.getElementById("modal-title");
    const submitBtn = document.getElementById("submit-user-btn");

    const fields = {
        id: document.getElementById("edit-user-id"),
        name: form.querySelector("input[name='name']"),
        email: form.querySelector("input[name='email']"),
        pass: form.querySelector("input[name='password']"),
        role: form.querySelector("select[name='role']")
    };

    document.getElementById("add-user-btn").addEventListener("click", () => window.openAddUserModal());

    const closeModal = () => {
        modal.classList.remove("active");
        document.body.classList.remove("modal-open");
        const url = new URL(window.location);
        url.searchParams.delete('error');
        url.searchParams.delete('msg');
        window.history.replaceState({}, document.title, url.pathname);
    };

    window.openAddUserModal = () => {
        form.reset();
        fields.id.value = "";
        fields.pass.required = true;
        modalTitle.textContent = "Add User";
        submitBtn.textContent = "Add User";
        toggleModal(true);
    };

    window.openEditUserModal = (userId) => {
        const row = document.querySelector(`tr[data-userid='${userId}']`);
        if (!row) return;

        fields.id.value = userId;
        fields.name.value = row.dataset.name;
        fields.email.value = row.dataset.email;
        fields.role.value = row.dataset.role;
        fields.pass.value = "";
        fields.pass.required = false;

        modalTitle.textContent = "Edit User";
        submitBtn.textContent = "Update User";
        toggleModal(true);
    };

    function toggleModal(show) {
        modal.classList.toggle("active", show);
        document.body.classList.toggle("modal-open", show);
    }

    document.getElementById("close-add-user").onclick = closeModal;
    document.getElementById("cancel-add-user").onclick = closeModal;

    if (modal.classList.contains("active")) {
        document.body.classList.add("modal-open");
        
        const urlParams = new URLSearchParams(window.location.search);
        if (fields.id.value !== "") {
            modalTitle.textContent = "Edit User";
            submitBtn.textContent = "Update User";
            fields.pass.required = false;
        }
    }
});