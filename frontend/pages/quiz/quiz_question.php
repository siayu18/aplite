<?php
session_start();
$quiz = $_SESSION['quiz'];
$currentIndex = $quiz['current'];
$question = $quiz['questions'][$currentIndex];
$totalQuestions = count(value: $quiz['questions']);
$isLastQuestion = ($currentIndex == $totalQuestions - 1);

if (isset($_POST['submitBtn'])) {
    include('../../../backend/conn.php');

    if ($quiz['current'] < count(value: $quiz['questions']) - 1) {
        $quiz['current']++;
        $_SESSION['quiz'] = $quiz;
        header("Location: quiz_question.php");
        exit;
    } else if ($quiz['current'] == $totalQuestions - 1) {
        header("Location: summary_quiz.php");
        exit;
    }
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
            <form method="POST" action="quiz_question.php" class="inner-container">
                <div class="quiz-text">
                    <div class="medium-green-title"><?= htmlspecialchars($quiz['title']) ?></div>
                    <div class="green-description">Question <?= $currentIndex + 1 ?> of <?= $totalQuestions ?></div>
                </div>

                <div class="dark-green-description"><?= $question['questionText'] ?></div>

                <div class="selection-group">
                    <button class="answer-button">10%</button>
                    <button class="answer-button">25%</button>
                    <button class="answer-button">50%</button>
                    <button class="answer-button">75%</button>
                </div>
                
                <button type="submit" name="submitBtn" class="green-button"><?= $isLastQuestion ? 'Finish' : 'Next' ?></button>
            </form>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>