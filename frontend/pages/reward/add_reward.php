<?php
    require_once "../../../backend/auth/session_admin.php";
    include("../../../backend/conn.php");

    if (isset($_POST['save'])) {
        $rewardID = uniqid();
        $rewardTitle = $_POST['title'];
        $rewardPts = $_POST['points'];
        $rewardDscrp = $_POST['description'];

        $imageData = null;
        if (!empty($_FILES['image']['tmp_name'])) {
            $imageData = mysqli_real_escape_string($con, file_get_contents($_FILES['image']['tmp_name']));
        }

        $sql = "INSERT INTO Reward (rewardID, title, pointsRequired, description, image) VALUES ('$rewardID', '$rewardTitle', '$rewardPts', '$rewardDscrp', '$imageData')";
        $result = mysqli_query($con, $sql);
        echo("<script>window.success=true</script>");
    }
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
    <title>Add Rewards</title>
</head>
<body>
    <?php include '../../component/load_header.php'; ?> 
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
                <div class="left-text-group" style="margin-bottom: 1rem">
                    <span class="green-title">Create New Reward</span>
                    <span class="green-description">Fill in the details below to add a new reward to the reward system.</span>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="label-field">
                        <label for="title">Reward Title</label>
                        <input type="text" id="title" name="title" placeholder="e.g. Campus Cafe Voucher - RM10" required>
                    </div>
                    <br>

                    <div class="label-field">
                        <label for="points">Image</label>
                        <input type="file" id="image" name="image" required>
                    </div>
                    <br>

                    <div class="label-field">
                        <label for="points">Points Required</label>
                        <input type="number" id="points" name="points" placeholder="100" min="0" required>
                    </div>
                    <br>

                    <div class="label-field">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="white-area" placeholder="Describe the terms and conditions..." required></textarea>
                    </div>
                    <br>

                    <div class="right-button-group">
                        <a href="manage_rewards.php" class="red-button">Cancel</a>
                        <button type="submit" class="green-button" name="save">Save Reward</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="overlay"></div>
    <div class="modal">
        <img src="../../image/verify.svg" alt="Verify" class="modal-img">
        <div class="text-group">
            <span class="medium-green-title">Successfully Added!</span>
            <span class="green-description">You have successfully added the reward</span>
        </div>
        <a href="manage_rewards.php" class="green-button">Back</a>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/overlay.js"></script>
</body>
</html>