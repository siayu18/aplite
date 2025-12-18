<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Outfit:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Sixtyfour&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/component.css">
</head>

<body>
    <div class="menu">
        <a class="menu-text" href="../dashboard/admin_dashboard.php">Home</a>
        <a class="menu-text" href="#">Manage Users</a>
        <a class="menu-text" href="../announcement/manage_announcement.php">Manage Announcements</a>
        <a class="menu-text" href="#">Manage Redemptions</a>
        <a class="menu-text" href="#">Manage Rewards</a>
        <a class="menu-text" href="#">Generate Report</a>

        <a href="../account_management/profile.php"><img src="../../image/profile.png" alt="Profile" class="menu-img" /></a>
        <button id="more-button"><img src="../../image/more.svg" alt="More" class="menu-img" /></button>
        <div id="dropdown-menu" class="dropdown-content">
            <a href="../dashboard/admin_dashboard.php">Home</a>
            <a href="#">Manage Users</a>
            <a href="../announcement/manage_announcement.php">Manage Announcements</a>
            <a class="#" href="#">Manage Redemptions</a>
            <a href="#">Manage Rewards</a>
            <a href="#">Generate Report</a>
        </div>
    </div>  
</body>
</html>