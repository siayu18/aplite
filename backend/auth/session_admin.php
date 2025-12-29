<?php
require_once "session.php";

if ($_SESSION['role'] !== 'Admin') {
    header("Location: /aplite/backend/auth/unauthorized.php");
    exit;
}
?>