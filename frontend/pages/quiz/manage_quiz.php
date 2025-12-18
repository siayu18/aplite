<?php
include ('../../../backend/conn.php');

// Handle Delete
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($con, $_GET['delete']);

    $sql = "DELETE FROM quiz WHERE quizID = '$id'";

    if (!mysqli_query($con, $sql)) {
        die('Error deleting: ' . mysqli_error($con));
    } else {
        echo "<script>window.success = true;</script>";
    }
}

// Fetch Data
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

mysqli_close($con);
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
    <title>Manage Quizzes</title>
</head>
<body>
    <?php include '../../component/staff_header.php'; ?>
    <div class=" col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Manage Quizzes</span>
            <span class="green-description">Create, edit, and manage all quizzes!</span>
        </div>

        <div class="wrap-middle">
            <a href="create_quiz.php" class="big-green-button">+ Create Quiz</a>
        </div>

        <div class="card-container">
            <?php if (empty($quizzes)): ?>
                <div class="mid-text-group">
                    <span class="medium-green-title">No quizzes available!</span>
                    <span class="green-description">Sorry, but currently there is no quiz available!</span>
                </div>
            <?php else: ?>
                <?php foreach ($quizzes as $quiz): ?>
                    <div class="card">
                        <div class="quiz-points">
                            <img src="../../image/article.png" alt="Quiz" />
                            <div class="points-container">
                                <img src="../../image/badge.png" alt="Points Badge"/>
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
                        <div class="near-button-column">
                            <a href="edit_quiz.php?id=<?= $quiz['quizID'] ?>" class="green-button">Edit Quiz</a>
                            <a href="manage_quiz.php?delete=<?= $quiz['quizID'] ?>" class="red-button">Delete Quiz</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="overlay"></div>
    <div class="modal">
        <img src="../../image/verify.svg" alt="Verify" class="modal-img">
        <div class="text-group">
            <span class="medium-green-title">Successfully Deleted!</span>
            <span class="green-description">You have successfully deleted the quiz</span>
        </div>
        <a href="manage_quiz.php" class="green-button">Back</a>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/overlay.js"></script>
</body>
</html>