<?php
session_start();

$_SESSION = array();
session_destroy();

if (isset($_COOKIE['remember_me'])) {
    setcookie("remember_me", "", time() - 3600, "/", "", false, true);
}

require_once "../conn.php";

if (isset($_COOKIE['remember_me'])) {
    $token = $_COOKIE['remember_me'];
    $hashedToken = hash("sha256", $token);

    $sql = "
        UPDATE user
        SET rememberToken = NULL
        WHERE rememberToken = ? 
    ";

    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $hashedToken);
    $stmt->execute();
}

header("Location: /aplite/frontend/pages/login/login.php?logout=success");
exit;
?>