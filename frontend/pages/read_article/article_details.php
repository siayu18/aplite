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
    <link rel="stylesheet" href="../../styles/article.css">
    <title>Read Articles</title>
</head>
<body>
    <?php include '../../component/stuHeader.php'; ?>
    <div class=" col-12 col-s-12 content fade-in">
        <div class="main-container">
            <div class="back-wrapper">
                <a href="">
                    <div class="interactive-icon-text">
                        <img src="../../image/back.svg" alt="Back" class="icon-img" />
                        <span class="icon-text">Back to Articles</span>
                    </div>
                </a>
            </div>
            <div class="article-container">
                <img src="../../image/test_image.png" alt="Article Image" class="article-img" />
                <div class="article-details">
                    <div class="medium-green-title">The Impact of LED Lighting on Campus Energy Consumption</div>
                    <div class="metadata">
                        <div class="green-description">By Dr. Sarah Green | Published on 2025-01-05</div>
                        <div class="points-container">
                            <img src="../../image/badge.png" alt="Points Badge" class="" />
                            <span class="points-text">30 pts</span>
                        </div>
                    </div>
                    <p class="article-content">
                        Efficient energy management has become a major priority for educational institutions as they work toward reducing operating costs and promoting environmental sustainability. One of the most effective strategies campuses have adopted is the transition from traditional lighting systems—such as fluorescent and incandescent bulbs—to Light Emitting Diode (LED) technology. The shift to LED lighting has significantly influenced energy consumption patterns across universities, colleges, and schools.
                        LED lighting is widely known for its superior energy efficiency. Compared to conventional lighting, LEDs consume up to 50–80% less electricity, depending on the fixture and application. This reduction is especially impactful on large campuses where lighting accounts for a major share of energy use, including classrooms, lecture halls, laboratories, hallways, sports facilities, and outdoor spaces.
                        LED bulbs have a significantly longer lifespan, often lasting 25,000–50,000 hours compared to the 1,000–10,000 hours offered by incandescent or fluorescent lights. This longevity means fewer replacements, reducing both maintenance labor and material costs. For campuses with extensive lighting networks, the savings are substantial.
                    </p>
                    <div class="claim-container">
                        <img src="../../image/big_badge.svg" alt="Points Badge" class="" />
                        <div class="text-group">
                            <span class="medium-green-title">Great job reading this article!</span>
                            <span class="green-description">Claim your 30 points for expanding your sustainability knowledge.</span>
                        </div>
                        <button class="green-button">Claim 30 Points</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>