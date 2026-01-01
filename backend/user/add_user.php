<?php
require_once __DIR__ . "/../conn.php";
require_once __DIR__ . "/validation.php";

function addUser($con, $name, $email, $password, $role) {
    if (empty($name) || empty($email) || empty($password) || empty($role)) {
        return "missing_fields";
    }

    $validationError = getValidationError($con, $email, $password);
    
    if ($validationError) {
        return $validationError;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    
    if (!$stmt) {
        return "db_error";
    }

    $stmt->bind_param("ssss", $name, $email, $hash, $role);

    if ($stmt->execute()) {
        return true;
    } else {
        return "failed_to_create";
    }
}
?>