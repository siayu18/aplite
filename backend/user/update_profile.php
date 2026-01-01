<?php
session_start();
require_once "../conn.php";
require_once "validation.php";

$userId = $_SESSION['user_id'];
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($name === '' || $email === '') {
    header("Location: ../../frontend/pages/account_management/profile.php?error=missing_fields");
    exit;
}

$validationError = getValidationError($con, $email, $password, $userId);

if ($validationError) {
    header("Location: ../../frontend/pages/account_management/profile.php?error=" . $validationError);
    exit;
}

if ($password !== '') {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE user SET name = ?, email = ?, password = ? WHERE userID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $hashedPassword, $userId);
} else {
    $sql = "UPDATE user SET name = ?, email = ? WHERE userID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssi", $name, $email, $userId);
}

if ($stmt->execute()) {
    $_SESSION['name'] = $name; 
    header("Location: ../../frontend/pages/account_management/profile.php?success=1");
} else {
    header("Location: ../../frontend/pages/account_management/profile.php?error=db_error");
}

$stmt->close();
exit;