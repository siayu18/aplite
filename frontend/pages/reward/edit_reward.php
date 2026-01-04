<?php
    require_once "../../../backend/auth/session_admin.php";
    include("../../../backend/conn.php");

    if (!isset($_GET['id'])) {
        echo "<script>alert('No Reward ID provided'); window.location.href='manage_rewards.php';</script>";
        exit;
    }

    $id = mysqli_real_escape_string($con, $_GET['id']);

    $sql = "SELECT * FROM Reward 
            WHERE rewardID = '$id'";

    $result = mysqli_query($con, $sql);
    $r = mysqli_fetch_assoc($result);

    if (!$r) {
        die("Reward not found.");
    }

    if (isset($_POST['update'])) {
        $rewardTitle = $_POST['title'];
        $rewardDescrip = $_POST['description'];
        $rewardPts = $_POST['points'];
        $sql1 = "UPDATE Reward SET title = '$rewardTitle', description = '$rewardDescrip', pointsRequired = '$rewardPts' WHERE rewardID = '$id'";
        $result1 = mysqli_query($con, $sql1);
        echo("<script>alert('Edit Successful!');window.location.href = 'manage_rewards.php'</script>");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Rewards</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/component.css">
    <link rel="stylesheet" href="../../styles/rewards.css">
</head>
<body>
    <?php include '../../component/load_header.php'; ?> 
        <div class="col-12 col-s-12 content fade-in" style="justify-content: center">
            <div class="col-12 col-s-12 content fade-in" style="justify-content: center">
            <div class="main-container">
                <div class="back-wrapper">
                    <a href="manage_rewards.php">
                        <div class="interactive-icon-text">
                            <img src="../../image/back.svg" alt="Back" class="icon-img" />
                            <span class="icon-text">Back to Manage Rewards</span>
                        </div>
                    </a>
                </div>
                <div class="inner-container">
                    <span class="green-title" style="margin-bottom: 1rem;">Edit Reward</span>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $r['rewardID'] ?>">

                        <div class="label-field">
                            <label for="points">Reward Title</label>
                            <input type="text" name="title" name="points" value="<?= $r['title'] ?>" required>
                        </div>
                        <br>

                        <div class="label-field">
                            <label for="description">Points Required</label>
                            <input type="number" name="points" min="0" value="<?= $r['pointsRequired'] ?>" required>
                        </div>
                        <br>

                        <div class="label-field">
                            <label>Description</label>
                            <textarea name="description" class="white-area" required><?= $r['description'] ?></textarea>
                        </div>
                        <br />
                        <div class="right-button-group">
                            <a href="manage_rewards.php" class="red-button">Cancel</a>
                            <button type="submit" class="green-button" name="update">Update Reward</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php include '../../component/footer.php'; ?>
</body>
</html>
