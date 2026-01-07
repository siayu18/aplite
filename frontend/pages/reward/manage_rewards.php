<?php
    require_once "../../../backend/auth/session_admin.php";
    include("../../../backend/conn.php");

    $sql = "SELECT * FROM Reward AS r ORDER BY pointsRequired ASC";

    $result = mysqli_query($con, $sql);

    $rewards = [];
    $count = mysqli_num_rows($result);

    while ($row = mysqli_fetch_assoc($result)) {
        $rewards[] = $row;
    }

    if (isset($_GET['delete'])) {
        $rewardID = mysqli_real_escape_string($con, $_GET['delete']);
        $sql1 = "DELETE FROM Reward WHERE rewardID = '$rewardID'";
        $result1 = mysqli_query($con, $sql1);
        echo("<script>window.success = true;</script>");
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
    <link rel="stylesheet" href="../../styles/rewards.css">
    <title>Manage Rewards</title>
</head>
<body>
    <?php include '../../component/load_header.php'; ?>
    <div class="col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Manage Rewards</span>
            <span class="green-description">View and manage the rewards</span>
            <br>
            <a href="add_reward.php" class="big-green-button">+ Add New Reward</a>
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
                        <img class="card-img" src="data:image/jpeg;base64,<?= base64_encode($r['image']) ?>" alt="Reward" />
                        <div class="info-container">
                            <div class="points-container">
                                <img src="../../image/badge.svg" alt="Points Badge"/>
                                <span class="points-text"><?= htmlspecialchars($r['pointsRequired']) ?> pts</span>
                            </div>
                            <div class="medium-green-title"><?= htmlspecialchars($r['title']) ?></div>
                            <span class="green-description"><?= htmlspecialchars($r['description']) ?></span>
                            <div class="near-button-column">
                                <a href="edit_reward.php?id=<?php echo $r['rewardID'] ?>" class="green-button">Edit</a>
                                <a href="manage_rewards.php?delete=<?php echo $r['rewardID'] ?>" class="red-button">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="overlay"></div>
    <div class="modal">
        <img src="../../image/verify.svg" alt="Verify" class="modal-img">
        <div class="text-group">
            <span class="medium-green-title">Successfully Deleted!</span>
            <span class="green-description">You have successfully deleted the reward</span>
        </div>
        <a href="manage_rewards.php" class="green-button">Back</a>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/overlay.js"></script>
</body>
</body>
</html>
