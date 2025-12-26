<?php
// Used for linking profile management with correct headers

$role = $_SESSION['role'] ?? '';

switch($role) {
    case 'admin':
        include __DIR__ . "/admin_header.php";
        break;

    case 'staff':
        include __DIR__ . "/staff_header.php";
        break;
    
    default:
        include __DIR__ . "/stu_header.php";
        break;
}

?>