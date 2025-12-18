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
                <div class="avatar-card">
                    <img src="../../image/Profile-2.svg" alt="Profile Picture" class="avatar-img">

                    <div class="avatar-title-btn">
                        <div class="avatar-card-title">
                            <h1 class="green-title">Change Avatar</h1>
                            <p class="dark-green-description">Select a profile picture</p>
                        </div>

                        <button class="green-button">
                            <span>Select Avatar</span>
                        </button>
                    </div>
                </div>

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
                <button class="red-border-button">
                    <div class="icon-text">
                        <img src="../../image/sign-out.svg" alt="sign-out">
                        <span>Sign Out</span>
                    </div>
                </button>
           </div>
       </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>