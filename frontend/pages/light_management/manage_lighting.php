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
    <title>Set Lighting</title>
</head>
<body>
    <?php include '../../component/stu_header.php'; ?>
    <div class=" col-12 col-s-12 content-mid fade-in">
        <div class="control-panel-container">
            <img src="../../image/lightbulb.svg" alt="lightbulb" class="card-img">
            <div class="text-group">
                <span class="medium-green-title">Classroom A101</span>
                <span class="green-description">
                    <img src="../../image/clock_icon.svg" alt="clock" class="clock-img">
                    Checked in at 9:45:24 PM
                </span>
            </div>

            <form method="POST" action="manage_lighting.php" class="content-group">
                <div class="slider-container">
                    <label class="green-description">Current Brightness Level</label>
                    
                    <span class="dark-green-description">70%</span>
                    
                    <input type="range" 
                        min="0" max="100" 
                        value="70" 
                        class="brightness-slider" 
                        id="lightRange"
                        oninput="updateText(this.value)"
                        onchange="updateDatabase(this.value)">
                </div>

                <div class="energy-details">
                    <div class="class-details">
                        <img src="../../image/small_bulb.svg" alt="lightbulb-small" class="small-img">
                        <span class="green-description">Brightness</span>
                        <span class="dark-green-description">70%<span>
                    </div>

                    <div class="class-details">
                        <img src="../../image/lightning.svg" alt="lightning-small" class="small-img">
                        <span class="green-description">Energy Saved</span>
                        <span class="dark-green-description">30%<span>
                    </div>

                    <div class="class-details">
                        <img src="../../image/points.svg" alt="points" class="small-img">
                        <span class="green-description">Points Potential</span>
                        <span class="dark-green-description">Low<span>
                    </div>
                </div>

                <div class="class-details">
                    <span class="green-description-bold">Tip:</span>
                    <span class="green-description" style="text-align: justify;">
                        Lower brightness levels save more energy and earn you more points! 
                        Adjust to a comfortable level that's not too bright.
                    </span>
                </div>
                <button class="orange-button">
                    <img src="../../image/check_out_icon.svg" alt="checkout" class="button-img">
                    <span>Check out Classroom<span>
                </button>
            </form>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>