<?php
require_once "session.php";

if(!in_array($_SESSION['role'], ['Staff', 'Admin'])) {
    header("Location: /aplite/backend/auth/unauthorized.php");
    exit;
}
?>