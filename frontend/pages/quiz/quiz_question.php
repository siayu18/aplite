<?php
require_once "../../../backend/auth/session_student.php";
include ('../../../backend/conn.php');
include ('../../../backend/fetch_data.php');

session_start();
$quiz = $_SESSION['quiz'];

if (!$quiz) {
    header("Location: choose_quiz.php");
    exit;
}

$currentIndex = $quiz['current'];
$question = $quiz['questions'][$currentIndex];
$totalQuestions = count($quiz['questions']);
$isLastQuestion = ($currentIndex == $totalQuestions - 1);
$choices = null;

// if type is mcq then get choices
if ($question['questionType'] == 'mcq') {
    $choices = getAllByID("choice", "questionID", $question["questionID"]);
}

if (isset($_POST['submitBtn'])) {
    $userAnswer = $_POST['answer'];

    // Save question answer into session
    $_SESSION['quiz']['answers'][$currentIndex] = [
        'questionID' => $question['questionID'],
        'answer' => $userAnswer
    ];

    // Make sure it does not exceed the amount of questions
    if ($currentIndex < $totalQuestions - 1) {
        $_SESSION['quiz']['current']++;
        header("Location: quiz_question.php");
        exit;
    } else {
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

                <div class="dark-green-description-bold"><?= $question['questionText'] ?></div>

                <?php if ($question["questionType"] == "mcq") : ?>
                    <div class="selection-group">
                        <?php foreach ($choices as $choice): ?>
                            <label class="answer-button">
                                <input type="radio" name="answer" value="<?= htmlspecialchars($choice["choiceText"]) ?>" required>
                                    <?= htmlspecialchars($choice["choiceText"]) ?>
                                </input>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <textarea class="white-area" name="answer" placeholder="Enter your answer..." required></textarea>
                <?php endif ?>
                
                <button type="submit" name="submitBtn" class="green-button"><?= $isLastQuestion ? 'Finish' : 'Next' ?></button>
            </form>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>