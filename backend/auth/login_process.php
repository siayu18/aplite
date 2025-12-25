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

// Update streak & lastLogin
date_default_timezone_set('Asia/Kuala_Lumpur');
$currentDate = new DateTime();
$lastLoginDate = new DateTime($user['lastLogin']);
$diffDays = (int)$lastLoginDate->diff($currentDate)->format('%a');

if ($diffDays === 0) {
    $streak = $user['streak']; 
} elseif ($diffDays === 1) {
    $streak = $user['streak'] + 1;
} else {
    $streak = 1;
}

$updatesql = "
    UDATE user 
    SET lastLogin = NOW(), streak = ?
    WHERE userID = ?
    ";
$updateStmt = $con->prepare($updatesql);
$updateStmt->bind_param('ii', $streak, $user['userID']);
$updateStmt->execute();

// starting a session after verification
session_start();

$_SESSION['user_id'] = $user['userID'];
$_SESSION['name'] = $user['name'];
$_SESSION['role'] = $user['role'];

// remember me with hashed tokens
if(isset($_POST['remember'])) {

    $token = bin2hex(random_bytes(32));
    $hashedToken = hash('sha256', $token);

    $sql = "
        UPDATE user
        SET rememberToken = ?
        WHERE userID = ?
    ";

    $stmt_update = $con->prepare($sql);
    $stmt_update->bind_param('si', $hashedToken, $user['userID']);
    $stmt_update->execute();

    // cookie expires in 30 days
    setcookie(
        "remember_me",
        $token,
        time() + (86400 * 30),
        "/",
        "",
        false,
        true
    );
}

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