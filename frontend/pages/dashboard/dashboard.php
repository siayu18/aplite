<?php
include("../../../backend/conn.php");

// For leaderboard
$sql = "SELECT * FROM user ORDER BY points DESC LIMIT 10";
$result = mysqli_query($con, $sql);
$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

mysqli_close($con);
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
    <title>APLite</title>
</head>
<body>
    <div class="col-12 col-s-12 header">
        <div class="top-bar">
            <img src="../../image/logo.png" alt="APLite Logo" class="logo" />
            <?php include("../../component/stu_menu.php") ?> 
        </div>
        <div class="middle-content">
            <span class="white-title">Save Light Energy, Earn Points!</span>
            <span class="yellow-description">Join APU's sustainable energy initiative. Turn off unused lights, take quiz challenges to gain points, be in leaderboard and create a greener campus.</span>
            <button class="yellow-button">Get Started ></button>
        </div>
    </div>

    <div class="col-12 col-s-12 content-1 fade-in">
        <div class="text-group">
            <span class="green-title">How APLITE Challenge Works</span>
            <span class="green-description">Three simple ways to contribute to a sustainable campus, earn points and climb the leaderboard</span>
        </div>
        <div class="card-container">
            <a href=""><div class="card">
                <img src="../../image/light.png" alt="Light" class="card-img" />
                <p class="card-title">Adjust Brightness</p>
                <p class="card-description">Check into a classroom and adjust the brightness to suit your preference while saving energy.</p>
            </div>
            <a href=""><div class="card">
                <img src="../../image/quiz.png" alt="Quiz" class="card-img" />
                <p class="card-title">Join Quizzes</p>
                <p class="card-description">Complete quizzes related to sustainability and earn points while saving energy.</p>
            </div></a>
            <a href=""><div class="card">
                <img src="../../image/article.png" alt="article" class="card-img" />
                <p class="card-title">Read Articles</p>
                <p class="card-description">Read articles related to sustainability to earn extra points to gain awareness.</p>
            </div></a>
        </div>
    </div>

    <div class="col-12 col-s-12 content-2 fade-in">
        <?php include '../../component/leaderboard.php'; ?>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/dashboard.js"></script>
    <script src="../../scripts/animation.js"></script>
</body>
</html>
