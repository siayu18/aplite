document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById('search-input');
    const roleFilter = document.getElementById('role-filter');

    const tableBodies = [
        document.getElementById('user-table-body'),   
        document.getElementById('user-mobile-body')  
    ];

        function attachDeleteEvents() {
        tableBodies.forEach(body => {
            body.querySelectorAll(".delete-btn").forEach(btn => {
                if (!btn.dataset.listener) {
                    btn.dataset.listener = "true";

                    btn.addEventListener("click", function () {
                        const userID = this.dataset.userid;

                        if (!confirm("Are you sure you want to delete this user?")) return;

                        fetch("", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            body: new URLSearchParams({
                                deleteUserID: userID
                            })
                        })
                        .then(response => response.text())
                        .then(data => {
                            window.location.reload(); 
                        })
                        .catch(err => {
                            alert("Failed to delete user. Try again.");
                            console.error(err);
                        });
                    });
                }
            });
        });
    }

    attachDeleteEvents();

    const rowsPerPage = 5;
    let currentPage = 1;

    function getFilteredRows(body) {
        const query = searchInput.value.toLowerCase().trim();
        const role = roleFilter.value.toLowerCase();

        return [...body.rows].filter(row => {
            const name = row.dataset.name.toLowerCase();
            const rowRole = row.dataset.role.toLowerCase();
            return name.includes(query) && (role === "all" || role === rowRole);
        });
    }

    function displayPage() {
        tableBodies.forEach(body => {
            const filteredRows = getFilteredRows(body);
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            [...body.rows].forEach(row => {
                if (filteredRows.includes(row) && filteredRows.indexOf(row) >= start && filteredRows.indexOf(row) < end) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    }

    function setupPagination() {
        const filteredRows = getFilteredRows(tableBodies[0]); 
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);

        const container = document.querySelector(".page-numbers");
        container.innerHTML = "";

        const maxButtons = 5; // max page numbers to display
        let startPage = Math.max(1, currentPage - Math.floor(maxButtons / 2));
        let endPage = Math.min(totalPages, startPage + maxButtons - 1);
        startPage = Math.max(1, endPage - maxButtons + 1);

        function createButton(page) {
            const btn = document.createElement("button");
            btn.textContent = page;
            btn.classList.add("page-btn");
            if (page === currentPage) btn.classList.add("active");

            btn.addEventListener("click", () => {
                currentPage = page;
                displayPage();
                setupPagination();
            });
            return btn;
        }

        if (startPage > 1) {
            container.appendChild(createButton(1));
            if (startPage > 2) {
                const ellipsis = document.createElement("span");
                ellipsis.textContent = "…";
                ellipsis.style.padding = "0 0.5rem";
                container.appendChild(ellipsis);
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            container.appendChild(createButton(i));
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                const ellipsis = document.createElement("span");
                ellipsis.textContent = "…";
                ellipsis.style.padding = "0 0.5rem";
                container.appendChild(ellipsis);
            }
            container.appendChild(createButton(totalPages));
        }

        document.querySelector(".prev").disabled = currentPage === 1;
        document.querySelector(".next").disabled = currentPage === totalPages || totalPages === 0;
    }

    // Prev/Next
    document.querySelector(".prev").addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            displayPage();
            setupPagination();
        }
    });

    document.querySelector(".next").addEventListener("click", () => {
        const totalPages = Math.ceil(getFilteredRows(tableBodies[0]).length / rowsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            displayPage();
            setupPagination();
        }
    });

    searchInput.addEventListener("input", () => {
        currentPage = 1;
        displayPage();
        setupPagination();
    });

    roleFilter.addEventListener("change", () => {
        currentPage = 1;
        displayPage();
        setupPagination();
    });

const modal = document.getElementById("add-user-modal");
    const modalTitle = document.getElementById("modal-title");
    const submitBtn = document.getElementById("submit-user-btn");

    const form = document.getElementById("add-user-form");

    const userIDField = document.getElementById("edit-user-id");
    const nameField = form.querySelector("input[name='name']");
    const emailField = form.querySelector("input[name='email']");
    const passField = form.querySelector("input[name='password']");
    const roleField = form.querySelector("select[name='role']");

    const addUserBtn = document.getElementById("add-user-btn");

    // RESET for Add User
    addUserBtn.addEventListener("click", () => {
        modalTitle.textContent = "Add User";
        submitBtn.textContent = "Add User";

        userIDField.value = "";
        nameField.value = "";
        emailField.value = "";
        passField.value = "";
        roleField.value = "Admin";

        passField.required = true;

        modal.classList.add("active");
        document.body.classList.add("modal-open");
    });

    // EDIT USER
    document.querySelectorAll(".edit-btn").forEach(btn => {
        btn.addEventListener("click", () => {

            const row = btn.closest("tr");

            nameField.value = row.querySelector("td:nth-child(1) span").textContent.trim();
            emailField.value = row.querySelector("td:nth-child(2)").textContent.trim();
            roleField.value = row.querySelector("td:nth-child(3)").textContent.trim();

            userIDField.value = btn.dataset.userid;
            passField.value = "";
            passField.required = false;

            modalTitle.textContent = "Edit User";
            submitBtn.textContent = "Update User";

            modal.classList.add("active");
            document.body.classList.add("modal-open");
        });
    });

    displayPage();
    setupPagination();
});
