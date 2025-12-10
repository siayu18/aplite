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
    <?php include '../../component/stu_header.php'; ?>
    <div class=" col-12 col-s-12 content-mid fade-in">
        <div class="card-container">
            <div class="card" style="margin: 0 1rem;">
                <img src="../../image/wrong.svg" alt="Wrong" class="card-img">
                <div class="text-group">
                    <span class="medium-green-title">Keep Trying!</span>
                    <span class="green-description">You can retake this quiz to improve your score.</span>
                </div>
                <div class="summary">
                    <div class="green-description-between">
                        <span>Score:</span>
                        <span>1 / 4</span>
                    </div>
                    <div class="green-description-between">
                        <span>Required to Pass:</span>
                        <span>3</span>
                    </div>
                    <div class="thin-line"></div>
                    <div class="dark-green-description-between">
                        <span>Points Earned:</span>
                        <span>0</span>
                    </div>
                </div>
                <button class="green-button">Back To Quizzes</button>
            </div>

            <!-- <div class="card" style="margin: 0 1rem;">
                <img src="../../image/challenge.svg" alt="Challenge" class="card-img">
                <div class="text-group">
                    <span class="medium-green-title">Congratulation!</span>
                    <span class="green-description">You passed the quiz, you've done an excellent job!</span>
                </div>
                <div class="summary">
                    <div class="green-description-between">
                        <span>Score:</span>
                        <span>3 / 4</span>
                    </div>
                    <div class="green-description-between">
                        <span>Required to Pass:</span>
                        <span>3</span>
                    </div>
                    <div class="thin-line"></div>
                    <div class="dark-green-description-between">
                        <span>Points Earned:</span>
                        <span>50</span>
                    </div>
                </div>
                <button class="green-button">Back To Quizzes</button>
            </div> -->
        </div>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>