<?php
include('../../../backend/conn.php');
include('../../../backend/fetch_data.php');

// Handle Delete
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($con, $_GET['delete']);

    $sql = "DELETE FROM announcement WHERE announcementID = '$id'";

    if (!mysqli_query($con, $sql)) {
        die('Error deleting: ' . mysqli_error($con));
    } else {
        echo "<script>window.success = true;</script>";
    }
}

// Fetch data
$announcements = getData('announcement');
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
    <link rel="stylesheet" href="../../styles/announcement.css">
    <title>Manage Announcements</title>
</head>
<body>
    <?php include '../../component/admin_header.php'; ?>
    <div class=" col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Manage Announcements</span>
            <span class="green-description">Create, Edit and Delete Announcements!</span>
        </div>

        <div class="wrap-middle">
            <a href="create_announcement.php" class="big-green-button">+ Create Announcement</a>
        </div>


        <div class="container">
            <?php if (empty($announcements)): ?>
                <div class="mid-text-group">
                    <span class="medium-green-title">No announcements available!</span>
                    <span class="green-description">Sorry, but currently there is no announcement available!</span>
                </div>
            <?php else: ?>
                <?php foreach ($announcements as $announcement): ?>
                    <div class="card">
                        <div class="between-stretch">
                            <div class="icon-text">
                                <img src="../../image/calendar.svg" alt="Calendar" />
                                <span><?= htmlspecialchars($announcement['date']) ?></span>
                            </div>
                            <div class="near-button-row">
                                <a href="edit_announcement.php?edit=<?= $announcement['announcementID'] ?>"
                                class="border-button">
                                    <img src="../../image/edit.svg" alt="Edit" />
                                </a>
                                <a href="manage_announcement.php?delete=<?= $announcement['announcementID'] ?>"
                                class="red-border-button">
                                    <img src="../../image/delete.svg" alt="Delete" />
                                </a>
                            </div>
                        </div>
                        <div class="medium-green-title"><?= htmlspecialchars($announcement['title']) ?></div>
                        <div class="green-description"><?= htmlspecialchars($announcement['content']) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="overlay"></div>
    <div class="modal">
        <img src="../../image/verify.svg" alt="Verify" class="modal-img">
        <div class="text-group">
            <span class="medium-green-title">Successfully Deleted!</span>
            <span class="green-description">You have successfully deleted the announcement</span>
        </div>
        <a href="manage_announcement.php" class="green-button">Back</a>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/overlay.js"></script>
</body>
</html>
