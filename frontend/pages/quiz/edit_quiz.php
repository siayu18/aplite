<?php
require_once "../../../backend/auth/session_staff.php";
include ('../../../backend/conn.php');
include ('../../../backend/fetch_data.php');

if (!isset($_GET['id'])) {
    echo "<script>alert('Quiz ID not specified'); window.location.href='manage_quiz.php';</script>";
}

$quizID = $_GET['id'];
$quiz = getDataByID("quiz", "quizID", $quizID);
$questions = getAllByID("question", "quizID", $quizID);
$message = "";

// Handle Update
if(isset($_POST["submitBtn"])){
    $title = $_POST["title"];
    $pointsAwarded = $_POST["pointsAwarded"];
    $correctForPoints = $_POST["correctForPoints"];
    $questionIndex = 1; // Index Because the structure is like 1,2,3, choice is 1_1, 2_1, 3_1, 4_1
    $hasQuestion = false;

    // Validation
    if (!ctype_digit($pointsAwarded) || !ctype_digit($correctForPoints) ) {
        $message = "Points must be an integer.";
    }

    while (isset($_POST["questionType$questionIndex"])) {
        $hasQuestion = true;
        break;
    }

    if (!$hasQuestion) {
        $message = "You must add at least one question before creating the quiz.";
    }

    // Update to DB
    if (empty($message)) {
        $sql = "UPDATE quiz
                SET title = '$title',
                    pointsAwarded = '$pointsAwarded',
                    correctForPoints = '$correctForPoints'
                WHERE quizID = '$quizID'";

        if (!mysqli_query($con, $sql)) {
            die("Quiz update failed: " . mysqli_error($conn));
        }

        // Delete Old Data
        mysqli_query($con, "
                DELETE c FROM choice c
                INNER JOIN question q ON c.questionID = q.questionID
                WHERE q.quizID = '$quizID'
            ");

        mysqli_query($con, "
            DELETE FROM question WHERE quizID = '$quizID'
        ");

        while (isset($_POST["questionType$questionIndex"])) {
            $questionID = uniqid();
            $questionType = $_POST["questionType$questionIndex"];
            $questionText = $_POST["questionText$questionIndex"];
            $correctAnswer = NULL;

            // Open Question Add it into correctAnswer column
            if ($questionType === "open") {
                $correctAnswer = $_POST["correctAnswer$questionIndex"];
            }

            $sql = "INSERT INTO Question (questionID, quizID, questionType, questionText, correctAnswer)
                    VALUES ('$questionID', '$quizID', '$questionType', '$questionText', '$correctAnswer')";

            if (!mysqli_query($con, $sql)) {
                die("Question update failed: " . mysqli_error($conn));
            }

            // MCQ Question add each into Choice table
            if ($questionType === "mcq") {
                $correctChoice = $_POST["question$questionIndex"] ?? "";

                for ($c = 1; $c <= 4; $c++) {
                    $choiceID = uniqid("c_");
                    $choiceText = trim($_POST["choice{$c}_$questionIndex"]);
                    $isCorrect = ($correctChoice === "choice$c") ? true : false;

                    $sql = "INSERT INTO Choice (choiceID, questionID, choiceText, isCorrect)
                            VALUES ('$choiceID', '$questionID', '$choiceText', '$isCorrect')";

                    if (!mysqli_query($con, $sql)) {
                        die("Choice update failed: " . mysqli_error($conn));
                    }
                }
            }
            $questionIndex++;
        }
        echo "<script>window.success = true;</script>";
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
    <title>Edit Quiz</title>
</head>

<body>
    <?php include '../../component/staff_header.php'; ?>
    <div class="col-12 col-s-12 content-mid fade-in">
        <div class="main-container">
            <div class="back-wrapper">
                <a href="manage_quiz.php">
                    <div class="interactive-icon-text">
                        <img src="../../image/back.svg" alt="Back" class="icon-img" />
                        <span class="icon-text">Back to Manage Quizzes</span>
                    </div>
                </a>
            </div>
            <form method="POST" action="edit_quiz.php?id=<?= $quizID ?>" class="inner-container">
                <div class="medium-green-title" id="title">Edit Quiz</div>

                <div class="label-field">
                    <label class="green-description">Title</label>
                    <input type="text" placeholder="Enter title..." name ="title" value="<?= htmlspecialchars($quiz['title']) ?>" required/>
                </div>

                <div class="field-group">
                    <div class="label-field">
                        <label class="green-description">Points Awarded</label>
                        <input type="text" placeholder="Enter Points..." name="pointsAwarded" value="<?= htmlspecialchars($quiz['pointsAwarded']) ?>" required/>
                    </div>
                    <div class="label-field">
                        <label class="green-description">Correct For Points</label>
                        <input type="text" placeholder="Enter Points..." name="correctForPoints" value="<?= htmlspecialchars($quiz['correctForPoints']) ?>" required/>
                    </div>
                </div>

                <div class="right-button-group">
                    <button type="button" class="green-button" id="add-question-btn">+ Add Question</button>
                </div>

                <?php $index = 1;
                foreach($questions as $question): ?>
                    <div class="inner-container question-container">
                        <div class="between-stretch">
                            <div class="medium-green-title">Question <?= $index ?></div>
                            <button type="button" class="red-border-button delete-question">
                                <img src="../../image/delete.svg" alt="Delete" />
                            </button>
                        </div>

                        <div class="label-field">
                            <label class="green-description">Question Type</label>
                            <select class="dropdown question-type" name="questionType<?= $index ?>">
                                <option value="mcq" <?= $question['questionType']=='mcq'?'selected':'' ?>>MCQ Question</option>
                                <option value="open" <?= $question['questionType']=='open'?'selected':'' ?>>Open-Ended Question</option>
                            </select>
                        </div>

                        <div class="label-field">
                            <label class="green-description">Question Text</label>
                            <input type="text" placeholder="Enter Text..." name="questionText<?= $index ?>" value="<?= htmlspecialchars($question['questionText']) ?>" required/>
                        </div>

                        <?php
                        $choices = getAllByID("choice", "questionID", $question['questionID']);
                        if ($choices): ?>
                            <div class="label-field mcq-section" style="<?= $question['questionType']=='mcq'?'':'display: none'?>">
                                <label class="green-description">Choices</label>
                                <div class="near-button-column">

                                    <?php $count=1;
                                    foreach($choices as $choice): ?>
                                        <div class="near-button-row">
                                            <input type="radio" name="question<?= $index ?>" value="choice<?= $count ?>" <?= $choice['isCorrect']?'checked':'' ?> required>
                                            <input type="text" placeholder="Enter Choice..." name="choice<?= $count ?>_<?= $index ?>" value="<?= htmlspecialchars($choice['choiceText']) ?>"/>
                                        </div>
                                    <?php $count++; endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="label-field open-ended-section" style="<?= $question['questionType']=='open'?'':'display:none' ?>">
                            <label class="green-description">Correct Answer</label>
                            <input type="text" placeholder="Enter Correct Answer..." name="correctAnswer<?= $index ?>" value="<?=$question['correctAnswer'] ?>" required/>
                        </div>
                    </div>
                <?php $index++; endforeach; ?>

                <div class="right-button-group" style="margin-top: 1rem;">
                    <a href="manage_quiz.php" class="white-button">Cancel</a>
                    <button type="submit" class="green-button" name="submitBtn">Update Quiz</button>
                </div>

                <?php if (!empty($message)): ?>
                    <div class="error-message">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="overlay"></div>
    <div class="modal">
        <img src="../../image/verify.svg" alt="Verify" class="modal-img">
        <div class="text-group">
            <span class="medium-green-title">Successfully Updated!</span>
            <span class="green-description">You have successfully updated the quiz</span>
        </div>
        <a href="manage_quiz.php" class="green-button">Back</a>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/quiz.js"></script>
    <script src="../../scripts/overlay.js"></script>
</body>
</html>