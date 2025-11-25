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
    <title>Read Articles</title>
</head>
<body>
    <?php include '../../component/stuHeader.php'; ?>
    <div class=" col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Announcements</span>
            <span class="green-description">Stay updated with the latest news!</span>
        </div>

        <div class="container">
            <div class="card">
                 <div class="icon-text">
                    <img src="../../image/calendar.svg" alt="Calendar" />
                    <span>2025-10-18</span>
                </div>
                <div class="medium-green-title">New Sustainability Workshop Next Week</div>
                <div class="green-description">Join us for an interactive workshop on sustainable living practices. Learn practical tips for reducing your carbon footprint both on and off campus. Date: January 25, 2025. Time: 2:00 PM - 4:00 PM. Venue: Main Auditorium. Register now to earn 20 bonus points!</div>
            </div>

            <div class="card">
                 <div class="icon-text">
                    <img src="../../image/calendar.svg" alt="Calendar" />
                    <span>2025-10-17</span>
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