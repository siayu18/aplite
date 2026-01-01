<?php
function getValidationError($con, $email, $password, $userId = null) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "invalid_email";
    }

    $stmt = $con->prepare("SELECT userID FROM user WHERE email = ? AND userID != ?");
    $ignoreId = $userId ?? 0; 
    $stmt->bind_param("si", $email, $ignoreId);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        return "email_exists";
    }

    if ($password !== '') {
        $hasUpper = preg_match('/[A-Z]/', $password);
        $hasNumber = preg_match('/\d/', $password);
        $hasSpecial = preg_match('/[\W_]/', $password);
        $isLongEnough = strlen($password) >= 8;

        if (!$isLongEnough || !$hasUpper || !$hasNumber || !$hasSpecial) {
            return "weak_password";
        }
    }

    return null; 
}
?>