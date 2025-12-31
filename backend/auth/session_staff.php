<?php
require_once "session.php";

if($_SESSION['role'] !== 'Staff') {
    header("Location: /aplite/backend/auth/unauthorized.php");
    exit;
}
?>