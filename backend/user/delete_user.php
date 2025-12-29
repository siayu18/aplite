<?php
require_once __DIR__ . "/../conn.php";

function deleteUser($con, $userID) {
    if (empty($userID) || !ctype_digit($userID)) {
        return ["Invalid user ID."];
    }

    $check = mysqli_query($con, "SELECT userID FROM user WHERE userID = $userID LIMIT 1");

    if (!$check || mysqli_num_rows($check) === 0) {
        return ["User not found."];
    }

    $delete = mysqli_query($con, "DELETE FROM user WHERE userID = $userID");

    if ($delete) {
        return true;
    }

    return ["Failed to delete user."];
}
