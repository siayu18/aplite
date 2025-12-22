<?php
include("../../../backend/conn.php");
include("../../../backend/fetch_data.php");

$currentID = 3;

$sql = "SELECT q.quizID, q.title, q.pointsAwarded, q.correctForPoints, COUNT(que.questionID) AS questionCount
        FROM Quiz AS q
        LEFT JOIN Question AS que ON q.quizID = que.quizID
        GROUP BY q.quizID, q.title, q.pointsAwarded, q.correctForPoints
        ORDER BY q.title ASC";
$result = mysqli_query($con, $sql);

$quizzes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $quizzes[] = $row;
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
    <div class=" col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Available Quizzes</span>
            <span class="green-description">Complete quizzes to test your knowledge and earn points!</span>
        </div>

        <div class="card-container">
            <?php if (empty($quizzes)): ?>
                <div class="mid-text-group">
                    <span class="medium-green-title">No quizzes available!</span>
                    <span class="green-description">Sorry, but currently there is no quiz available!</span>
                </div>
            <?php else: ?>
                <?php foreach ($quizzes as $quiz): ?>
                    <?php $userQuiz = getDataBy2ID("userQuiz", "userID", "quizID", $currentID, $quiz['quizID']); ?>
                    <div class="card">
                        <div class="quiz-points">
                            <img src="../../image/article.svg" alt="Quiz" />
                            <div class="points-container">
                                <img src="../../image/badge.svg" alt="Points Badge"/>
                                <span class="points-text"><?= htmlspecialchars($quiz['pointsAwarded']) ?> pts</span>
                            </div>
                        </div>
                        <div class="medium-green-title"><?= htmlspecialchars($quiz['title']) ?></div>
                        <div class="icon-text">
                            <img src="../../image/green_book.svg" alt="Book" />
                            <span><?= htmlspecialchars($quiz['questionCount']) ?> Questions</span>
                        </div>
                        <div class="icon-text">
                            <img src="../../image/green_badge.svg" alt="Badge" />
                            <span>Need <?= htmlspecialchars($quiz['correctForPoints']) ?> Corrects For Points</span>
                        </div>
                        <div class="icon-text">
                            <img src="../../image/status.svg" alt="Badge" />
                            <span>Status: 
                            <?php if ($userQuiz): ?>
                                <strong style="color: rgba(0, 184, 0, 1);"> Completed </strong>
                            <?php else: ?>
                                <strong style="color: red;"> Incomplete </strong>
                            <?php endif; ?>
                            </span>
                        </div>
                        <a href="take_quiz.php?id=<?= $quiz['quizID'] ?>" class="green-button">Start Quiz ></a>
                    </div>
                <?php endforeach; ?>
                <?php mysqli_close($con); ?>
            <?php endif; ?>
        </div>

        <div class="transparent-card">
            <span class="green-description-bold">Note:</span>
            <span class="green-description">Points will not be awarded for quiz that is completed before.</span>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>