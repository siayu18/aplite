document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById('search-input');
    const roleFilter = document.getElementById('role-filter');
    const tableBodies = [
        document.getElementById('user-table-body'),
        document.getElementById('user-mobile-body')
    ];

    document.addEventListener("click", (e) => {
        const editBtn = e.target.closest(".edit-btn");
        if (editBtn) {
            const userId = editBtn.dataset.userid;
            if (window.openEditUserModal) {
                window.openEditUserModal(userId);
            }
            return;
        }

        const deleteBtn = e.target.closest(".delete-btn");
        if (deleteBtn) {
            const userId = deleteBtn.dataset.userid;
            const row = deleteBtn.closest("tr");
            const userName = row.dataset.name;

            document.getElementById("confirm-delete-id").value = userId;
            document.getElementById("delete-user-name").textContent = userName;

            const deleteModal = document.getElementById("delete-confirm-modal");
            deleteModal.classList.add("active");
            deleteModal.querySelector(".modal").classList.add("active");
            document.body.classList.add("modal-open");
        }
    });

    document.getElementById("close-delete-modal").onclick = closeDeleteModal;
    document.getElementById("cancel-delete-btn").onclick = closeDeleteModal;

    function closeDeleteModal() {
        const deleteModal = document.getElementById("delete-confirm-modal");
        deleteModal.classList.remove("active");
        deleteModal.querySelector(".modal").classList.remove("active");
        document.body.classList.remove("modal-open");
    }

    // Search and pagination
    let currentPage = 1;
    const rowsPerPage = 5;

    function getFilteredRows(body) {
        const query = searchInput.value.toLowerCase().trim();
        const role = roleFilter.value.toLowerCase();

        return [...body.rows].filter(row => {
            const name = (row.dataset.name || "").toLowerCase();
            const rowRole = (row.dataset.role || "").toLowerCase();
            return name.includes(query) && (role === "all" || role === rowRole);
        });
    }

    function displayPage() {
        tableBodies.forEach(body => {
            if (!body) return;
            const filteredRows = getFilteredRows(body);
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            [...body.rows].forEach(row => {
                const index = filteredRows.indexOf(row);
                row.style.display = (index >= start && index < end) ? "" : "none";
            });
        });
        setupPagination();
    }

    function setupPagination() {
        const filteredRows = getFilteredRows(tableBodies[0]);
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
        const container = document.querySelector(".page-numbers");
        if (!container) return;
        
        container.innerHTML = "";
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");
            btn.textContent = i;
            btn.className = `page-btn ${i === currentPage ? 'active' : ''}`;
            btn.onclick = () => { currentPage = i; displayPage(); };
            container.appendChild(btn);
        }

        document.querySelector(".prev").disabled = currentPage === 1;
        document.querySelector(".next").disabled = currentPage === totalPages || totalPages === 0;
    }

    document.querySelector(".prev").onclick = () => { if(currentPage > 1) { currentPage--; displayPage(); } };
    document.querySelector(".next").onclick = () => { 
        const totalPages = Math.ceil(getFilteredRows(tableBodies[0]).length / rowsPerPage);
        if(currentPage < totalPages) { currentPage++; displayPage(); } 
    };

    searchInput.oninput = () => { currentPage = 1; displayPage(); };
    roleFilter.onchange = () => { currentPage = 1; displayPage(); };

    displayPage();

});