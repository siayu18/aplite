<?php
require_once "session.php";

if ($_SESSION['role'] !== 'admin') {
    header("Location: /aplite/backend/auth/unauthorized.php");
    exit;
}
?>