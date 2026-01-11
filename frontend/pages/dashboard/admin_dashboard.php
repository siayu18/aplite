<?php
require_once "../../../backend/auth/session_admin.php";
include("../../../backend/conn.php");

$name = $_SESSION['name'];

// Total Users
$userResult = mysqli_query($con, "SELECT COUNT(*) AS total FROM user");
$userCount = mysqli_fetch_assoc($userResult)['total'];

// Average Light Brightness
$brightnessResult = mysqli_query($con, "SELECT ROUND(AVG(brightnessLevel), 1) AS avgBrightness FROM brightnesslog;");
$brightnessCount = mysqli_fetch_assoc($brightnessResult)['avgBrightness'];

// Total Energy Saved
$energyResult = mysqli_query($con,
"SELECT ROUND(SUM(r.bulbWattage * r.numberOfBulbs * (1 - b.brightnessLevel / 100)), 0) AS totalEnergySaved
 FROM brightnesslog b
 JOIN session s ON b.sessionID = s.sessionID
 JOIN room r ON s.roomID = r.roomID");
$energyCount = mysqli_fetch_assoc($energyResult)['totalEnergySaved'];

// Graph Data
$data = [];
$labels = [];

$sql = "SELECT DATE(timeStamp) AS date, ROUND(AVG(brightnessLevel), 0) AS avgBrightness
        FROM brightnesslog
        WHERE timeStamp >= CURDATE() - INTERVAL 4 DAY
        GROUP BY DATE(timeStamp)
        ORDER BY date ASC";

$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['date'];
    $data[] = $row['avgBrightness'];
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
    <div class="col-12 col-s-12 header fade-in">
        <div class="top-bar">
            <img src="../../image/logo.svg" alt="APLite Logo" class="logo" />
            <?php include("../../component/admin_menu.php") ?> 
        </div>
        <div class="middle-content">
            <span class="white-title">Welcome Back Admin, <?= $name ?>!</span>
            <span class="yellow-description">This is the admin panel and you can below contain the analytical dashboard for you.</span>
            <div class="card-container">
                <div class="transparent-card">
                    <div class="text-group">
                        <span class="medium-white-title"><?= $userCount ? $userCount : 0 ?></span>
                        <span class="white-description">Total Users</span>
                    </div>
                </div>
                 <div class="transparent-card">
                    <div class="text-group">
                        <span class="medium-white-title"><?= $brightnessCount ? $brightnessCount : 0 ?>%</span>
                        <span class="white-description">Average Light Brightness</span>
                    </div>
                </div>
                 <div class="transparent-card">
                    <div class="text-group">
                        <span class="medium-white-title"><?= $energyCount ? $energyCount : 0 ?> Watts</span>
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

    <script>
        // Convert PHP arrays to Json then JavaScript arrays
        // This is chart data for brightness to pass to chart.js
        const xValues = <?= json_encode($labels) ?>;
        const yValues = <?= json_encode($data) ?>
    </script>

    <script src="../../scripts/menu.js"></script>
    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/chart.js"></script>
</body>
</html>
