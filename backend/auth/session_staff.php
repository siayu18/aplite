<?php
require_once "session.php";

if(!in_array($_SESSION['role'], ['staff', 'admin'])) {
    header("Location: ../../../backend/auth/unauthorized.php");
    exit;
}
?>