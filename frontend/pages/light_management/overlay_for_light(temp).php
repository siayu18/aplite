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
    <div class="modal">
        <img src="../../image/lightbulb.svg" alt="lightbulb" class="card-img">
        <div class="text-group">
            <span class="medium-green-title">Classroom A101</span>
            <span class="green-description">
                <img src="../../image/clock_icon.svg" alt="clock" class="clock-img">
                Checked in at 9:45:24 PM
            </span>
        </div>

        <div class="class-details">
            <span class="dark-green-description" style="text-align: center;">Classroom A101</span>
            <div class="green-description-between">
                <span>Check-in Time:</span>
                <span>9:45:24 AM</span>
            </div>
            <div class="green-description-between">
                <span>Check-out Time:</span>
                <span>9:45:39 AM</span>
            </div>
            <div class="thin-line"></div>
            <div class="dark-green-description-between">
                <span>Duration:</span>
                <span>0m</span>
            </div>
        </div>

        <div class="light-level-box">
            <img src="../../image/light_icon_nobg.svg" alt="lightbulb" class="card2-img">
            <span class="green-description">Average Brightness Level: 70%</span>
            <div class="progress-container">
                <div class="progress-fill" style="width: 70%;"></div>
            </div>
            <span class="green-description">Energy Saved: 30%</span>
        </div>

        <div class="points-earn-box">
            <img src="../../image/reward_badge.svg" alt="points" class="card2-img">
            <span class="dark-green-description">Points Earned:</span>
            <span class="dark-green-description">+15 points</span>
        </div>

        <div class="class-details">
            <span class="green-description-bold" style="text-align: justify">Good effort! Try lowering brightness next time for more points!</span>
        </div>

        <button class="green-button">Done</button>
    </div>
</body>
</html>