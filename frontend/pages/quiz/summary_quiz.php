<?php
include('../../../backend/conn.php');
include('../../../backend/fetch_data.php');

session_start();
$quiz = $_SESSION['quiz'] ?? null;

if (!$quiz || empty($quiz['answers'])) {
    header("Location: choose_quiz.php");
    exit;
}

$totalQuestions = count($quiz['questions']);
$score = 0;

foreach ($quiz['answers'] as $answers) {
    $questionID = $answers['questionID'];
    $userAnswer = $answers['answer'];

    // Get question
    $question = getDataByID("question", "questionID", $questionID);

    if ($question['questionType'] === 'mcq') {
        // choice is correct, score++
        $choice = getDataBy2ID("choice", "choiceText", "questionID", $userAnswer, $questionID);

        if ($choice && $choice['isCorrect'] == 1) {
            $score++;
        }
    } else {
        if (strcasecmp(trim($userAnswer), trim($question['correctAnswer'])) === 0) {
            $score++;
        }
    }
}

$currentID = 3; //Dummy data
$requiredToPass = $quiz['correctForPoints'];
$passed = $score >= $requiredToPass;
$pointsEarned = $passed ? $quiz['pointsAwarded'] : 0;
$userQuiz = getDataByID("userQuiz", "userID", $currentID);

// If user completed before then 0 points 100%, if no and passed then record it, if no but no passed, ntg happens 
if($userQuiz) {
    $pointsEarned = 0;
} else {
    if ($pointsEarned > 0) {
        $userQuizID = uniqid();

        $sql_update = "UPDATE user SET points = points + $pointsEarned WHERE userID='$currentID'";
        mysqli_query($con, $sql_update);

        $sql_insert = "INSERT INTO userQuiz (userQuizID, userID, quizID) 
                       VALUES ('$userQuizID', '$currentID', '$quiz[quizID]')";
        mysqli_query($con, $sql_insert);
    }
}

// Destroy Quiz Session to prevent going back and change answer
unset($_SESSION['quiz']);
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
    <title>Quiz Summary</title>
</head>
<body>
    <?php include '../../component/stu_header.php'; ?>
    <div class=" col-12 col-s-12 content-mid fade-in">
        <div class="card-container">
            <div class="card">
                <?php if ($passed): ?>
                    <img src="../../image/challenge.svg" alt="Challenge" class="card-img">
                    <div class="text-group">
                        <span class="medium-green-title">Congratulation!</span>
                        <span class="green-description">You passed the quiz, you've done an excellent job!</span>
                    </div>
                <?php else: ?>
                    <img src="../../image/wrong.svg" alt="Wrong" class="card-img">
                    <div class="text-group">
                        <span class="medium-green-title">Keep Trying!</span>
                        <span class="green-description">You can retake this quiz to improve your score.</span>
                    </div>
                <?php endif; ?>
                <div class="summary">
                    <div class="green-description-between">
                        <span>Score:</span>
                        <span><?= $score ?> / <?= $totalQuestions ?></span>
                    </div>
                    <div class="green-description-between">
                        <span>Required to Pass:</span>
                        <span><?= $requiredToPass ?></span>
                    </div>
                    <div class="thin-line"></div>
                    <div class="dark-green-description-between">
                        <span>Points Earned:</span>
                        <span><?= $pointsEarned ?></span>
                    </div>
                </div>

                <?php if ($userQuiz): ?>
                    <div class="summary">
                        <span class="green-description-bold">Note: </span>
                        <span class="green-description">No points will be awarded because quiz is completed before</span>
                    </div>
                <?php endif; ?>

                <div class="review-container">
                    <span class="medium-green-title">Review Section</span>
                    <?php foreach ($quiz['answers'] as $index => $answer): ?>
                        <?php 
                        $question = getDataByID("question", "questionID", $answer['questionID']);
                        $userAnswer = $answer['answer'];
                        $isCorrect = false;
                        $correctAnswerText = '';

                        if ($question['questionType'] === 'mcq') {
                            // Fetch choices for question
                            $choices = getAllByID("choice", "questionID", $question['questionID']);

                            // Get correct choice
                            foreach ($choices as $choice) {
                                if ($choice['isCorrect'] == 1) {
                                    $correctAnswerText = $choice['choiceText'];
                                    break;
                                }
                            }

                            $isCorrect = ($userAnswer === $correctAnswerText);
                        } else {
                            $correctAnswerText = $question['correctAnswer'];
                            $isCorrect = strcasecmp(trim($userAnswer), trim($correctAnswerText)) === 0;
                        }
                        ?>
                        <div class="review-card">
                            <div class="icon-text-clean">
                                <img src="../../image/<?= $isCorrect ? 'tick.svg' : 'rejected.svg' ?>" alt="<?= $isCorrect ? 'Correct' : 'Wrong' ?>" />
                                <span class="dark-green-description-bold"><?= ($index + 1) ?>. <?= htmlspecialchars($question['questionText']) ?></span>
                            </div>
                            <span class="green-description">Your Answer: <?= htmlspecialchars($userAnswer) ?></span>
                            <?php if (!$isCorrect): ?>
                                <span class="green-description">Correct Answer: <?= htmlspecialchars($correctAnswerText) ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="choose_quiz.php" class="green-button">Back To Quizzes</a>
            </div>
        </div>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>
