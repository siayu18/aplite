<?php
session_start();
require_once "../conn.php";

$userId = $_SESSION['user_id'];

if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
    header("Location: ../../frontend/pages/account_management/profile.php?error=upload_failed");
    exit;
}

$uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/aplite/frontend/image/avatars";

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
$ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));

if (!in_array($ext, $allowed)) {
    header("Location: ../../frontend/pages/account_management/profile.php?error=invalid_type");
    exit;
}

$newFilename = "avatar_" . uniqid() . "." . $ext;

$target = $uploadDir . "/" . $newFilename;

if(!move_uploaded_file($_FILES['avatar']['tmp_name'], $target)) {
    header("Location: ../../frontend/pages/account_management/profile.php?error=move_failed");
}

$sql = "UPDATE user SET picture = ? WHERE userID = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("si", $newFilename, $userId);
$stmt->execute();

header("Location: ../../frontend/pages/account_management/profile.php?sucess=1");
?>