<?php
require_once "../../../backend/auth/session.php";
require_once "../../../backend/conn.php";

$userId = $_SESSION['user_id'];
$sql = "
    SELECT name, email, points, streak, lastLogin, picture, role
    FROM user
    WHERE userID = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

$avatarFolderUrl = "/aplite/frontend/image/avatars/";
$defaultAvatarUrl = "/aplite/frontend/image/default/Profile-2.svg";

$avatarUrl = $defaultAvatarUrl; 

if (!empty($userData['picture'])) {

    $avatarPath = $_SERVER['DOCUMENT_ROOT'] . "/aplite/frontend/image/avatars/" . $userData['picture'];

    if(file_exists($avatarPath)) { 
        $avatarUrl = $avatarFolderUrl . $userData['picture'];
    }
}

$points = $userData['points'];
$streak = $userData['streak'];
$lastLogin = $userData['lastLogin'] ? date('M d, Y', strtotime($userData['lastLogin'])) : "Never";
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
    <title>Profile Management</title>
</head>
<body>
    <?php include '../../component/load_header.php'; ?>
    <div class="content fade-in" style="padding: 2rem;">
       <div class="profile-header">
            <h1 class="green-title">Profile Settings</h1>
            <p class="green-description">Manage your account information and preferences</p>
       </div> 
       <div class="main-contents">
           <div class="settings-column">

                <form method="POST" action="../../../backend/user/update_avatar.php" enctype="multipart/form-data">
                    <div class="avatar-card">

                        <img
                            src="<?=  $avatarUrl ?>"
                            alt="Profile Picture"
                            class="avatar-img"
                            id="avatar-preview"
                        >

                        <input
                            type="file"
                            name="avatar"
                            id="avatar-input"
                            accept="image/*"
                            hidden
                        >

                        <div class="avatar-title-btn">
                            <div class="avatar-card-title">
                                <h1 class="green-title"><?= htmlspecialchars($userData['name']) ?></h1>
                                <p class="dark-green-description">Current Role: <?= htmlspecialchars($userData['role']) ?></p>
                            </div>

                            <button type="button" class="green-button" id="select-avatar-btn">
                                <span>Select Avatar</span>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="profile-details-card">
                        <h1 class="green-title">Personal Information</h1>
                    <form method="POST" action="../../../backend/user/update_profile.php" id="profile-form">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="name" value="<?= htmlspecialchars($userData['name']) ?>" placeholder="enter username" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" value="<?= htmlspecialchars($userData['email']) ?>" placeholder="enter email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="enter new password">
                        </div>

                        <div class="btn-group">
                            <button type="submit" class="big-green-button"><span>Save Changes</span></button>
                            <button type="button" class="big-red-button" id="discard-btn"><span>Discard</span></button>
                        </div>
                    </form>
                </div>
           </div>
           <div class="additional-info-column">
               <h1 class="green-title">Account Overview</h1>
               <div class="detail-group">
                    <span class="dark-green-description">Last login</span>
                    <span class="results"><?= $lastLogin ?></span>
               </div>
               <div class="detail-group">
                    <span class="dark-green-description">Streak</span>
                    <span class="results"><?= $streak ?> days</span>
               </div>
               <div class="detail-group">
                    <span class="dark-green-description">Points</span>
                    <span class="results"><?= $points ?> pts</span>
               </div>
                <a href="../../../backend/auth/logout.php" class="sign-out-button">
                    <div class="icon-text-clean">
                        <img src="../../image/sign-out.svg" alt="sign-out">
                        <span>Sign Out</span>
                    </div>
                </a>
           </div>
       </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script>
        // Avatar selection preview
        document.getElementById('select-avatar-btn').addEventListener('click', function() {
            document.getElementById('avatar-input').click();
        });

        document.getElementById('avatar-input').addEventListener('change', function () {
            if (this.files.length > 0) {
                this.form.submit();
            }
        });

        // Restore original details on discard
        const profileForm = document.getElementById('profile-form');
        const discardBtn = document.getElementById('discard-btn');

        const originalData = {
            name: profileForm.name.value,
            email: profileForm.email.value,
            password: ''
        };

        discardBtn.addEventListener('click', () => {
            profileForm.name.value = originalData.name;
            profileForm.email.value = originalData.email;
            profileForm.password.value = originalData.password;
        });

    </script>
</body>
</html>