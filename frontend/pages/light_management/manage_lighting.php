<?php
include ('../../../backend/conn.php');
include ('../../../backend/fetch_data.php');

$studentID = 3;
$session = getActiveSessionByStudent($studentID);
$checkInTimeFormatted = date("g:i:s A", strtotime($session['checkInTime']));
$checkoutSession = null;
$averageBrightness = null;
$pointsEarned = 0;
$sessionID = $session['sessionID'];
$brightnessID = uniqid();

if (!$session) {
    header("Location: control_lights.php");
    exit();
}

if (isset($_POST['averageBrightness'])) {
    $averageBrightness = (int) $_POST['averageBrightness'];
    $energySavedAvg = 100 - $averageBrightness;
}

if (isset($_POST['pointsEarned'])) {
    $pointsEarned = (int) $_POST['pointsEarned'];
}

if (isset($_POST['checkoutBtn'])) {

    $sql1 = "UPDATE session
            SET checkOutTime = NOW(),
                duration = TIMEDIFF(NOW(), checkInTime)
            WHERE studentID = '$studentID'
            AND checkOutTime IS NULL
            LIMIT 1";

    if (mysqli_query($con, $sql1)) {
        $checkoutSessionSql = "SELECT s.*, r.roomName
                               FROM session s
                               INNER JOIN room r ON s.roomID = r.roomID
                               WHERE s.studentID = '$studentID'
                               ORDER BY s.checkOutTime DESC
                               LIMIT 1";

        $checkoutResult = mysqli_query($con, $checkoutSessionSql);
        $checkoutSession = mysqli_fetch_assoc($checkoutResult);
    } else {
        die(mysqli_error($con));
    }

    $sql2 = "UPDATE user
        SET points = points + $pointsEarned
        WHERE userID = '$studentID'";

    if (!mysqli_query($con, $sql2)){
        die(mysqli_error($con));
    }
}

if ($checkoutSession) {
    $checkInFormatted  = date("g:i:s A", strtotime($checkoutSession['checkInTime']));
    $checkOutFormatted = date("g:i:s A", strtotime($checkoutSession['checkOutTime']));
    $durationFormatted = $checkoutSession['duration'];
    $logTimestamp = $checkoutSession['checkOutTime'];

    $sql3 = "INSERT INTO brightnesslog (brightnessID, sessionID, `timestamp`, brightnessLevel)
            VALUES ('$brightnessID', '$sessionID', '$logTimestamp', '$averageBrightness')";

    if (mysqli_query($con, $sql3)) {
        echo "<script>window.success = true;</script>";
    } else {
        die(mysqli_error($con));
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
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Outfit:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sixtyfour&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/component.css">
    <link rel="stylesheet" href="../../styles/control_light.css">
    <title>Set Lighting</title>
</head>
<body>
    <?php include '../../component/stu_header.php'; ?>
    <div class=" col-12 col-s-12 content-mid fade-in">
        <div class="control-panel-container">
            <img src="../../image/lightbulb.svg" alt="lightbulb" class="card-img">
            <div class="text-group">
                <span class="medium-green-title">
                    <?= htmlspecialchars($session['roomName']) ?>
                </span>

                <span class="green-description">
                    <img src="../../image/clock_icon.svg" alt="clock" class="clock-img">
                    Checked in at <?= $checkInTimeFormatted ?>
                </span>
            </div>

            <form method="POST" action="manage_lighting.php" class="content-group">
                <div class="slider-container">
                    <label class="green-description">Current Brightness Level</label>
                    
                    <span class="dark-green-description" id="currentBrightness">70%</span>
                    
                    <input type="range" 
                        min="0" max="100" 
                        value="70" 
                        class="brightness-slider" 
                        id="lightRange"
                        oninput="updateUI(this.value)">
                </div>

                <div class="energy-details">
                    <div class="class-details">
                        <img src="../../image/small_bulb.svg" alt="lightbulb-small" class="small-img">
                        <span class="green-description">Brightness</span>
                        <span class="dark-green-description" id="brightnessValue">70%<span>
                    </div>

                    <div class="class-details">
                        <img src="../../image/lightning.svg" alt="lightning-small" class="small-img">
                        <span class="green-description">Energy Saved</span>
                        <span class="dark-green-description" id="energySaved">30%<span>
                    </div>

                    <div class="class-details">
                        <img src="../../image/points.svg" alt="points" class="small-img">
                        <span class="green-description">Points Potential</span>
                        <span class="dark-green-description" id="pointsPotential">Low<span>
                    </div>
                </div>

                <div class="class-details">
                    <span class="green-description-bold">Tip:</span>
                    <span class="green-description" style="text-align: justify;">
                        Lower brightness levels save more energy and earn you more points! 
                        Adjust to a comfortable level that's not too bright.
                    </span>
                </div>
                <button class="orange-button" type="submit" name="checkoutBtn" onclick="injectAverageBrightness()">
                    <img src="../../image/check_out_icon.svg" alt="checkout" class="button-img">
                    <span>Check out Classroom<span>
                </button>
            </form>
        </div>
    </div>

    <div class="overlay"></div>
    <div class="modal">
        <img src="../../image/lightbulb.svg" alt="lightbulb" class="card-img">
        <div class="text-group">
            <span class="medium-green-title">
                <?= htmlspecialchars($session['roomName'] ?? '') ?>
            </span>
            <span class="green-description">
                <img src="../../image/clock_icon.svg" alt="clock" class="clock-img">
                Checked in at <?= $checkInFormatted ?? '' ?>
            </span>
        </div>
        <div class="modal-body">
            <div class="class-details">
                <span class="dark-green-description" style="text-align: center;">
                    <?= htmlspecialchars($session['roomName'] ?? '') ?>
                </span>
                <div class="green-description-between">
                    <span>Check-in Time:</span>
                    <span><?= $checkInFormatted ?? '' ?></span>
                </div>
                <div class="green-description-between">
                    <span>Check-out Time:</span>
                    <span><?= $checkOutFormatted ?? '' ?></span>
                </div>
                <div class="thin-line"></div>
                <div class="dark-green-description-between">
                    <span>Duration:</span>
                    <span><?= $durationFormatted ?? '' ?></span>
                </div>
            </div>

            <div class="light-level-box">
                <img src="../../image/light_icon_nobg.svg" alt="lightbulb" class="card2-img">
                <span class="green-description">Average Brightness Level: <?= $averageBrightness ?>%</span>
                <div class="progress-container">
                    <div class="progress-fill"
                        style="width: <?= $averageBrightness ?>%;">
                    </div>
                </div>
                <span class="green-description">
                    Energy Saved: <?= $energySavedAvg ?>%
                </span>
            </div>

            <div class="points-earn-box">
                <img src="../../image/reward_badge.svg" alt="points" class="card2-img">
                <span class="dark-green-description">Points Earned:</span>
                <span class="dark-green-description">
                    +<?= $_POST['pointsEarned'] ?? 0 ?> points
                </span>
            </div>

            <div class="class-details">
                <span class="green-description-bold" style="text-align: justify">Thanks for using APlite to save energy!</span>
            </div>
        </div>

        <a href="control_lights.php" class="green-button">Done</a>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/overlay.js"></script>
    <script src="../../scripts/manage_lighting.js"></script>
</body>
</html>