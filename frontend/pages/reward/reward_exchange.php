<?php
require_once "../../../backend/auth/session_admin.php";
include("../../../backend/conn.php");

$sql = "SELECT r.rewardID, r.title, r.description, r.pointsRequired
        FROM Reward AS r";

$result = mysqli_query($con, $sql);

$rewards = [];
$count = mysqli_num_rows($result);

while ($row = mysqli_fetch_assoc($result)) {
    $rewards[] = $row;
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reward Exchange</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/component.css">
    <link rel="stylesheet" href="../../styles/rewards.css">
</head>
<body>
    <?php include '../../component/stu_header.php'; ?>
    <div class="col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Rewards Exchange</span>
            <span class="green-description">Redeem your hard-earned points for exciting rewards!</span>
        </div>
        <div class="point-card">
            <div class="icon-title">
                <img src="../../image/badge.svg" alt="Points Badge"/>
                <span>Your Points</span>
            </div>
            <span class="dark-green-description">100 pts</span>
        </div>
        <span class="green-description" style="text-align: center;"><?= htmlspecialchars($count) ?> Rewards Available</span>
        
        <div class="card-container" style="margin-top: 0;">
            <?php if (empty($rewards)): ?>
                <div class="mid-text-group">
                    <span class="medium-green-title">No rewards available!</span>
                    <span class="green-description">Sorry, but currently there is no rewards available!</span>
                </div>
            <?php else: ?>
                <?php foreach ($rewards as $r): ?>
                    <div class="card">
                        <img class="card-img" src="../../image/apu-background.jpg" alt="Reward" />
                        <div class="info-container">
                            <div class="points-container">
                                <img src="../../image/badge.svg" alt="Points Badge"/>
                                <span class="points-text"><?= htmlspecialchars($r['pointsRequired']) ?> pts</span>
                            </div>
                            <div class="medium-green-title"><?= htmlspecialchars($r['title']) ?></div>
                            <span class="green-description"><?= htmlspecialchars($r['description']) ?></span>
                            <a href="abc.php?id=<?= $r['rewardID'] ?>" class="green-button">Redeem</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <?php include '../../component/footer.php'; ?>
</body>
</html>