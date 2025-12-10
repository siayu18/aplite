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
    <link rel="stylesheet" href="../../styles/control_light.css">
    <title>Manage Lighting</title>
</head>

<body>
    <?php include '../../component/stu_header.php'; ?>
    <div class=" col-12 col-s-12 content-mid fade-in">
        <div class="control-panel-container">
            <img src="../../image/lightbulb.svg" alt="lightbulb" class="card-img">
            <div class="text-group">
                <span class="medium-green-title">Light Control System</span>
                <span class="green-description">Select a classroom and check-in to control the lighting</span>
            </div>

            <form method="POST" action="control_lights.php" class="content-group">
                <div class="label-field">
                    <label class="green-description">Select Classroom</label>
                    <select class="dropdown-classroom-choice" name="classroom" required></select>
                </div>

                <div class="class-details">
                    <span class="medium-green-title">Room Details</span>
                    <div class="detail-row">
                        <span class="green-description-bold">Room:</span>
                        <span class="green-description">Classroom A101</span>
                    </div>

                    <div class="detail-row">
                        <span class="green-description-bold">Building:</span>
                        <span class="green-description">Academic Building A</span>
                    </div>

                    <div class="detail-row">
                        <span class="green-description-bold">Floor:</span>
                        <span class="green-description">1</span>
                    </div>
                </div>

                <button class="green-button">
                    <img src="../../image/check_in_icon.svg" alt="checkin" class="button-img">
                    <span>Check into Classoom<span>
                </button>
            </form>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>