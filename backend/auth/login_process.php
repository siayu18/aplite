<?php
$_identifier = $_POST['identifier'] ?? '';

if ($_identifier == '') {
    echo "Please enter email or username";
    exit;
}

require_once "../conn.php";

$sql = "
    SELECT userID, name, email, password, role
    FROM user
    WHERE email = ? OR name = ?
    LIMIT 1
";

// prevents SQL injection by forcing user inputs as strings
$stmt = $con->prepare($sql);
$stmt->bind_param('ss', $_identifier, $_identifier); 
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found";
    exit;
}

// Validate Password (pwd data is hashed from database)
$inputPassword = $_POST['password'] ?? '';

if(!password_verify($inputPassword, $user['password'])) {
    echo "Incorrect password";
    exit;
} 

// starting a session after verification
session_start();

$_SESSION['user_id'] = $user['userID'];
$_SESSION['name'] = $user['name'];
$_SESSION['role'] = $user['role'];

switch ($user['role']) {
    case 'admin':
        header("Location: ../../frontend/pages/dashboard/admin_dashboard.php");
        break;
    case 'staff':
        header("Location: ../../frontend/pages/dashboard/staff_dashboard.php");
        break;
    default:
        header("Location: ../../frontend/pages/dashboard/dashboard.php");
        break;
}

exit;
?>