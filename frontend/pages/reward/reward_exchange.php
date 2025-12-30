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
    <div class="content fade-in" style="padding: 2rem;">
       <div class=" col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Rewards Exchange</span>
            <span class="green-description">Redeem your hard-earned points for exciting rewards!</span>
            <p style="font-size: 20px;"></p>
            <div class="profile-card">
                <div class="point-card">
                    <div>
                        <div class="green-title">Your Points</div>
                        <p class="para"></p>
                        <img src="../../image/badge.svg" alt="Points Badge"/>
                        <span>100 pts</span>
                    </div>
                </div>
        <p class="para" style="font-size: 30px"></p>
        </div>
            <span class="green-description" style="font-size: 18px"><?= htmlspecialchars($count) ?> Rewards Available</span>
        </div>

        <div class="card-container">
            <?php if (empty($rewards)): ?>
                <div class="mid-text-group">
                    <span class="medium-green-title">No rewards available!</span>
                    <span class="green-description">Sorry, but currently there is no rewards available!</span>
                </div>
            <?php else: ?>
                <?php foreach ($rewards as $r): ?>
                    <div class="card">
                        <div class="quiz-points">
                            <img class="avatar-img" src="../../image/coupon.png" alt="Quiz" />
                            <div class="points-container">
                                <img src="../../image/badge.svg" alt="Points Badge"/>
                                <span class="points-text"><?= htmlspecialchars($r['pointsRequired']) ?> pts</span>
                            </div>
                        </div>
                        <div class="medium-green-title"><?= htmlspecialchars($r['title']) ?></div>
                        <div class="icon-text">
                            <img src="../../image/green_book.svg" alt="Book" />
                            <span><?= htmlspecialchars($r['description']) ?></span>
                        </div>
                        <a href="abc.php?id=<?= $r['rewardID'] ?>" class="green-button">Redeem</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <?php include '../../component/footer.php'; ?>
</body>
</html>