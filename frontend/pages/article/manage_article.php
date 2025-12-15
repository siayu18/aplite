<?php
include ('../../../backend/conn.php');
include ('../../../backend/fetch_data.php');

// Handle Delete
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($con, $_GET['delete']);

    $sql = "DELETE FROM article WHERE articleID = '$id'";

    if (!mysqli_query($con, $sql)) {
        die('Error deleting: ' . mysqli_error($con));
    } else {
        echo "<script>window.success = true;</script>";
    }
}

// Fetch Data
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
    <title>Manage Articles</title>
</head>
<body>
    <?php include '../../component/staff_header.php'; ?>
    <div class=" col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Manage Articles</span>
            <span class="green-description">Create, edit, and manage all articles!</span>
        </div>

        <div class="wrap-middle">
            <a href="create_article.php" class="big-green-button">+ Create Article</a>
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
                                <img src="../../image/badge.png" alt="Points Badge"/>
                                <span class="points-text"><?= htmlspecialchars($article['pointsAwarded']) ?> pts</span>
                            </div>
                            <div class="medium-green-title"><?= htmlspecialchars($article['title']) ?></div>
                            <div class="icon-text">
                                <img src="../../image/people_head.png" alt="Author" />
                                <span><?= htmlspecialchars($article['name']) ?></span>
                            </div>
                            <div class="icon-text">
                                <img src="../../image/calendar.svg" alt="calendar.svg" />
                                <span><?= htmlspecialchars($article['date']) ?></span>
                            </div>
                            <div class="near-button-column">
                                <a href="edit_article.php?edit=<?= $article['articleID'] ?>" class="green-button">Edit Article</a>
                                <a href="manage_article.php?delete=<?= $article['articleID'] ?>" class="red-button">Delete Article</a>
                            </div>
                        </div>
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
            <span class="green-description">You have successfully deleted the article</span>
        </div>
        <a href="manage_article.php" class="green-button">Back</a>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/overlay.js"></script>
</body>
</html>