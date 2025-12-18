<?php
include ('../../../backend/conn.php');
include ('../../../backend/fetch_data.php');
$articles = getDataWithJoin("article", "user", "staffID", "userID");
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
    <link rel="stylesheet" href="../../styles/article.css">
    <title>Read Articles</title>
</head>
<body>
    <?php include '../../component/stu_header.php'; ?>
    <div class=" col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Available Articles</span>
            <span class="green-description">Read articles to learn about sustainability and earn points!</span>
        </div>

        <div class="card-container">
            <?php if (empty($articles)): ?>
                <div class="mid-text-group">
                    <span class="medium-green-title">No articles available!</span>
                    <span class="green-description">Sorry, but currently there is no article available!</span>
                </div>
            <?php else: ?>
                <?php foreach ($articles as $article): ?>
                    <div class="card">
                        <img src="data:image/jpeg;base64,<?= base64_encode($article['image']) ?>" alt="Article Image" class="card-img" />
                        <div class="info-container">
                            <div class="points-container">
                                <img src="../../image/badge.svg" alt="Points Badge"/>
                                <span class="points-text"><?= htmlspecialchars($article['pointsAwarded']) ?> pts</span>
                            </div>
                            <div class="medium-green-title"><?= htmlspecialchars($article['title']) ?></div>
                            <div class="icon-text">
                                <img src="../../image/people_head.svg" alt="Author" />
                                <span><?= htmlspecialchars($article['name']) ?></span>
                            </div>
                            <div class="icon-text">
                                <img src="../../image/calendar.svg" alt="calendar.svg" />
                                <span><?= htmlspecialchars($article['date']) ?></span>
                            </div>
                            <a href="article_details.php?id=<?= $article['articleID'] ?>" class="green-button">Read Article ></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>