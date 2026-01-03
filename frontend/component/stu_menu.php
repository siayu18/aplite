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
        <a class="menu-text" href="../dashboard/dashboard.php">Home</a>
        <a class="menu-text" href="../light_management/control_lights.php">Light Control</a>
        <a class="menu-text" href="../quiz/choose_quiz.php">Quizzes</a>
        <a class="menu-text" href="../article/choose_article.php">Articles</a>
        <a class="menu-text" href="../redemption/redemption_history.php">Redemptions</a>
        <a class="menu-text" href="../reward/reward_exchange.php">Rewards</a>
        <a class="menu-text" href="#">Report Issue</a>
        <a class="menu-text" href="../announcement/announcement.php">Announcements</a>

        <a href="../account_management/profile.php"><img src="<?= $avatar ?>" alt="Profile" class="<?= $profileExist ? 'profile-img' : 'menu-img' ?>" /></a>
        <button id="more-button"><img src="../../image/more.svg" alt="More" class="menu-img" /></button>
        <div id="dropdown-menu" class="dropdown-content">
            <a href="../dashboard/dashboard.php">Home</a>
            <a href="../light_management/control_lights.php">Light Control</a>
            <a href="../quiz/choose_quiz.php">Quizzes</a>
            <a href="../article/choose_article.php">Articles</a>
            <a class="#" href="#">Redemptions</a>
            <a href="#">Rewards</a>
            <a href="../report/reports_page">Report Issue</a>
            <a href="../announcement/announcement.php">Announcements</a>
        </div>
    </div>
</body>
</html>
