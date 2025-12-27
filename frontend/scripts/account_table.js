document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById('search-input');
    const roleFilter = document.getElementById('role-filter');

    const tableBody = document.getElementById('user-table-body');
    const mobileBody = document.getElementById('user-mobile-body');

    let currentPage = 1;
    const rowsPerPage = 10;

    function filterUsers() {
        const query = searchInput.value.toLowerCase().trim();
        const role = roleFilter.value.toLowerCase();

        [...tableBody.rows].forEach(row => {
            const name = row.dataset.name.toLowerCase();
            const rowRole = row.dataset.role.toLowerCase();

            const matchName = name.includes(query);
            const matchRole = role === "all" || role === rowRole;

            row.style.display = (matchName && matchRole) ? "" : "none";
        });

        [...mobileBody.rows].forEach(row => {
            const name = row.dataset.name.toLowerCase();
            const rowRole = row.dataset.role.toLowerCase();

            const matchName = name.includes(query);
            const matchRole = role === "all" || role === rowRole;

            row.style.display = (matchName && matchRole) ? "" : "none";
        });

        currentPage = 1;
        displayPage();
        setupPagination();
    }

    searchInput.addEventListener('input', filterUsers);
    roleFilter.addEventListener('change', filterUsers);

    function getFilteredRows() {
        return [...tableBody.rows].filter(r => r.style.display !== "none");
    }

    function displayPage() {
        const filteredRows = getFilteredRows();

        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        filteredRows.forEach((row, index) => {
            if (index >= start && index < end) {
                row.style.visibility = "";
                row.style.position = "";
            } else {
                row.style.visibility = "hidden";
                row.style.position = "absolute";
            }
        });
    }

    function setupPagination() {
        const filteredRows = getFilteredRows();
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);

        const container = document.querySelector(".page-numbers");
        container.innerHTML = "";

        if (totalPages <= 1) return;

        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");
            btn.classList.add("page-btn");
            btn.textContent = i;

            if (i === currentPage) btn.classList.add("active");

            btn.addEventListener("click", () => {
                currentPage = i;
                displayPage();
                setupPagination();
            });

            container.appendChild(btn);
        }
    }

    document.querySelector(".prev").addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            displayPage();
            setupPagination();
        }
    });

    document.querySelector(".next").addEventListener("click", () => {
        const totalRows = getFilteredRows().length;
        const totalPages = Math.ceil(totalRows / rowsPerPage);

        if (currentPage < totalPages) {
            currentPage++;
            displayPage();
            setupPagination();
        }
    });

    displayPage();
    setupPagination();
});