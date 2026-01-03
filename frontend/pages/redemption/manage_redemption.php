<?php
require_once "../../../backend/auth/session_admin.php";
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

// Pending count
$pendingSql = "SELECT COUNT(*) AS total FROM Redemption WHERE status = 0";
$pendingResult = mysqli_query($con, $pendingSql);
$pendingCount = mysqli_fetch_assoc($pendingResult)['total'];

// Approved count
$approvedSql = "SELECT COUNT(*) AS total FROM Redemption WHERE status = 1";
$approvedResult = mysqli_query($con, $approvedSql);
$approvedCount = mysqli_fetch_assoc($approvedResult)['total'];

// Total
$totalCount = $pendingCount + $approvedCount;

mysqli_close($con);
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
    <?php include '../../component/load_header.php'; ?>
    <div class="col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Manage Redemption</span>
            <span class="green-description">Oversee rewards and manage redemptions</span>
        </div>

        <div class="summary-row">
            <div class="summary-card">
                <div class="icon-text-clean">
                    <img src="../../image/gift.svg" alt="Gift">
                    <span class="green-description">Total Redemptions</span>
                </div>
                <span class="green-description"><?= $totalCount ?></span>
            </div>

            <div class="summary-card" style="background-color: var(--pending-orange-background); border: 0.1rem solid var(--pending-orange-border);">
                <div class="icon-text-clean">
                    <img src="../../image/timer.svg" alt="timer">
                    <span class="orange-description">Pending Redemptions</span>
                </div>
                <span class="orange-description"><?= $pendingCount ?></span>
            </div>

            <div class="summary-card" style="background-color: var(--approved-green-background); border: 0.1rem solid var(--approved-green-border);">
                <div class="icon-text-clean">
                    <img src="../../image/tick.svg" alt="tick">
                    <span class="dark-green-description">Approved Redemptions</span>
                </div>
                <span class="dark-green-description"><?= $approvedCount ?></span>
            </div>
        </div>

        <div class="redemption-container">
            <span class="medium-green-title">Pending Redemptions</span>
            <div class="container">
                <?php if (empty($redemption)): ?>
                    <div class="mid-text-group">
                        <span class="medium-green-title">No pending redemptions available!</span>
                        <span class="green-description">Sorry, but currently there is no pending redemption available!</span>
                    </div>
                <?php else: ?>
                    <?php foreach ($redemption as $redemptions): ?>
                        <form method="post" class="card">
                            <div class="icon-title">
                                <img src="../../image/dark-gift.svg" alt="Gift" />
                                <span><?= htmlspecialchars($redemptions['title']) ?></span>
                                <div class="card-icon-img-pen"><img src="../../image/timer.svg" alt="Pending"/></div>
                            </div>
                            <div class="card-info">
                                <div class="label-field">
                                    <span class="green-description-bold">Student</span>
                                    <span class="dark-green-description"><?= htmlspecialchars($redemptions['name']) ?></span>
                                </div>
                                <div class="label-field">
                                    <span class="green-description-bold">Points Used</span>
                                    <span class="dark-green-description"><?= htmlspecialchars($redemptions['pointsRequired']) ?></span>
                                </div>
                                <div class="label-field">
                                    <span class="green-description-bold">Redemption Date</span>
                                    <span class="dark-green-description"><?= htmlspecialchars($redemptions['datetime']) ?></span>
                                </div>
                            </div>
                            <input type="hidden" name="redemption-id" value="<?= htmlspecialchars($redemptions['redemptionID']) ?>">
                            <button type="submit" name="pending" class="green-button" style="width: fit-content;">
                                <div class="icon-text-clean">
                                    <img src="../../image/white-tick.svg" alt="Tick" />
                                    <span>Mark as Completed</span>
                                </div>
                            </button>
                        </form>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <br />

        <div class="redemption-container">
            <span class="medium-green-title">Completed Redemptions</span>
            <div class="container">
                <?php if (empty($redemption1)): ?>
                    <div class="mid-text-group">
                        <span class="medium-green-title">No approved redemptions available!</span>
                        <span class="green-description">Sorry, but currently there is no approved redemption available!</span>
                    </div>
                <?php else: ?>
                    <?php foreach ($redemption1 as $redemptions1): ?>
                        <form method="post" class="completed-card">
                            <div class="icon-title">
                                <img src="../../image/dark-gift.svg" alt="Gift" />
                                <span><?= htmlspecialchars($redemptions1['title']) ?></span>
                                <div class="card-icon-img-apro"><img src="../../image/tick.svg" alt="Approve"/></div>
                            </div>
                            <div class="card-info">
                                <div class="label-field">
                                    <span class="blue-green-description-bold">Student</span>
                                    <span class="dark-green-description"><?= htmlspecialchars($redemptions1['name']) ?></span>
                                </div>
                                <div class="label-field">
                                    <span class="blue-green-description-bold">Points Used</span>
                                    <span class="dark-green-description"><?= htmlspecialchars($redemptions1['pointsRequired']) ?></span>
                                </div>
                                <div class="label-field">
                                    <span class="blue-green-description-bold">Redemption Date</span>
                                    <span class="dark-green-description"><?= htmlspecialchars($redemptions1['datetime']) ?></span>
                                </div>
                            </div>
                            <input type="hidden" name="redemption-id" value="<?= htmlspecialchars($redemptions1['redemptionID']) ?>">
                            <button type="submit" name="cancel" class="red-border-button" style="width: fit-content">
                                <div class="icon-text">
                                    <img src="../../image/red-cancel.svg" alt="Cancel" />
                                    <span style="color: red;">Cancel</span>
                                </div>
                            </button>
                        </form>
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