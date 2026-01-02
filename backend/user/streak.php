<?php
function updateUserStreak($con, $userId, $currentStreak, $lastLogin) {
    date_default_timezone_set('Asia/Kuala_Lumpur');
    
    $today = new DateTime();
    $today->setTime(0, 0, 0);

    $lastDate = new DateTime($lastLogin);
    $lastDate->setTime(0, 0, 0);

    $diff = (int)$lastDate->diff($today)->format("%a");

    if ($diff === 0) {
        $newStreak = $currentStreak; 
    } elseif ($diff === 1) {
        $newStreak = $currentStreak + 1; 
    } else {
        $newStreak = 1; 
    }

    $stmt = $con->prepare("UPDATE user SET lastLogin = NOW(), streak = ? WHERE userID = ?");
    $stmt->bind_param('ii', $newStreak, $userId);
    
    if (!$stmt->execute()) {
        error_log("Streak update failed: " . $stmt->error);
    }

    return $newStreak;
}