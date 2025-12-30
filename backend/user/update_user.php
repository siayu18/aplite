<?php
require_once __DIR__ . "/../conn.php";

function updateUser($con, $userID, $name, $email, $password, $role) {

    if ($name === "" || $email === "" || $role === "") {
        return "Missing required fields";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format";
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
    return $stmt->error;
}
