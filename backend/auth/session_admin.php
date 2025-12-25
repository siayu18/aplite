<?php
require_once "session.php";

if ($_SESSION['role'] !== 'admin') {
    header("Location: unauthorized.php");
    exit;
}
?>