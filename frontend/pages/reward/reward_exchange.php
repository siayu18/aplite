<?php
    require_once "../../../backend/auth/session_student.php";
    include("../../../backend/conn.php");

    //get all reward details
    $sql = "SELECT * FROM Reward AS r";
    $result = mysqli_query($con, $sql);
    $rewards = [];
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_assoc($result)) {
        $rewards[] = $row;
    }

    
    //get user points from user logged in ID
    $currentID = $_SESSION['user_id'];
    $sql1 = "SELECT points FROM user WHERE userID = '$currentID'";
    $result1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $now = new DateTime();
    $date = $now->format('Y-m-d H:i:s');
    $pointsEnough = false;


    //redeem button
    if (isset($_GET['id'])) {
        $rewardID = $_GET['id'];
        $redemptionID = uniqid();
        $sql4 = "SELECT * FROM Reward WHERE rewardID = '$rewardID'";
        $result4 = mysqli_query($con, $sql4);
        $row4 = mysqli_fetch_assoc($result4);
        $pointsRequired = $row4['pointsRequired'];

        if ($pointsRequired <= $row1['points']) {
            $pointsEnough = true;
            $sql2 = "INSERT INTO Redemption (redemptionID, userID, rewardID, datetime, status)
                    VALUES ('$redemptionID', '$currentID', '$rewardID', '$date', '0')";
            $result2 = mysqli_query($con, $sql2);
            $newUserPoint = $row1['points'] - $pointsRequired;
            $sql3 = "UPDATE User SET points = $newUserPoint WHERE userID = $_SESSION[user_id]";
            $result3 = mysqli_query($con, $sql3);
        }

         echo("<script>window.success = true</script>"); // trigger overlay
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
    <title>Reward Exchange</title>
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
            <span class="dark-green-description"><?php echo $row1['points'] ?> pts</span>
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
                        <img class="card-img" src="data:image/jpeg;base64,<?= base64_encode($r['image']) ?>" alt="Reward" />
                        <div class="info-container">
                            <div class="points-container">
                                <img src="../../image/badge.svg" alt="Points Badge"/>
                                <span class="points-text"><?= htmlspecialchars($r['pointsRequired']) ?> pts</span>
                            </div>
                            <div class="medium-green-title"><?= htmlspecialchars($r['title']) ?></div>
                            <span class="green-description"><?= htmlspecialchars($r['description']) ?></span>
                            <a href="reward_exchange.php?id=<?= $r['rewardID'] ?>" class="green-button">Redeem Now</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="overlay"></div>
    <div class="modal">
        <img src="../../image/<?= $pointsEnough ? 'verify.svg' : 'cancel.svg' ?>" alt="<?= $pointsEnough ? 'Verify' : 'Failed' ?>" class="modal-img">
        <div class="text-group">
            <span class="medium-green-title"><?= $pointsEnough ? 'Successfully Exchanged!' : 'Not Enough Points!' ?></span>
            <span class="green-description"><?= $pointsEnough ? 'You have successfully excahnged the reward' : 'You don\'t have enough points to exchange the reward' ?></span>
        </div>
        <a href="reward_exchange.php" class="green-button">Back</a>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/overlay.js"></script>
</body>
</html>