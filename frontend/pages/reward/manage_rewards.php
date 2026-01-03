<?php
    include("../../../backend/conn.php");

    $sql = "SELECT r.rewardID, r.title, r.description, r.pointsRequired
            FROM Reward AS r ORDER BY pointsRequired ASC";

    $result = mysqli_query($con, $sql);

    $rewards = [];
    $count = mysqli_num_rows($result);

    while ($row = mysqli_fetch_assoc($result)) {
        $rewards[] = $row;
    }

    if (isset($_POST['delete'])) {
        $rewardID = $_POST['rewardID'];
        $sql1 = "DELETE FROM Reward WHERE rewardID = '$rewardID'";
        $result1 = mysqli_query($con, $sql1);
        echo("<script>alert('Delete Successful!')</script>");
        echo("<meta http-equiv='refresh' content = 0>");
    }

    mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rewards</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/component.css">
    <link rel="stylesheet" href="../../styles/rewards.css">
</head>
<body>
    <?php include '../../component/admin_header.php'; ?>
        <div class="col-12 col-s-12 content fade-in">
            <div class="text-group">
                <span class="green-title">Manage Rewards</span>
                <span class="green-description">View and manage the rewards</span>
                <br>
                <a href="add_reward.php" class="green-button">+ Add New Reward</a>
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
                                <img class="avatar-img" src="../../image/coupon.png" alt="Coupon" />
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
                                <form method="POST">
                                    <div>
                                        <a href="edit_reward.php?id=<?php echo $r['rewardID'] ?>" class="green-button">Edit</a>
                                        <input type="hidden" value="<?php echo $r['rewardID']?>" name="rewardID">
                                        <input type="submit" class="red-button" onclick="return confirm('Delete this reward?')" value="Delete" name="delete">
                                    </div>
                                </form>
                            </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php include '../../component/footer.php'; ?>
</body>
</html>