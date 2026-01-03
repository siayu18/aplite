<?php
require_once __DIR__ . "/../conn.php";
require_once __DIR__ . "/validation.php";

function updateUser($con, $userID, $name, $email, $password, $role) {
    if (empty($name) || empty($email) || empty($role)) {
        return "missing_fields";
    }

    $validationError = getValidationError($con, $email, $password, $userID);
    
    if ($validationError) {
        return $validationError;
    }

    if ($password !== "") {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET name=?, email=?, password=?, role=? WHERE userID=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssi", $name, $email, $hashed, $role, $userID);
    } else {
        $sql = "UPDATE user SET name=?, email=?, role=? WHERE userID=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssi", $name, $email, $role, $userID);
    }

    if ($stmt->execute()) {
        return true;
    }
    
    return "db_error";
}
?>
