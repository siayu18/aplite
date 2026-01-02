<?php
session_start();
require_once __DIR__ . "/../conn.php";
require_once __DIR__ . "/../user/streak.php"; 

if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
    $token = $_COOKIE['remember_me'];
    $hashed = hash('sha256', $token);
    
    $sql = "SELECT userID, name, role, streak, lastLogin FROM user WHERE rememberToken=? LIMIT 1";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $hashed);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user) {
        $_SESSION['user_id'] = $user['userID'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        updateUserStreak($con, $user['userID'], $user['streak'], $user['lastLogin']);
    }
}

if (!isset($_SESSION['user_id'])) {
    header("Location: /aplite/backend/auth/unauthorized.php");
    exit;
}

$today = date('Y-m-d');
if (!isset($_SESSION['last_check']) || $_SESSION['last_check'] !== $today) {
    
    $stmt = $con->prepare("SELECT streak, lastLogin FROM user WHERE userID = ?");
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();

    updateUserStreak($con, $_SESSION['user_id'], $data['streak'], $data['lastLogin']);
    
    $_SESSION['last_check'] = $today;
}