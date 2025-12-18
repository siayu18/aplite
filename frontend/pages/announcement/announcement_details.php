<?php
include ('../../../backend/conn.php');
include ('../../../backend/fetch_data.php');

if (!isset($_GET['id'])) {
    die('Announcement ID not specified.');
}

// Fetch data
$announcementID = $_GET['id'];
$announcement = getDataByID("announcement", "announcementID", $announcementID);
if (!$announcement) {
    die('Announcement not found.');
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
    <link rel="stylesheet" href="../../styles/announcement.css">
    <title>Announcements</title>
</head>
<body>
    <?php include '../../component/stu_header.php'; ?>
    <div class="col-12 col-s-12 content-mid fade-in">
        <div class="main-container">
            <div class="back-wrapper">
                <a href="announcement.php">
                    <div class="interactive-icon-text">
                        <img src="../../image/back.svg" alt="Back" class="icon-img" />
                        <span class="icon-text">Back to Announcements</span>
                    </div>
                </a>
            </div>
            <div class="inner-container">
                <div class="icon-text">
                    <img src="../../image/calendar.svg" alt="Calendar" />
                    <span><?= htmlspecialchars($announcement['date']) ?></span>
                </div>
                <div class="announcement-title"><?= htmlspecialchars($announcement['title']) ?></div>
                <div class="thin-line"></div>
                <p class="green-description"><?= htmlspecialchars($announcement['content']) ?></p>
                <div class="advice-card" style="margin-top: 1.5rem;">
                    <span class="green-description-bold">Advice:</span>
                    <span class="green-description">Please read the announcement carefully to avoid any missed information. Thank you for your attention.</span>
                </div>

            </div>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>