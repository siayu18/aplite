<?php
function updateUserStreak($con, $userId, $currentStreak, $lastLogin) {
    date_default_timezone_set('Asia/Kuala_Lumpur');
    
    $today = new DateTime();
    $today->setTime(0, 0, 0);

    $lastDate = new DateTime($lastLogin);
    $lastDate->setTime(0, 0, 0);

    $diff = $lastDate->diff($today)->days;

    if ($diff === 0) {
        return $currentStreak; 
    } 
    
    $newStreak = ($diff === 1) ? $currentStreak + 1 : 1;

    $stmt = $con->prepare("UPDATE user SET lastLogin = NOW(), streak = ? WHERE userID = ?");
    $stmt->bind_param('ii', $newStreak, $userId);
    $stmt->execute();

    return $newStreak;
}