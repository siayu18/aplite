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
    <div class="menu">
        <a class="menu-text" href="../dashboard/staff_dashboard.php">Home</a>
        <a class="menu-text" href="../quiz/manage_quiz.php">Manage Quizzes</a>
        <a class="menu-text" href="../report/staff_room_reports.php">Generate Report</a>
        <a class="menu-text" href="../article/manage_article.php">Manage Articles</a>
        <a class="menu-text" href="">Broken Light Report</a>

        <a href="../account_management/profile.php"><img src="../../image/profile.png" alt="Profile" class="menu-img" /></a>
        <button id="more-button"><img src="../../image/more.svg" alt="More" class="menu-img" /></button>
        <div id="dropdown-menu" class="dropdown-content">
            <a href="../dashboard/staff_dashboard.php">Home</a>
            <a href="../quiz/manage_quiz.php">Manage Quizzes</a>
            <a href="#">Generate Report</a>
            <a href="../article/manage_article.php">Manage Articles</a>
            <a href="#">Light Report</a>
        </div>
    </div>
</body>
</html>