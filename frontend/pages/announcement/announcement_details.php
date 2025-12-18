<?php
include ('../../../backend/conn.php');
include ('../../../backend/fetch_data.php');
$announcements = getData("announcement");
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
    <div class="col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Announcements</span>
            <span class="green-description">Stay updated with the latest news!</span>
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
                        <div class="icon-text">
                            <img src="../../image/calendar.svg" alt="Calendar" />
                            <span><?= htmlspecialchars($announcement['date']) ?></span>
                        </div>
                        <div class="medium-green-title"><?= htmlspecialchars($announcement['title']) ?></div>
                        <div class="green-description"><?= htmlspecialchars($announcement['content']) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>