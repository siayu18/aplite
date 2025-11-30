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
    <title>Manage Announcements</title>
</head>
<body>
    <?php include '../../component/admin_header.php'; ?>
    <div class=" col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Manage Announcements</span>
            <span class="green-description">Create, Edit and Delete Announcements!</span>
        </div>

        <div class="wrap-middle">
            <div class="big-green-button">+ Create Announcement</div>
        </div>

        <div class="container">
            <div class="card">
                <div class="between-stretch">
                    <div class="icon-text">
                        <img src="../../image/calendar.svg" alt="Calendar" />
                        <span>2025-10-17</span>
                    </div>
                    <div class="near-button-row">
                        <button class="border-button">
                            <img src="../../image/edit.svg" alt="Edit" />
                        </button>
                        <button class="red-border-button">
                            <img src="../../image/delete.svg" alt="Delete" />
                        </button>
                    </div>
                </div>
                <div class="medium-green-title">APLITE Challenge Update: Top 10 Revealed!</div>
                <div class="green-description">Congratulations to our top performers this month! The competition is heating up. Keep participating in quizzes, reading articles, and practicing energy-saving habits to climb the leaderboard. Special prizes await the top 3 students at the end of the semester!</div>
            </div>

            <div class="card">
                <div class="between-stretch">
                    <div class="icon-text">
                        <img src="../../image/calendar.svg" alt="Calendar" />
                        <span>2025-10-17</span>
                    </div>
                    <div class="near-button-row">
                        <button class="border-button">
                            <img src="../../image/edit.svg" alt="Edit" />
                        </button>
                        <button class="red-border-button">
                            <img src="../../image/delete.svg" alt="Delete" />
                        </button>
                    </div>
                </div>
                <div class="medium-green-title">APLITE Challenge Update: Top 10 Revealed!</div>
                <div class="green-description">Congratulations to our top performers this month! The competition is heating up. Keep participating in quizzes, reading articles, and practicing energy-saving habits to climb the leaderboard. Special prizes await the top 3 students at the end of the semester!</div>
            </div>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>