<?php
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
    <?php include '../../component/admin_header.php'; ?>
        <div class="col-12 col-s-12 content fade-in" style="justify-content: center">
           <div class="form-container">
                <span class="green-title">Edit Reward</span>
                <br>
                
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $r['rewardID'] ?>">

                    <div class="form-group">
                        <label for="points">Reward Title</label>
                        <input type="text" name="title" name="points" value="<?= $r['title'] ?>" required>
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="description">Points Required</label>
                        <input type="number" name="points" min="0" value="<?= $r['pointsRequired'] ?>" required>
                    </div>
                    <br>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" required><?= $r['description'] ?></textarea>
                    </div>

                    <div class="button-group">
                        <a href="manage_rewards.php" class="red-button">Cancel</a>
                        <button type="submit" class="green-button" name="update">Update Reward</button>
                    </div>
                </form>
            </div>
        </div>
    <?php include '../../component/footer.php'; ?>
</body>
</html>