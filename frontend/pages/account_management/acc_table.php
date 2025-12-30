<?php
require_once "../../../backend/auth/session_admin.php";
include "../../../backend/fetch_data.php";
require_once "../../../backend/user/add_user.php";
require_once "../../../backend/user/delete_user.php";

$users = getData('user');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submitBtn'])) {

    if (!empty($_POST['userID'])) {
        require_once "../../../backend/user/update_user.php";

        $result = updateUser(
            $con,
            $_POST['userID'],
            $_POST['name'],
            $_POST['email'],
            $_POST['password'], 
            $_POST['role']
        );

        if ($result === true) {
            echo "<script>window.updateUserSuccess = true;</script>";
        } else {
            echo "<script>window.updateUserError = " . json_encode($result) . ";</script>";
        }

    } else {
        $result = addUser($con, $_POST['name'], $_POST['email'], $_POST['password'], $_POST['role']);

        if ($result === true) {
            echo "<script>window.addUserSuccess = true;</script>";
        } else {
            echo "<script>window.addUserError = " . json_encode($result) . ";</script>";
        }
    }

}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['deleteUserID'])) {

    $userID = $_POST['deleteUserID'];

    $result = deleteUser($con, $userID);

    if ($result === true) {
        echo "<script>window.deleteUserSuccess = true;</script>";
        $users = getData('user'); 
    } else {
        echo "<script>window.deleteUserError = " . json_encode($result) . ";</script>";
    }
}
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
    <link rel="stylesheet" href="../../styles/pagination.css">
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
                <input type="text" id="search-input" placeholder="Search">
                <select id="role-filter">
                    <option value="all">All Roles</option>
                    <option value="lecturer">Lecturer</option>
                    <option value="admin">Admin</option>
                    <option value="student">Student</option>
                    <option value="staff">Staff</option>
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
                                <button type="button" class="border-button edit-btn" data-userid="<?= $user['userID'] ?>">
                                    <div class="icon-text-2">
                                        <img src="../../image/pencil.svg" alt="Edit" class="icon-buttons">
                                        <span>Edit</span>
                                    </div>
                                </button>
                                <button type="button" class="red-border-button delete-btn" data-userid="<?= $user['userID'] ?>">
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
                                <button type="button" class="border-button edit-btn" data-userid="<?= $user['userID'] ?>">
                                    <div class="icon-text-2">
                                        <img src="../../image/pencil.svg" alt="Edit" class="icon-buttons">
                                    </div>
                                </button>
                                
                                <button type="button" class="border-button delete-btn" data-userid="<?= $user['userID'] ?>">
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

        <div class="pagination-container">
            <button class="page-btn prev">
                <img src="../../image/arrow-left.svg" alt="Previous" class="icon-pagination">
            </button>
            <div class="page-numbers">

            </div>
            <button class="page-btn next">
                <img src="../../image/arrow-right.svg" alt="Previous" class="icon-pagination">
            </button>
        </div>

        <div id="add-user-modal" class="overlay-container">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="medium-green-title" id="modal-title">Add User</span>
                    <button class="close-btn" id="close-add-user">&times;</button>
                </div>

                <form id="add-user-form" method="POST" action="">
                    <input type="hidden" name="userID" id="edit-user-id">

                    <div class="field-group">
                        <div class="label-field">
                            <label class="green-description">Name</label>
                            <input type="text" name="name" placeholder="Enter full name" required />
                        </div>
                        <div class="label-field">
                            <label class="green-description">Password</label>
                            <input type="password" name="password" placeholder="Enter password" required />
                        </div>
                    </div>

                    <div class="field-group">
                        <div class="label-field">
                            <label class="green-description">Email</label>
                            <input type="email" name="email" placeholder="Enter email address" required />
                        </div>
                        <div class="label-field">
                            <label class="green-description">Role</label>
                            <select name="role" required>
                                <option value="Admin">Admin</option>
                                <option value="Lecturer">Lecturer</option>
                                <option value="Student">Student</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
                    </div>

                    <div class="right-button-group">
                        <button type="button" class="white-button" id="cancel-add-user">Cancel</button>
                        <button type="submit" class="green-button" id="submit-user-btn" name="submitBtn">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../../component/footer.php'; ?>
    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/account_table.js"></script>
    <script src="../../scripts/add_user.js"></script>
</body>
</html>