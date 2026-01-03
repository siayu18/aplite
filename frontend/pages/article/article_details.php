<?php
require_once "../../../backend/auth/session_student.php";
include ('../../../backend/conn.php');
include ('../../../backend/fetch_data.php');

if (!isset($_GET['id'])) {
    echo "<script>alert('Article ID not specified'); window.location.href='choose_article.php';</script>";
}

// Fetch data
$articleID = $_GET['id'];
$article = getDataByIDWithJoin('article', 'user', 'staffID', 'userID', 'articleID', $articleID);
if (!$article) {
    die('Article not found.');
}

// Article Claim Points Logic
$currentID = $_SESSION['user_id'];
$current_user = getDataByID("user", "userID", $currentID);
if (!$current_user) {
    die("User Not Found");
}

if (isset($_GET['claim'])) {
    $claimStatus = false;
    $user_article = getDataBy2ID("userArticle", "userID", "articleID", $currentID, $articleID);

    if ($user_article) {
        // Overlay
        $claimStatus = true;
        echo "<script>window.success = 'true';</script>";
    } else {
        $user_articleID = uniqid();
        $current_date = date("Y-m-d");

        // Update userArticle table
        $sql_insert = "INSERT INTO userArticle (userArticleID, userID, articleID, date) VALUES ('$user_articleID', '$currentID', '$articleID', '$current_date')";
        mysqli_query($con, $sql_insert);

        // Update user points
        $points = $article['pointsAwarded'];
        $sql_update = "UPDATE user SET points = points + $points WHERE userID='$currentID'";
        mysqli_query($con, $sql_update);

        // Overlay
        echo "<script>window.success='true';</script>";
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
    <link rel="stylesheet" href="../../styles/article.css">
    <title>Read Articles</title>
</head>
<body>
    <?php include '../../component/load_header.php'; ?>
    <div class=" col-12 col-s-12 content-mid fade-in">
        <div class="main-container">
            <div class="back-wrapper">
                <a href="choose_article.php">
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
                            <img src="../../image/badge.svg" alt="Points Badge" class="" />
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
                        <a href="article_details.php?id=<?= $articleID ?>&claim=true" class="green-button" name="claim">Claim <?= htmlspecialchars($article['pointsAwarded']) ?> Points</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay"></div>
    <div class="modal">
        <img src="../../image/<?= $claimStatus ? 'wrong.svg' : 'verify.svg'?>" alt="<?= $claimStatus ? 'Wrong' : 'Verify'?>" class="modal-img">
        <div class="text-group">
            <span class="medium-green-title">
                <?php if ($claimStatus) : ?>
                    Already Claimed!
                <?php else : ?>
                    Successfuly Claimed!
                <?php endif; ?>
            </span>
            <span class="green-description">
                <?php if ($claimStatus) : ?>
                    Sorry, you have already claimed points for this article.
                <?php else : ?>
                    You have successfully claimed <strong><?= $article['pointsAwarded'] ?> points</strong>, thanks for reading.
                <?php endif; ?>
            </span>
        </div>
        <a href="choose_article.php" class="green-button">Back</a>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/overlay.js"></script>
</body>
</html>