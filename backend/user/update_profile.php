<?php
session_start();
require_once "../conn.php";

$userId = $_SESSION['user_id'];

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if($name === '' || $email === '') {
    header("Location: ../../frontend/pages/account_management/profile.php?error=missing_fields");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../../frontend/pages/account_management/profile.php?error=invalid_email");
    exit;
}

if ($password !== '') {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE user SET name = ?, email=?, password=? WHERE userID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $hashedPassword, $userId);
} else {
    $sql = "UPDATE user SET name=?, email=? WHERE userID=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssi", $name, $email, $userId);
}

$stmt->execute();
$stmt->close();

header("Location: ../../frontend/pages/account_management/profile.php?success=1");
exit;
?>