<?php
<<<<<<< HEAD
    include("../../../backend/conn.php");
=======
require_once "../../../backend/auth/session_admin.php";
include("../../../backend/conn.php");
>>>>>>> 1d050e52a42519fd44856db86c74e7e9a015329d

    //hardcoded userID (remove when login fixed)
    session_start();
    $_SESSION['user_id'] = 1;
    $_SESSION['name'] = "Student";
    $_SESSION['role'] = "Student";


    //get all reward details
    $sql = "SELECT r.rewardID, r.title, r.description, r.pointsRequired
            FROM Reward AS r";
    $result = mysqli_query($con, $sql);
    $rewards = [];
    $count = mysqli_num_rows($result);
    while ($row = mysqli_fetch_assoc($result)) {
        $rewards[] = $row;
    }

    
    //get user points from user logged in ID
    $sql1 = "SELECT points FROM user WHERE userID = $_SESSION[user_id]";
    $result1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $now = new DateTime();
    $date = $now->format('Y-m-d H:i:s');


    //redeem button
    if (isset($_POST['redeem'])) {
        $rewardID = $_POST['rewardID'];
        $sql4 = "SELECT *
                    FROM Reward WHERE rewardID = $rewardID";
        $result4 = mysqli_query($con, $sql4);
        $row4 = mysqli_fetch_assoc($result4);
        $pointsRequired = $row4['pointsRequired'];
        if ($pointsRequired <= $row1['points']) {
            $sql2 = "INSERT INTO Redemption (userID, rewardID, datetime, status)
                    VALUES ('$_SESSION[user_id]', '$rewardID', '$date', '0')";
            $result2 = mysqli_query($con, $sql2);
            $newUserPoint = $row1['points'] - $pointsRequired;
            $sql3 = "UPDATE User SET points = $newUserPoint WHERE userID = $_SESSION[user_id]";
            $result3 = mysqli_query($con, $sql3);
            echo("<script>alert('Redemption Approved')</script>");
            echo("<meta http-equiv='refresh' content = 0>");
        }
        else {
            echo("<script>alert('Not Enough Points!')</script>");
        }
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
<<<<<<< HEAD
    <?php include '../../component/stu_header.php'; ?> 
    <div class="content fade-in" style="padding: 2rem;">
        <div class=" col-12 col-s-12 content fade-in">
            <div class="text-group">
                <span class="green-title">Rewards Exchange</span>
                <span class="green-description">Redeem your hard-earned points for exciting rewards!</span>
                <p style="font-size: 20px;"></p>
                <!-- display user points extracted from database -->
                <div class="profile-card">
                    <div class="point-card">
                        <div>
                            <div class="green-title">Your Points</div>
                            <p class="para"></p>
                            <img src="../../image/badge.svg" alt="Points Badge"/>
                            <span><?php echo $row1['points'] ?></span>
                        </div>
                    </div>
                <p class="para" style="font-size: 30px"></p>
                </div>


            <span class="green-description" style="font-size: 18px"><?= htmlspecialchars($count) ?> Rewards Available</span>
        </div>
        <!-- display all available rewards -->
        <div class="card-container">
            <!-- if reward database is empty -->
=======
    <?php include '../../component/load_header.php'; ?>
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
>>>>>>> 1d050e52a42519fd44856db86c74e7e9a015329d
            <?php if (empty($rewards)): ?>
                <div class="mid-text-group">
                    <span class="medium-green-title">No rewards available!</span>
                    <span class="green-description">Sorry, but currently there is no rewards available!</span>
                </div>
                <!-- else not empty, display all reward details as card, including redeem form -->
            <?php else: ?>
                <!-- foreach reward row generate one card -->
                <?php foreach ($rewards as $r): ?>
<<<<<<< HEAD
                    <form method="post">
                        <div class="card">
                            <div class="quiz-points">
                                <img class="avatar-img" src="../../image/coupon.png" alt="Coupon" />
                                <div class="points-container">
                                    <img src="../../image/badge.svg" alt="Points Badge"/>
                                    <!-- display points required -->
                                    <span class="points-text"><?php echo $r['pointsRequired']?> pts</span>
                                </div>
                            </div>
                            <!-- display title -->
                            <div class="medium-green-title"><?= htmlspecialchars($r['title']) ?></div>
                                <div class="icon-text">
                                    <img src="../../image/green_book.svg" alt="Book" />
                                    <!-- display description -->
                                    <span><?= htmlspecialchars($r['description']) ?></span>
                                </div>
                                <input type="hidden" value="<?php echo $r['rewardID']?>" name="rewardID">
                                <button type="submit" name="redeem" class="green-button">Redeem</button>
                            </div>
                    </form>
=======
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
>>>>>>> 1d050e52a42519fd44856db86c74e7e9a015329d
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <?php include '../../component/footer.php'; ?>
</body>
</html>