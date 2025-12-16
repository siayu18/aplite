<?php
include ('../../../backend/conn.php');
include ('../../../backend/fetch_data.php');

if (!isset($_GET['id'])) {
    die('Article ID not specified.');
}

$quizID = $_GET['id'];
$questions = getDataByID("question", "quizID", $quizID);

if(!$questions) {
    echo "<script>alert('No questions!'); window.href='choose_quiz.php'</script>";
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
    <link rel="stylesheet" href="../../styles/quiz.css">
    <title>Take Quiz</title>
</head>
<body>
    <?php include '../../component/stu_header.php'; ?>
    <div class=" col-12 col-s-12 content-mid fade-in">
        <div class="main-container">
            <div class="back-wrapper">
                <a href="choose_quiz.php">
                    <div class="interactive-icon-text">
                        <img src="../../image/back.svg" alt="Back" class="icon-img" />
                        <span class="icon-text">Back to Quizzes</span>
                    </div>
                </a>
            </div>
            <form method="POST" action="mcq_quiz.php" class="inner-container">
                <div class="quiz-text">
                    <div class="medium-green-title">Energy Conservation Basics</div>
                    <div class="green-description">Question 1 of 4</div>
                </div>

                <div class="dark-green-description">What percentage of energy can be saved by turning off unused lights?</div>

                <div class="selection-group">
                    <button class="answer-button">10%</button>
                    <button class="answer-button">25%</button>
                    <button class="answer-button">50%</button>
                    <button class="answer-button">75%</button>
                </div>
                
                <button type="submit" class="green-button">Next</button>
            </form>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>