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
    <link rel="stylesheet" href="../../styles/quiz.css">
    <title>Take Quiz</title>
</head>
<body>
    <?php include '../../component/stuHeader.php'; ?>
    <div class=" col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Available Quizzes</span>
            <span class="green-description">Complete quizzes to test your knowledge and earn points!</span>
        </div>

        <div class="card-container">
            <div class="card">
                <div class="quiz-points">
                    <img src="../../image/article.png" alt="Quiz" />
                    <div class="points-container">
                        <img src="../../image/badge.png" alt="Points Badge"/>
                        <span class="points-text">30 pts</span>
                    </div>
                </div>
                <div class="medium-green-title">Energy Conservation Basics</div>
                <div class="icon-text">
                    <img src="../../image/green_book.svg" alt="Book" />
                    <span>5 Questions</span>
                </div>
                <div class="icon-text">
                    <img src="../../image/green_badge.svg" alt="Badge" />
                    <span>Need 3 Corrects For Points</span>
                </div>
                <button class="green-button">Start Quiz ></button>
            </div>

            <div class="card">
                <div class="quiz-points">
                    <img src="../../image/article.png" alt="Quiz" />
                    <div class="points-container">
                        <img src="../../image/badge.png" alt="Points Badge"/>
                        <span class="points-text">30 pts</span>
                    </div>
                </div>
                <div class="medium-green-title">Energy Conservation Basics</div>
                <div class="icon-text">
                    <img src="../../image/green_book.svg" alt="Book" />
                    <span>5 Questions</span>
                </div>
                <div class="icon-text">
                    <img src="../../image/green_badge.svg" alt="Badge" />
                    <span>Need 3 Corrects For Points</span>
                </div>
                <button class="green-button">Start Quiz ></button>
            </div>

            <div class="card">
                <div class="quiz-points">
                    <img src="../../image/article.png" alt="Quiz" />
                    <div class="points-container">
                        <img src="../../image/badge.png" alt="Points Badge"/>
                        <span class="points-text">30 pts</span>
                    </div>
                </div>
                <div class="medium-green-title">Energy Conservation Basics</div>
                <div class="icon-text">
                    <img src="../../image/green_book.svg" alt="Book" />
                    <span>5 Questions</span>
                </div>
                <div class="icon-text">
                    <img src="../../image/green_badge.svg" alt="Badge" />
                    <span>Need 3 Corrects For Points</span>
                </div>
                <button class="green-button">Start Quiz ></button>
            </div>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>