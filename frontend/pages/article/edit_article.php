<?php
include('../../../backend/conn.php');
include('../../../backend/fetch_data.php');

if (!isset($_GET['edit'])) {
    echo "<script>alert('Article ID not specified'); window.location.href='manage_article.php';</script>";
}

$articleID = mysqli_real_escape_string($con, $_GET['edit']);

// Fetch data
$article = getDataByIDWithJoin('article', 'user', 'staffID', 'userID', 'articleID', $articleID);
if (!$article) {
    die('Article not found.');
}

// Handle update
if (isset($_POST['submitBtn'])) {
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $points = mysqli_real_escape_string($con, $_POST['points']);
    $content = mysqli_real_escape_string($con, $_POST['content']);

    $imageData = null;
    if (!empty($_FILES['image']['tmp_name'])) {
        $imageData = mysqli_real_escape_string($con, file_get_contents($_FILES['image']['tmp_name']));
    }

    if (!ctype_digit($points)) {
        $message = "Points must be an integer.";
    } else {
        $sql = "UPDATE article SET title='$title', content='$content', pointsAwarded='$points', image='$imageData' WHERE articleID='$articleID'";

        if (!mysqli_query($con, $sql)) {
            die("Error: " . mysqli_error($con));
        } else {
            echo "<script>window.success = true;</script>";
        }
    }
    mysqli_close($con);
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
    <link rel="stylesheet" href="../../styles/article.css">
    <title>Edit Article</title>
</head>

<body>
    <?php include '../../component/staff_header.php'; ?>
    <div class=" col-12 col-s-12 content-mid fade-in">
        <div class="main-container">
            <div class="back-wrapper">
                <a href="manage_article.php">
                    <div class="interactive-icon-text">
                        <img src="../../image/back.svg" alt="Back" class="icon-img" />
                        <span class="icon-text">Back to Manage Articles</span>
                    </div>
                </a>
            </div>
            <form method="POST" enctype="multipart/form-data" action="edit_article.php?edit=<?= $articleID ?>" class="inner-container">
                <div class="medium-green-title">Edit Article</div>

                <div class="label-field">
                    <label class="green-description">Title</label>
                    <input type="text" placeholder="Enter title..." name="title" value="<?= htmlspecialchars($article['title']) ?>" required/>
                </div>

                <div class="label-field">
                    <label class="green-description">Points Awarded</label>
                    <input type="text" placeholder="Enter Points..." name="points" value="<?= htmlspecialchars($article['pointsAwarded']) ?>" required/>
                </div>

                <div class="label-field">
                    <label class="green-description">Image</label>
                    <input type="file" name="image" required></input>
                </div>

                <div class="label-field">
                    <label class="green-description">Content</label>
                    <textarea class="white-area" placeholder="Enter content..." name="content" required><?= htmlspecialchars($article['content']) ?></textarea>
                </div>

                <div class="right-button-group">
                    <a href="manage_article.php" class="white-button">Cancel</a>
                    <button type="submit" name="submitBtn" class="green-button">Update Article</button>
                </div>
            </form>
        </div>
    </div>

    <div class="overlay"></div>
    <div class="modal">
        <img src="../../image/verify.svg" alt="Verify" class="modal-img">
        <div class="text-group">
            <span class="medium-green-title">Successfully Edited!</span>
            <span class="green-description">You have successfully edited the article</span>
        </div>
        <a href="manage_article.php" class="green-button">Back</a>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/overlay.js"></script>
</body>
</html>