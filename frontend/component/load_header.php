<?php
// Used for linking profile management with correct headers

$role = $_SESSION['role'] ?? '';

switch($role) {
    case 'Admin':
        include __DIR__ . "/admin_header.php";
        break;

    case 'Staff':
        include __DIR__ . "/staff_header.php";
        break;
    
    default:
        include __DIR__ . "/stu_header.php";
        break;
}

?>