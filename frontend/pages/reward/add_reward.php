<?php
    include("../../../backend/conn.php");

    if (isset($_POST['save'])) {
        $rewardTitle = $_POST['title'];
        $rewardPts = $_POST['points'];
        $rewardDscrp = $_POST['description'];
        $sql = "INSERT INTO Reward (title, pointsRequired, description) VALUES ('$rewardTitle', '$rewardPts', '$rewardDscrp')";
        $result = mysqli_query($con, $sql);
        echo("<script>alert('Create Successful!');window.location.href = 'manage_rewards.php'</script>");
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
                <span class="green-title">Create New Reward</span>
                <p class="green-description">Fill in the details below to add a new reward to the reward system.</p>
                
                <form method="POST">
                    <div class="form-group">
                        <label for="title">Reward Title</label>
                        <input type="text" id="title" name="title" placeholder="e.g. Campus Cafe Voucher - RM10" required>
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="points">Points Required</label>
                        <input type="number" id="points" name="points" placeholder="100" min="0" required>
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="Describe the terms and conditions..." required></textarea>
                    </div>

                    <div class="button-group">
                        <a href="manage_rewards.php" class="red-button">Cancel</a>
                        <button type="submit" class="green-button" name="save">Save Reward</button>
                    </div>
                </form>
            </div>
        </div>
    <?php include '../../component/footer.php'; ?>
</body>
</html>