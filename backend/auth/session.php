<?php
session_start();
require_once __DIR__ . "/../conn.php";
require_once __DIR__ . "/../user/streak.php";

// reject when !session AND !cookie
if (isset($_SESSION['user_id'])) {
    return;
}

if(!isset($_COOKIE['remember_me'])) {
    header("Location: /aplite/backend/auth/unauthorized.php");
    exit;
}

$token = $_COOKIE['remember_me'];
$hashed = hash('sha256', $token);
$sql = "
    SELECT userID, name, role, streak, lastLogin
    FROM user
    WHERE remember_token=? 
    LIMIT 1
    ";

$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $hashed);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Cookie doesn't match token
if(!$user) {
    header("Location: /aplite/backend/auth/unauthorized.php");
    exit;
}

updateUserStreak($con, $user['userID'], $user['streak'], $user['lastLogin']);

$_SESSION['user_id'] = $user['userID'];
$_SESSION['name'] = $user['name'];
$_SESSION['role'] = $user['role'];

?>