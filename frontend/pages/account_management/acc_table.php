<?php
require_once "../../../backend/auth/session_admin.php";
include "../../../backend/fetch_data.php";
require_once "../../../backend/user/add_user.php";
require_once "../../../backend/user/delete_user.php";
require_once "../../../backend/user/update_user.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['deleteUserID'])) {
        deleteUser($con, $_POST['deleteUserID']);
        header("Location: " . $_SERVER['PHP_SELF'] . "?msg=deleted");
        exit();
    }
    
   if (isset($_POST['submitBtn'])) {
        $userId = $_POST['userID'] ?? null;
        
        $result = (!empty($userId)) 
            ? updateUser($con, $userId, $_POST['name'], $_POST['email'], $_POST['password'], $_POST['role'])
            : addUser($con, $_POST['name'], $_POST['email'], $_POST['password'], $_POST['role']);

        if ($result === true) {
            $msg = (!empty($userId) ? "updated" : "added");
            header("Location: " . $_SERVER['PHP_SELF'] . "?msg=" . $msg);
            exit();
        } else {
            $errorMessageCode = $result; 
        }
    }
}

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
                    <tr data-userid="<?= htmlspecialchars($user['userID']) ?>" 
                        data-role="<?= htmlspecialchars($user['role']) ?>" 
                        data-name="<?= htmlspecialchars($user['name']) ?>"
                        data-email="<?= htmlspecialchars($user['email']) ?>">
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
                    <tr 
                        data-userid="<?= htmlspecialchars($user['userID']) ?>"
                        data-name="<?= htmlspecialchars($user['name']) ?>"
                        data-email="<?= htmlspecialchars($user['email']) ?>"
                        data-role="<?= htmlspecialchars($user['role']) ?>"
                    >
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

        <div id="add-user-modal" class="overlay-container <?= isset($errorMessageCode) ? 'active' : '' ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="medium-green-title" id="modal-title">
                        <?= isset($_GET['userID']) && !empty($_GET['userID']) ? 'Edit User' : 'Add User' ?>
                    </span>
                    <button class="close-btn" id="close-add-user">&times;</button>
                </div>

                <?php if (isset($errorMessageCode)): ?>
                    <?php 
                        $messages = [
                            'missing_fields' => 'Please fill in all required fields.',
                            'invalid_email'  => 'Please enter a valid email address.',
                            'email_exists'   => 'This email is already registered.',
                            'weak_password'  => 'Password must be 8+ chars with uppercase, number, and symbol.'
                        ];
                        $errorMsg = $messages[$errorMessageCode] ?? 'An unexpected error occurred.';
                    ?>
                    <div class="error-banner">
                        • <?= $errorMsg ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['msg'])): ?>
                    <div class="success-banner">
                        • Action completed successfully!
                    </div>
                <?php endif; ?>

                <form id="add-user-form" method="POST" action="">
                    <input type="hidden" name="userID" id="edit-user-id">

                    <div class="field-group">
                        <div class="label-field">
                            <label class="green-description">Name</label>
                            <input type="text" name="name" 
                                value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" 
                                placeholder="Enter full name" required />
                        </div>
                        <div class="label-field">
                            <label class="green-description">Password</label>
                            <input type="password" name="password" placeholder="Enter password" />
                        </div>
                    </div>

                    <div class="field-group">
                        <div class="label-field">
                            <label class="green-description">Email</label>
                            <input type="email" name="email" 
                                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" 
                                placeholder="Enter email address" required />
                        </div>
                        <div class="label-field">
                            <label class="green-description">Role</label>
                            <select name="role" required>
                                <?php $currentRole = $_POST['role'] ?? ''; ?>
                                <option value="Admin" <?= $currentRole == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="Lecturer" <?= $currentRole == 'Lecturer' ? 'selected' : '' ?>>Lecturer</option>
                                <option value="Student" <?= $currentRole == 'Student' ? 'selected' : '' ?>>Student</option>
                                <option value="Staff" <?= $currentRole == 'Staff' ? 'selected' : '' ?>>Staff</option>
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
    <script src="../../scripts/user_modal.js"></script>
</body>
</html>