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
            <form method="POST" action="create_article.php" class="inner-container">
                <div class="medium-green-title">Create Article</div>

                <div class="label-field">
                    <label class="green-description">Title</label>
                    <input type="text" placeholder="Enter title..." />
                </div>

                <div class="label-field">
                    <label class="green-description">Points Awarded</label>
                    <input type="text" placeholder="Enter Points..." />
                </div>

                <div class="label-field">
                    <label class="green-description">Image</label>
                    <input type="file"></input>
                </div>

                <div class="label-field">
                    <label class="green-description">Content</label>
                    <textarea class="white-area" placeholder="Enter title..."></textarea>
                </div>

                <div class="right-button-group">
                    <a href="manage_article.php" class="white-button">Cancel</a>
                    <button class="green-button">Create Article</button>
                </div>
            </form>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>