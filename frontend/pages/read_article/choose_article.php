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
    <?php include '../../component/stuHeader.php'; ?>
    <div class=" col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Available Articles</span>
            <span class="green-description">Read articles to learn about sustainability and earn points!</span>
        </div>

        <div class="card-container">
            <div class="card">
                <img src="../../image/test_image.png" alt="Article Image" class="card-img" />
                <div class="info-container">
                    <div class="points-container">
                        <img src="../../image/badge.png" alt="Points Badge"/>
                        <span class="points-text">30 pts</span>
                    </div>
                    <div class="medium-green-title">The Impact of LED Lighting on Campus Energy Consumption</div>
                    <div class="icon-text">
                        <img src="../../image/people_head.png" alt="Author" />
                        <span>Dr. Sarah Green</span>
                    </div>
                    <div Aclass="icon-text">
                        <img src="../../image/calendar.svg" alt="calendar.svg" />
                        <span>2025-01-05</span>
                    </div>
                    <button class="green-button">Read Article ></button>
                </div>
            </div>
            <div class="card">
                <img src="../../image/test_image.png" alt="Article Image" class="card-img" />
                <div class="info-container">
                    <div class="points-container">
                        <img src="../../image/badge.png" alt="Points Badge" />
                        <span class="points-text">30 pts</span>
                    </div>
                    <div class="medium-green-title">The Impact of LED Lighting on Campus Energy Consumption</div>
                    <div class="icon-text">
                        <img src="../../image/people_head.png" alt="Author" />
                        <span>Dr. Sarah Green</span>
                    </div>
                    <div class="icon-text">
                        <img src="../../image/calendar.svg" alt="calendar.svg" />
                        <span>2025-01-05</span>
                    </div>
                    <button class="green-button">Read Article ></button>
                </div>
            </div>
            <div class="card">
                <img src="../../image/test_image.png" alt="Article Image" class="card-img" />
                <div class="info-container">
                    <div class="points-container">
                        <img src="../../image/badge.png" alt="Points Badge" />
                        <span class="points-text">30 pts</span>
                    </div>
                    <div class="medium-green-title">The Impact of LED Lighting on Campus Energy Consumption</div>
                    <div class="icon-text">
                        <img src="../../image/people_head.png" alt="Author" />
                        <span>Dr. Sarah Green</span>
                    </div>
                    <div class="icon-text">
                        <img src="../../image/calendar.svg" alt="calendar.svg" />
                        <span>2025-01-05</span>
                    </div>
                    <button class="green-button">Read Article ></button>
                </div>
            </div>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>