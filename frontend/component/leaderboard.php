<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Outfit:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sixtyfour&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
</head>

<body>
    <span class="green-title">Leaderboard</span>
    <div class="leaderboard-container">
        <?php $rank = 1;
        foreach ($users as $user):?>
            <p>
                <span class="<?= $rank <= 3 ? 'rank'.$rank : ''?>">#<?= $rank ?></span>
                <?= htmlspecialchars($user['name']) ?> - <?= htmlspecialchars($user['points']) ?> Points
            </p>
        <?php $rank++;
        endforeach; ?>
    </div>
</body>
</html>