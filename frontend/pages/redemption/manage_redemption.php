<?php
    include("../../../backend/conn.php");

    $sql = "SELECT redem.redemptionID, redem.userID, redem.rewardID, redem.datetime, redem.status, u.name, r.title, r.pointsRequired
            FROM Redemption AS redem, User AS u, Reward AS r
            WHERE redem.userID = u.userID AND redem.rewardID = r.rewardID AND redem.status = 0";
    
    $result = mysqli_query($con, $sql);

    $count = mysqli_num_rows($result);

    $redemption = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $redemption[] = $row;
    }

    $sql1 = "SELECT redem.redemptionID, redem.userID, redem.rewardID, redem.datetime, redem.status, u.name, r.title, r.pointsRequired
            FROM Redemption AS redem, User AS u, Reward AS r
            WHERE redem.userID = u.userID AND redem.rewardID = r.rewardID AND redem.status = 1";
    
    $result1 = mysqli_query($con, $sql1);

    $count1 = mysqli_num_rows($result1);

    $redemption1 = [];
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $redemption1[] = $row1;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Redemption</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/component.css">
    <link rel="stylesheet" href="../../styles/redemptions.css">
</head>
<body>
    <?php include '../../component/admin_header.php'; ?>
    <div class="col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Manage Redemption</span>
            <span class="green-description">Oversee rewards and manage redemptions</span>
        </div>
        <span class="green-title">Pending Redemptions</span>
        <div class="pending-redemption">
            <div class="container">
                <?php if (empty($redemption)): ?>
                    <div class="mid-text-group">
                        <span class="medium-green-title">No redemptions available!</span>
                        <span class="green-description">Sorry, but currently there is no redemption available!</span>
                    </div>
                <?php else: ?>
                    <?php foreach ($redemption as $redemptions): ?>
                        <a href="manage_redemption.php?id=<?= htmlspecialchars($redemptions['redemptionID']) ?>" class="card">
                            <div class="icon-text">
                                <img src="../../image/voucher.png" alt="Voucher" />
                                <span><?= htmlspecialchars($redemptions['title']) ?></span>
                            </div>
                            <span class="medium-green-title">Student</span>
                            <p class="green-description"><?= htmlspecialchars($redemptions['name']) ?></p>
                            <form method="post">
                                <div class="redemption-details">
                                    <div>
                                        <span class="medium-green-title">Points Used</span>
                                        <p class="green-description"><?= htmlspecialchars($redemptions['pointsRequired']) ?></p>
                                    </div>
                                    <div>
                                        <span class="medium-green-title">Redemption Date</span>
                                        <p class="green-description"><?= htmlspecialchars($redemptions['datetime']) ?></p>
                                    </div>
                                    <input type="hidden" name="redemption-id" value="<?= htmlspecialchars($redemptions['redemptionID']) ?>">
                                    <button type="submit" name="pending" class="complete-btn">Mark as Completed</button>
                                </div>
                            </form>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <p style="font-size: 20px"></p>
        <span class="green-title">Completed Redemptions</span>
        <div class="completed-redemption">
            <div class="container">
                <?php if (empty($redemption1)): ?>
                    <div class="mid-text-group">
                        <span class="medium-green-title">No redemptions available!</span>
                        <span class="green-description">Sorry, but currently there is no redemption available!</span>
                    </div>
                <?php else: ?>
                    <?php foreach ($redemption1 as $redemptions1): ?>
                        <a href="manage_redemption.php?id=<?= htmlspecialchars($redemptions1['redemptionID']) ?>" class="card">
                            <div class="icon-text">
                                <img src="../../image/voucher.png" alt="Voucher"/>
                                <span><?= htmlspecialchars($redemptions1['title']) ?></span>
                            </div>
                            <span class="medium-green-title">Student</span>
                            <p class="green-description"><?= htmlspecialchars($redemptions1['name']) ?></p>
                            <form method="post">
                                <div class="redemption-details">
                                    <div>
                                        <span class="medium-green-title">Points Used</span>
                                        <p class="green-description"><?= htmlspecialchars($redemptions1['pointsRequired']) ?></p>
                                    </div>
                                    <div>
                                        <span class="medium-green-title">Redemption Date</span>
                                        <p class="green-description"><?= htmlspecialchars($redemptions1['datetime']) ?></p>
                                    </div>
                                    <input type="hidden" name="redemption-id" value="<?= htmlspecialchars($redemptions1['redemptionID']) ?>">
                                    <button type="submit" name="cancel" class="complete-btn" id="completed">Cancel</button>
                                </div>
                            </form>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
        if (isset($_POST['pending'])) {
            $redemptionid = $_POST['redemption-id'];
            $updatesql = "UPDATE Redemption SET status = 1 WHERE redemptionID = $redemptionid";
            $check = mysqli_query($con, $updatesql);
            echo("<script>alert('Redemption Approved')</script>");
            echo("<meta http-equiv='refresh' content = 0>");
        }
    ?>
    <?php
        if (isset($_POST['cancel'])) {
            $redemptionid = $_POST['redemption-id'];
            $updatesql = "UPDATE Redemption SET status = 0 WHERE redemptionID = $redemptionid";
            $check = mysqli_query($con, $updatesql);
            echo("<script>alert('Redemption cancelled')</script>");
            echo("<meta http-equiv='refresh' content = 0>");
        }
    ?>
    <?php include '../../component/footer.php'; ?>
</body>
</html>