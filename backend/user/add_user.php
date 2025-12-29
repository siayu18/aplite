<?php
require_once __DIR__ . "/../conn.php";

function validatePassword($password) {
    $rules = [
        'Password must be at least 8 characters.' => strlen($password) >= 8,
        'Password must contain an uppercase letter.' => preg_match('/[A-Z]/', $password),
        'Password must contain a number.' => preg_match('/\d/', $password),
        'Password must contain a special character.' => preg_match('/[\W_]/', $password),
    ];

    return array_keys(array_filter($rules, fn($valid) => !$valid));
}

function addUser($con, $name, $email, $password, $role) {
    $errors = [];

    foreach (compact("name", "email", "password", "role") as $field => $value) {
        if (empty($value)) $errors[] = ucfirst($field)." is required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    $exists = mysqli_query($con, "SELECT userID FROM user WHERE email='$email' LIMIT 1");
    if ($exists && mysqli_num_rows($exists) > 0) {
        $errors[] = "Email alreayd exists.";
    }

    $pwErrors = validatePassword($password);
    $errors = array_merge($errors, $pwErrors);

    if (!empty($errors)) return $errors;

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (name, email, password, role)
            VALUES ('$name', '$email', '$hash', '$role')";

    return mysqli_query($con, $sql) ? true : ["Failed to create user."]; 
}
?>