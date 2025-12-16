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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>APLite</title>
</head>
<body>
    <div class="col-12 col-s-12 header">
        <div class="top-bar">
            <img src="../../image/logo.png" alt="APLite Logo" class="logo" />
            <?php include("../../component/admin_menu.php") ?> 
        </div>
        <div class="middle-content">
            <span class="white-title">Welcome Back Admin, Sia Yu!</span>
            <span class="yellow-description">This is the admin panel and you can below contain the analytical dashboard for you.</span>
            <div class="card-container">
                <div class="transparent-card">
                    <div class="text-group">
                        <span class="medium-white-title">3000</span>
                        <span class="white-description">Total Users</span>
                    </div>
                </div>
                 <div class="transparent-card">
                    <div class="text-group">
                        <span class="medium-white-title">50%</span>
                        <span class="white-description">Average Light Brightness</span>
                    </div>
                </div>
                 <div class="transparent-card">
                    <div class="text-group">
                        <span class="medium-white-title">100 Watt</span>
                        <span class="white-description">Total Energy Saved</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-s-12 content-1 fade-in">
        <div class="text-group">
            <span class="green-title">Analytical Graph</span>
            <span class="green-description">View the average light brightness percentage in a bar chart view</span>
        </div>
        <div class="bar-chart">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <div class="col-12 col-s-12 content-2 fade-in">
        <?php include '../../component/leaderboard.php'; ?>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/dashboard.js"></script>
    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/chart.js"></script>
</body>
</html>
