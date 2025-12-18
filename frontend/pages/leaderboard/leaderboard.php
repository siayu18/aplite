<?php
include("../../../backend/conn.php");

// For leaderboard
$sql = "SELECT * FROM user ORDER BY points DESC LIMIT 50";
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
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/component.css">
    <link rel="stylesheet" href="../../styles/leaderboard.css">
    <title>Leaderboard</title>
</head>
<body>
    <?php include '../../component/stu_header.php'; ?>
    <div class="col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Leaderboard</span>
            <span class="green-description">Compete with your peers and climb the ranks by earning points through sustainable actions</span>
        </div>
        <div class="stage-container">
            <div class="no2-stage">
                <img src="../../image/second_place.svg" alt="Silver" />
                <span class="place">2nd</span>
                <span class="name"><?= htmlspecialchars($users[1]['name']) ?></span>
                <span class="stage-points"><?= htmlspecialchars($users[1]['points']) ?> Points</span>
            </div>
            <div class="no1-stage">
                <img src="../../image/first_place.svg" alt="Champion" />
                <span class="place">1st</span>
                <span class="name"><?= htmlspecialchars($users[0]['name']) ?></span>
                <span class="stage-points"><?= htmlspecialchars($users[0]['points']) ?> Points</span>
            </div>

            <div class="mobile-wrap">
                <div class="no2-stage-mobile"">
                    <img src="../../image/second_place.svg" alt="Silver" />
                    <span class="place">2nd</span>
                    <span class="name"><?= htmlspecialchars($users[1]['name']) ?></span>
                    <span class="stage-points"><?= htmlspecialchars($users[1]['points']) ?> Points</span>
                </div>
                <div class="no3-stage">
                    <img src="../../image/third_place.svg" alt="Bronze" />
                    <span class="place">3rd</span>
                    <span class="stage-name"><?= htmlspecialchars($users[2]['name']) ?></span>
                    <span class="stage-points"><?= htmlspecialchars($users[2]['points']) ?> Points</span>
                </div>
            </div>
        </div>
        <div class="leaderboard">
            <div class="leaderboard-heading">
                <span>Top 50 Ranking</span>
            </div>
            <?php $rank = 1;
            foreach ($users as $user):

                $class = '';
                if ($rank == 1) {
                    $class = 'first';
                } elseif ($rank == 2) {
                    $class = 'second';
                } elseif ($rank == 3) {
                    $class = 'third';
                } elseif ($rank == count($users)) {
                    $class = 'last';
                }
            ?>
                <div class="leaderboard-row <?= $class ?>">
                    <div class="rank-name">
                        <span class="rank">#<?= $rank ?></span>
                        <span><?= htmlspecialchars($user['name']) ?></span>
                    </div>
                    <span><?= htmlspecialchars($user['points']) ?> pts</span>
                </div>
            <?php $rank++;
            endforeach; ?>
        </div>
    </div>

    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>
