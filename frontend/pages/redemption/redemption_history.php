<?php
    require_once "../../../backend/auth/session_student.php";
    include("../../../backend/conn.php");

    $sql = "SELECT redem.*, u.name, r.*
            FROM Redemption AS redem, User AS u, Reward AS r
            WHERE redem.userID = u.userID AND redem.rewardID = r.rewardID ORDER BY redem.status DESC";

    $result = mysqli_query($con, $sql);

    $history = [];
    $count = mysqli_num_rows($result);

    while ($row = mysqli_fetch_assoc($result)) {
        $history[] = $row;
    }

    mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redemption History</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/component.css">
    <link rel="stylesheet" href="../../styles/rewards.css">
</head>
<body>
    <?php include '../../component/load_header.php'; ?> 
        <div class="col-12 col-s-12 content fade-in">
            <div class="text-group">
                <span class="green-title">Redemption History</span>
                <span class="green-description">Oversee your past reward claims</span>
            </div>

            <div class="card-container">
            <?php if (empty($history)): ?>
                <div class="mid-text-group">
                    <span class="medium-green-title">No Redemption History!</span>
                    <span class="green-description">You haven't redeemed any rewards yet.</span>
                </div>
            <?php else: ?>
                <?php foreach ($history as $item): ?>
                    <div class="card">
                        <img class="card-img" src="data:image/jpeg;base64,<?= base64_encode($item['image']) ?>" alt="Reward" />
                        <div class="info-container">
                            <div class="points-container">
                                <img src="../../image/badge.svg" alt="Points Badge"/>
                                <span class="points-text"><?= htmlspecialchars($item['pointsRequired']) ?> pts</span>
                            </div>
                            <div class="medium-green-title"><?= htmlspecialchars($item['title']) ?></div>
                            <span class="green-description">
                                Redeemed on: <b><?= date('d M Y, H:i', strtotime($item['datetime'])) ?></b>
                                <br>
                                Status: <b style="color: <?= ($item['status'] == 1) ? '#28a745' : '#ffc107' ?>;">
                                    <?= ($item['status'] == 1) ? 'Claimed' : 'Pending' ?>
                                </b>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            </div>
        </div>
    <?php include '../../component/footer.php'; ?>
</body>
</html>