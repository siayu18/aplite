<?php
require_once "../../../backend/auth/session.php";
require_once "../../../backend/conn.php";

$userId = $_SESSION['user_id'];
$sql = "
    SELECT name, email, points, streak, lastLogin, picture
    FROM user
    WHERE userID = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
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
    <?php include '../../component/stu_header.php'; ?>
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
                            src="data:image/*;base64,<?php echo base64_encode($userData['picture']); ?>"
                            alt="Profile Picture"
                            class="avatar-img"
                            id="avatar-preview"
                        >

                        <input
                            type="file"
                            name="avatar"
                            id="avatar-input"
                            accept="image/*"
                            style="display:none;"
                        >

                        <div class="avatar-title-btn">
                            <div class="avatar-card-title">
                                <h1 class="green-title">Change Avatar</h1>
                                <p class="dark-green-description">Select a profile picture</p>
                            </div>

                            <button type="button" class="green-button" id="select-avatar-btn">
                                <span>Select Avatar</span>
                            </button>

                            <button type="submit" class="green-button">
                                <span>Upload</span>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="profile-details-card">
                        <h1 class="green-title">Personal Information</h1>
                    <form>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" placeholder="enter username" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" placeholder="enter email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" placeholder="enter password" required>
                        </div>
                    </form>
                </div>
                <div class="btn-group">
                    <button class="big-green-button"><span>Save Changes</span></button>
                    <button class="big-red-button"><span>Discard</span></button>
                </div>
           </div>
           <div class="additional-info-column">
               <h1 class="green-title">Account Overview</h1>
               <div class="detail-group">
                    <span class="dark-green-description">Last login</span>
                    <span class="results">Today</span>
               </div>
               <div class="detail-group">
                    <span class="dark-green-description">Streak</span>
                    <span class="results">48 Days</span>
               </div>
               <div class="detail-group">
                    <span class="dark-green-description">Points</span>
                    <span class="results">454 pts</span>
               </div>
                <a href="../../../backend/auth/logout.php" class="red-border-button">
                    <div class="icon-text">
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
        const selectBtn = document.getElementById('select-avatar-btn');
        const avatarInput = document.getElementById('avatar-input');
        const avatarPreview = document.getElementById('avatar-preview');

        selectBtn.addEventListener('click', () => avatarInput.click());
        avatarInput.addEventListener('change', () => {
            const file = avatarInput.files[0];
            if (file) avatarPreview.src = URL.createObjectURL(file);
        });
    </script>
</body>
</html>