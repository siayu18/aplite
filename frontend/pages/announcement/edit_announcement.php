<?php
include('../../../backend/conn.php');
include('../../../backend/fetch_data.php');

if (!isset($_GET['edit'])) {
    die('Announcement ID not specified.');
}

$announcementID = mysqli_real_escape_string($con, $_GET['edit']);

// Fetch data
$announcement = getDataByID('announcement', 'announcementID', $announcementID);
if (!$announcement) {
    die('Announcement not found.');
}

// Handle update
if (isset($_POST['submitBtn'])) {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);

    $sql = "UPDATE announcement SET title='$title', content='$content' WHERE announcementID='$announcementID'";
    if (!mysqli_query($con, $sql)) {
        die('Error: ' . mysqli_error($con));
    } else {
        echo "<script>window.success = true;</script>";
    }
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
    <link rel="stylesheet" href="../../styles/quiz.css">
    <title>Edit Announcement</title>
</head>

<body>
    <?php include '../../component/admin_header.php'; ?>
    <div class=" col-12 col-s-12 content-mid fade-in">
        <div class="main-container">
            <div class="back-wrapper">
                <a href="manage_announcement.php">
                    <div class="interactive-icon-text">
                        <img src="../../image/back.svg" alt="Back" class="icon-img" />
                        <span class="icon-text">Back to Manage Announcements</span>
                    </div>
                </a>
            </div>
            <form method="POST" action="edit_announcement.php?edit=<?= $announcementID ?>" class="inner-container">
                <div class="medium-green-title">Edit Announcement</div>

                <div class="label-field">
                    <label class="green-description">Title</label>
                    <input type="text" placeholder="Enter title..." name="title" value="<?= htmlspecialchars($announcement['title']) ?>">
                </div>

                <div class="label-field">
                    <label class="green-description">Content</label>
                    <textarea class="white-area" placeholder="Enter content..." name="content"><?= htmlspecialchars($announcement['content']) ?></textarea>
                </div>

                <div class="right-button-group">
                    <a href="manage_announcement.php" class="white-button">Cancel</a>
                    <button type="submit" class="green-button" name="submitBtn">Update Announcement</button>
                </div>
            </form>
        </div>
    </div>

    <div class="overlay"></div>
    <div class="modal">
        <img src="../../image/verify.svg" alt="Verify" class="modal-img">
        <div class="text-group">
            <span class="medium-green-title">Successfully Edited!</span>
            <span class="green-description">You have successfully edited the announcement</span>
        </div>
        <a href="manage_announcement.php" class="green-button">Back</a>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/overlay.js"></script>
</body>
</html>