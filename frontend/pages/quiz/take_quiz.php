<?php
session_start();
include ('../../../backend/conn.php');
include ('../../../backend/fetch_data.php');

if (!isset($_GET['id'])) {
    echo "<script>alert('Quiz ID not specified'); window.location.href='choose_quiz.php';</script>";
}

$quizID = $_GET['id'];

$quiz = getDataByID("quiz", "quizID", $quizID);
$questions = getAllByID("question", "quizID", $quizID);
if (!$questions) {
    echo "<script>alert('No Question Found'); window.location.href='choose_quiz.php';</script>";
}

$_SESSION['quiz'] = [
    'quizID' => $quizID,
    'title' => $quiz['title'],
    'correctForPoints' => $quiz['correctForPoints'],
    'pointsAwarded' => $quiz['pointsAwarded'],
    'questions' => $questions,
    'answers' => [],
    'current' => 0,
    'score' => 0
];

header("Location: quiz_question.php");
exit;
?>