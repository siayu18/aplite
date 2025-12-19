<?php
session_start();

$dashboard = "login.php";

if(isset($_SESSION['role'])) {
    switch ($_SESSION['role']) { 
        case 'admin': 
            $dashboard = "../../frontend/pages/dashboard/admin_dashboard.php";
            break;
    }
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
   <a href="login.php">Go back to login</a>
</body>
</html>