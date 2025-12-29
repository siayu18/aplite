<?php
require_once "../../../backend/auth/session_staff.php";
include("../../../backend/conn.php");

// Total Users
$userResult = mysqli_query($con, "SELECT COUNT(*) AS total FROM user");
$userCount = mysqli_fetch_assoc($userResult)['total'];

// Total Quizzes
$quizResult = mysqli_query($con, "SELECT COUNT(*) AS total FROM quiz");
$quizCount = mysqli_fetch_assoc($quizResult)['total'];

// Total Reports
$reportResult = mysqli_query($con, "SELECT COUNT(*) AS total FROM brokenreport");
$reportCount = mysqli_fetch_assoc($reportResult)['total'];
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
    <link rel="stylesheet" href="../../styles/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>APLite</title>
</head>
<body>
    <div class="col-12 col-s-12 header fade-in">
        <div class="top-bar">
            <img src="../../image/logo.svg" alt="APLite Logo" class="logo" />
            <?php include("../../component/staff_menu.php") ?> 
        </div>
        <div class="middle-content">
            <span class="white-title">Welcome Back Staff, Sia Yu!</span>
            <span class="yellow-description">This is the staff panel and you can below contain the special dashboard for you.</span>
            <div class="card-container">
                <div class="transparent-card">
                    <div class="text-group">
                        <span class="medium-white-title"><?= $userCount ? $userCount : 0 ?></span>
                        <span class="white-description">Total Users</span>
                    </div>
                </div>
                 <div class="transparent-card">
                    <div class="text-group">
                        <span class="medium-white-title"><?= $quizCount ? $quizCount : 0 ?></span>
                        <span class="white-description">Total Quizzes</span>
                    </div>
                </div>
                 <div class="transparent-card">
                    <div class="text-group">
                        <span class="medium-white-title"><?= $reportCount ? $reportCount : 0 ?></span>
                        <span class="white-description">Total Reports</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-s-12 content-1 fade-in">
        <div class="text-group">
            <span class="green-title">Quick Access</span>
            <span class="green-description">Access to pages quickly through this section.</span>
        </div>
        <div class="card-container">
            <a href="../report/manage_reports.php"><div class="card">
                <img src="../../image/light.svg" alt="Light" class="card-img" />
                <p class="card-title">Manage Light Report</p>
                <p class="card-description">View and Manage Broken Light Reports (Approve / Reject)</p>
            </div>
            <a href="../quiz/manage_quiz.php"><div class="card">
                <img src="../../image/quiz.svg" alt="Quiz" class="card-img" />
                <p class="card-title">Manage Quizzes</p>
                <p class="card-description">Create, Update and Delete Quizzes.</p>
            </div></a>
            <a href="../article/manage_article.php"><div class="card">
                <img src="../../image/article.svg" alt="article" class="card-img" />
                <p class="card-title">Manage Articles</p>
                <p class="card-description">Create, Update and Delete Articles.</p>
            </div></a>
        </div>
    </div>

    <div class="col-12 col-s-12 content-2 fade-in">
        <?php include '../../component/leaderboard.php'; ?>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/menu.js"></script>
    <script src="../../scripts/animation.js"></script>
</body>
</html>
