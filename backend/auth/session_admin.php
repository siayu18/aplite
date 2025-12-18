<?php
require_once "session.php";

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../frontend/pages/login/login.php");
    exit;
}
?>