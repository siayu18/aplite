<?php
include ('../../../backend/conn.php');
include ('../../../backend/fetch_data.php');

if (!isset($_GET['id'])) {
    die('Article ID not specified.');
}

// Fetch data
$articleID = $_GET['id'];
$article = getDataByIDWithJoin('article', 'user', 'staffID', 'userID', 'articleID', $articleID);
if (!$article) {
    die('Article not found.');
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
    <link rel="stylesheet" href="../../styles/article.css">
    <title>Read Articles</title>
</head>
<body>
    <?php include '../../component/stu_header.php'; ?>
    <div class=" col-12 col-s-12 content fade-in">
        <div class="main-container">
            <div class="back-wrapper">
                <a href="">
                    <div class="interactive-icon-text">
                        <img src="../../image/back.svg" alt="Back" class="icon-img" />
                        <span class="icon-text">Back to Articles</span>
                    </div>
                </a>
            </div>
            <div class="article-container">
                <img src="data:image/jpeg;base64,<?= base64_encode($article['image']) ?>" alt="Article Image" class="article-img" />
                <div class="article-details">
                    <div class="medium-green-title"><?= htmlspecialchars($article['title']) ?></div>
                    <div class="metadata">
                        <div class="green-description">By <?= htmlspecialchars($article['name']) ?> | Published on <?= htmlspecialchars($article['date']) ?></div>
                        <div class="points-container">
                            <img src="../../image/badge.png" alt="Points Badge" class="" />
                            <span class="points-text"><?= htmlspecialchars($article['pointsAwarded']) ?> pts</span>
                        </div>
                    </div>
                    <p class="article-content"><?= htmlspecialchars($article['content']) ?></p>
                    <div class="claim-container">
                        <img src="../../image/big_badge.svg" alt="Points Badge" />
                        <div class="text-group">
                            <span class="medium-green-title">Great job reading this article!</span>
                            <span class="green-description">Claim your <?= htmlspecialchars($article['pointsAwarded']) ?> points for expanding your sustainability knowledge.</span>
                        </div>
                        <button class="green-button">Claim <?= htmlspecialchars($article['pointsAwarded']) ?> Points</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>