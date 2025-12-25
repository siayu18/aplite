<?php
require_once "session.php";

if (!in_array($_SESSION['role'], ['student', 'lecturer'])) {
    header("Location: /aplite/backend/auth/unauthorized.php");
    exit;
}
?>