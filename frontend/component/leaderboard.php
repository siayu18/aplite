<?php
include("../../../backend/conn.php");

// For leaderboard
$sql = "SELECT * FROM user ORDER BY points DESC LIMIT 10";
$result = mysqli_query($con, $sql);
$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Outfit:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sixtyfour&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/component.css">
</head>

<body>
    <span class="green-title">Leaderboard</span>
    <div class="leaderboard-container">
        <?php $rank = 1;
        foreach ($users as $user):?>
            <p class="<?= $rank <= 3 ? '' : 'rank-normal'?>">
                <span class="<?= $rank <= 3 ? 'rank'.$rank : ''?>">#<?= $rank ?></span>
                <span><?= htmlspecialchars($user['name']) ?></span>
                <span class="points"><?= htmlspecialchars($user['points']) ?> Points</span>
            </p>
        <?php $rank++;
        endforeach; ?>
        <a href="../leaderboard/leaderboard.php" class="green-button" style="margin-top: 1rem;">View Full Leaderboard</a>
    </div>
</body>
</html>