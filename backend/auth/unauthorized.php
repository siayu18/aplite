<?php
session_start();

if(isset($_SESSION['role'])) {
    switch ($_SESSION['role']) { 
        case 'Admin': 
            $dashboard = "../../frontend/pages/dashboard/admin_dashboard.php";
            break;
        case 'Staff':
            $dashboard = "../../frontend/pages/dashboard/staff_dashboard.php";
            break;
        default:
            $dashboard = "../../frontend/pages/dashboard/dashboard.php";
            break;
    } 
} else {
        session_destroy();
        header("Location: ../../frontend/pages/login/login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
</head>
<body>
   <h1>403 - Access Denied</h1> 
   <p>You do not have permission to access this page.</p>
   <br>
   <a href="<?= htmlspecialchars($dashboard) ?>">Go back</a>
</body>
</html>