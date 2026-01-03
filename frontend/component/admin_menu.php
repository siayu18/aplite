<?php
include "../../../backend/conn.php";

$userID = $_SESSION['user_id'];
$sql = "
    SELECT name, email, points, streak, lastLogin, picture, role
    FROM user
    WHERE userID = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param('i', $userID);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

$avatarFolder = "/aplite/frontend/image/avatars/";
$defaultAvatar = "/aplite/frontend/image/default/Profile-4.svg";

$avatar = $defaultAvatar; 
$profileExist = false;

if (!empty($userData['picture'])) {

    $avatarPath = $_SERVER['DOCUMENT_ROOT'] . "/aplite/frontend/image/avatars/" . $userData['picture'];

    if(file_exists($avatarPath)) { 
        $profileExist = true;
        $avatar = $avatarFolder . $userData['picture'];
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
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Outfit:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sixtyfour&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/component.css">
</head>

<body>
    <div class="menu">
        <a class="menu-text" href="../dashboard/admin_dashboard.php">Home</a>
        <a class="menu-text" href="../account_management/acc_table.php">Manage Users</a>
        <a class="menu-text" href="../announcement/manage_announcement.php">Manage Announcements</a>
        <a class="menu-text" href="../redemption/manage_redemption.php">Manage Redemptions</a>
        <a class="menu-text" href="../reward/manage_rewards.php">Manage Rewards</a>
        <a class="menu-text" href="../generate_report/admin_room_reports.php">Generate Report</a>

        <a href="../account_management/profile.php"><img src="<?= $avatar ?>" alt="Profile" class="<?= $profileExist ? 'profile-img' : 'menu-img' ?>" /></a>
        <button id="more-button"><img src="../../image/more.svg" alt="More" class="menu-img" /></button>
        <div id="dropdown-menu" class="dropdown-content">
            <a href="../dashboard/admin_dashboard.php">Home</a>
            <a href="../account_management/acc_table.php">Manage Users</a>
            <a href="../announcement/manage_announcement.php">Manage Announcements</a>
            <a href="../redemption/manage_redemption.php">Manage Redemptions</a>
            <a href="../reward/reward_exchange.php">Manage Rewards</a>
            <a href="../generate_report/admin_room_reports.php">Generate Report</a>
        </div>
    </div>  
</body>
</html>