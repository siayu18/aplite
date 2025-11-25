<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Outfit:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sixtyfour&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/component.css">
</head>

<body>
    <div class="col-12 col-s-12 header-container">
        <div class="top-bar">
            <img src="../image/logo.png" alt="APLite Logo" class="logo" />
            <div class="menu">
                <a class="menu-text" href="#">Home</a>
                <a class="menu-text" href="#">Manage Quizzes</a>
                <a class="menu-text" href="#">Generate Report</a>
                <a class="menu-text" href="#">Manage Articles</a>
                <a class="menu-text" href="#">Broken Light Report</a>

                <a href="#"><img src="../image/profile.png" alt="Profile" class="menu-img" /></a>
                <button id="more-button"><img src="../image/more.png" alt="More" class="menu-img" /></button>
                <div id="dropdown-menu" class="dropdown-content">
                    <a href="#">Home</a>
                    <a href="#">Manage Quizzes</a>
                    <a href="#">Generate Report</a>
                    <a href="#">Manage Articles</a>
                    <a href="#">Light Report</a>
                </div>
            </div>
        </div>
    </div>

    <script src="../scripts/dashboard.js"></script>
</body>

</html>