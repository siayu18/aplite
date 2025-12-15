<?php
include ('../../../backend/conn.php');
$message = "";

if(isset($_POST["submitBtn"])){
    $quizID = uniqid();
    $title = $_POST["title"];
    $pointsAwarded = $_POST["pointsAwarded"];
    $correctForPoints = $_POST["correctForPoints"];

    if (!ctype_digit($pointsAwarded) || !ctype_digit($correctForPoints) ) {
        $message = "Points must be an integer.";
    } else {
        $sql = "INSERT INTO Quiz (quizID, title, pointsAwarded, correctForPoints)
                VALUES ('$quizID','$title','$pointsAwarded','$correctForPoints')";

        if (!mysqli_query($con, $sql)) {
            die("Quiz insert failed: " . mysqli_error($conn));
        }

        // Index Because the structure is like 1,2,3, choice is 1_1, 2_1, 3_1, 4_1
        $questionIndex = 1;

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
                die("Question insert failed: " . mysqli_error($conn));
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
                        die("Choice insert failed: " . mysqli_error($conn));
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
    <title>Create Quiz</title>
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
            <form method="POST" action="create_quiz.php" class="inner-container">
                <a class="medium-green-title">Create Quiz</a>

                <div class="label-field">
                    <label class="green-description">Title</label>
                    <input type="text" placeholder="Enter title..." name="title" />
                </div>

                <div class="field-group">
                    <div class="label-field">
                        <label class="green-description">Points Awarded</label>
                        <input type="text" placeholder="Enter Points..." name="pointsAwarded" />
                    </div>
                    <div class="label-field">
                        <label class="green-description">Correct For Points</label>
                        <input type="text" placeholder="Enter Points..." name="correctForPoints" />
                    </div>
                </div>

                <div class="right-button-group">
                    <button type="button" class="green-button" id="add-question-btn">+ Add Question</button>
                </div>

                <div class="inner-container question-container">
                    <div class="between-stretch">
                        <div class="medium-green-title">Question 1</div>
                        <button type="button" class="red-border-button delete-question">
                            <img src="../../image/delete.svg" alt="Delete" />
                        </button>
                    </div>

                    <div class="label-field">
                        <label class="green-description">Question Type</label>
                        <select class="dropdown question-type" name="questionType1">
                            <option value="mcq">MCQ Question</option>
                            <option value="open">Open-Ended Question</option>
                        </select>
                    </div>

                    <div class="label-field">
                        <label class="green-description">Question Text</label>
                        <input type="text" placeholder="Enter Text..." name="questionText1"/>
                    </div>

                    <div class="label-field mcq-section">
                        <label class="green-description">Choices</label>
                        <div class="near-button-column">
                            <div class="near-button-row">
                                <input type="radio" name="question1" value="choice1">
                                <input type="text" placeholder="Enter Choice..." name="choice1_1" />
                            </div>
                            <div class="near-button-row">
                                <input type="radio" name="question1" value="choice2">
                                <input type="text" placeholder="Enter Choice..." name="choice2_1"/>
                            </div>
                            <div class="near-button-row">
                                <input type="radio" name="question1" value="choice3">
                                <input type="text" placeholder="Enter Choice..." name="choice3_1"/>
                            </div>
                            <div class="near-button-row">
                                <input type="radio" name="question1" value="choice4">
                                <input type="text" placeholder="Enter Choice..." name="choice4_1"/>
                            </div>
                        </div>
                    </div>

                    <div class="label-field open-ended-section" style="display: none;">
                        <label class="green-description">Correct Answer</label>
                        <input type="text" placeholder="Enter Correct Answer..." name="correctAnswer1" />
                    </div>
                </div>

                <div class="right-button-group" style="margin-top: 1rem;">
                    <a href="manage_quiz.php" class="white-button">Cancel</a>
                    <button type="submit" class="green-button" name="submitBtn">Create Quiz</button>
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
            <span class="medium-green-title">Successfully Created!</span>
            <span class="green-description">You have successfully created the quiz</span>
        </div>
        <a href="manage_quiz.php" class="green-button">Back</a>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/overlay.js"></script>
    <script src="../../scripts/quiz.js"></script>
</body>
</html>