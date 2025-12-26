<?php
require_once "../../../backend/auth/session_admin.php";
include "../../../backend/fetch_data.php";

$users = getData('user');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Outfit:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sixtyfour&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/component.css">
    <link rel="stylesheet" href="../../styles/profile.css">
    <link rel="stylesheet" href="../../styles/announcement.css">
    <title>Account Table</title>
</head>
<body>
    <?php include '../../component/admin_header.php'; ?>
    <div class="content fade-in" style="padding: 2rem;">
        <div class="profile-header">
            <h1 class="green-title">Manage Users</h1>
            <p class="green-description">Make changes to user information with 1 click</p>
        </div>

        <div class="top-group">
            <div class="search-bar">
                <input type="text" placeholder="Search">
                <select id="role-filter">
                    <option>Filter roles</option>
                    <option>Lecturer</option>
                    <option>Admin</option>
                    <option>Student</option>
                    <option>Staff</option>
                </select>
            </div>
            <div class="add-user">
                <button class="big-green-button" id="add-user-btn">
                    <div class="icon-text-3">
                        <img src="../../image/add-user.svg" alt="add-user" class="add-icon">
                        <span>Add User</span>
                    </div>
                </button>
            </div>
        </div>

        <div class="desktop-table">
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Points</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="user-table-body">
                    <?php foreach($users as $user): ?>
                    <tr data-role="<?= htmlspecialchars($user['role']) ?>" data-name="<?= htmlspecialchars($user['name']) ?>">
                        <td>
                            <div class="icon-text-2-left">
                                <img src="<?= !empty($user['picture']) ? "/aplite/frontend/image/avatars/".$user['picture'] : "/aplite/frontend/image/default/Profile-2.svg" ?>"
                                    alt="Edit" class="icon-name">
                                <span><?= htmlspecialchars($user['name']) ?></span>
                            </div>
                        </td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td><?= htmlspecialchars($user['points']) ?></td>
                        <td>
                            <div class="btn-group">
                                <button class="border-button edit-btn" data-userid="<?= $user['userID'] ?>">
                                    <div class="icon-text-2">
                                        <img src="../../image/pencil.svg" alt="Edit" class="icon-buttons">
                                        <span>Edit</span>
                                    </div>
                                </button>
                                <button class="red-border-button delete-btn" data-userid="<?= $user['userID'] ?>">
                                    <div class="icon-text-2">
                                        <img src="../../image/trash.svg" alt="Delete" class="icon-buttons">
                                        <span>Delete</span>
                                    </div>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mobile-list">
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="user-mobile-body">
                    <?php foreach($users as $user): ?>
                    <tr data-role="<?= htmlspecialchars($user['role']) ?>" data-name="<?= htmlspecialchars($user['name']) ?>">
                        <td>
                            <div class="icon-text-2-left">
                                <img src="<?= !empty($user['picture']) ? "/aplite/frontend/image/avatars/".$user['picture'] : "/aplite/frontend/image/default/Profile-2.svg" ?>"
                                    alt="profile" class="icon-name">
                                <span><?= htmlspecialchars($user['name']) ?></span>
                            </div>
                        </td>

                        <td>
                            <div class="btn-group">
                                <button class="border-button edit-btn" data-userid="<?= $user['userID'] ?>">
                                    <div class="icon-text-2">
                                        <img src="../../image/pencil.svg" alt="Edit" class="icon-buttons">
                                    </div>
                                </button>
                                
                                <button class="border-button delete-btn" data-userid="<?= $user['userID'] ?>">
                                    <div class="icon-text-2">
                                        <img src="../../image/trash.svg" alt="Delete" class="icon-buttons">
                                    </div>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include '../../component/footer.php'; ?>
    <script src="../../scripts/animation.js"></script>

    <script>
        // Search function

        const searchInput = document.getElementById('search-input');
        const roleFilter = document.getElementById('role-filter');
        const tableBody = document.getElementById('user-table-body');
        const mobileBody = document.getElementById('user-mobile-body');

        function filterUsers() {
            const query = searchInput.value.toLowerCase();
            const role = roleFilter.value.toLowerCase();

            [...tableBody.rows].forEach(row => {
                const name = row.dataset.name.toLowerCase();
                const rowRole = row.dataset.role.toLowerCase();
                row.style.display = (name.includes(query) && (role === '' || role === rowRole)) ? '' : 'none';
            });

            [...mobileBody.rows].forEach(row => {
                const name = row.dataset.name.toLowerCase();
                const rowRole = row.dataset.role.toLowerCase();
                row.style.display = (name.includes(query) && (role === '' || role === rowRole)) ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterUsers);
        roleFilter.addEventListener('change', filterUsers);
    </script>
</body>
</html>