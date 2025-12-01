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
    <link rel="stylesheet" href="../../styles/article.css">
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
            <form method="POST" action="edit_quiz.php" class="inner-container">
                <div class="medium-green-title" id="title">Edit Quiz</div>

                <div class="label-field">
                    <label class="green-description">Title</label>
                    <input type="text" placeholder="Enter title..." />
                </div>

                <div class="field-group">
                    <div class="label-field">
                        <label class="green-description">Points Awarded</label>
                        <input type="text" placeholder="Enter Points..." />
                    </div>
                    <div class="label-field">
                        <label class="green-description">Correct For Points</label>
                        <input type="text" placeholder="Enter Points..." />
                    </div>
                </div>

                <div class="right-button-group" style="margin: 1rem 0;">
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
                    <button type="submit" class="green-button">Update Quiz</button>
                </div>
            </form>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/quiz.js"></script>
</body>
</html>