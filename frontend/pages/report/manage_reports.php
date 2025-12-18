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
    <link rel="stylesheet" href="../../styles/report.css">
    <title>Manage Reports</title>
</head>

<body>
    <?php include '../../component/admin_header.php'; ?>
    <div class=" col-12 col-s-12 content-mid fade-in">
        <div class="reports-page-container">
                <div class="header-text">
                    <span class="dark-green-description">Broken Light Reports</span>
                    <span class="green-description">Track and manage reports of malfunctioning lights<span>
                </div>

            <div class="report-count">
                <div class="report-count-card" style="background-color: var(--transparent-green); border: 0.1rem solid var(--border-green);">
                    <div class="report-card-text">
                        <img src="../../image/warning_small.svg" alt="warn_small" class="report-card-img">
                        <span class="green-description">Total Reports</span>
                    </div>
                    <span class="green-description">4</span>
                </div>

                <div class="report-count-card" style="background-color: var(--pending-orange-background); border: 0.1rem solid var(--pending-orange-border);">
                    <div class="report-card-text">
                        <img src="../../image/timer.svg" alt="timer" class="report-card-img">
                        <span class="orange-description">Pending</span>
                    </div>
                    <span class="orange-description">1</span>
                </div>

                <div class="report-count-card" style="background-color: var(--approved-green-background); border: 0.1rem solid var(--approved-green-border);">
                    <div class="report-card-text">
                        <img src="../../image/tick.svg" alt="tick" class="report-card-img">
                        <span class="dark-green-description">Approved</span>
                    </div>
                    <span class="dark-green-description">2</span>
                </div>

                <div class="report-count-card" style="background-color: var(--rejected-red-background); border: 0.1rem solid var(--rejected-red-border);">
                    <div class="report-card-text">
                        <img src="../../image/rejected.svg" alt="rejected" class="report-card-img">
                        <span class="red-description">Rejected</span>
                    </div>
                    <span class="red-description">1</span>
                </div>
            </div>

            <div class="filterbar">
                <div class="label-field">
                    <label class="green-description">Filter By Room</label>
                    <select class="dropdown-classroom-choice" name="classroom">
                        <option value="All Rooms">All Rooms</option>
                    </select>
                </div>

                <div class="label-field">
                    <label class="green-description">Fitler By Status</label>
                    <select class="dropdown-classroom-choice" name="status">
                        <option value="Status">All Status</option>
                    </select>
                </div>
            </div>

            <div class="report-content">
                <div class="report-content-card">
                    <img src="../../image/flickering_light.webp" alt="lights-img" class="">
                    <div class="report-text-group">
                        <div class="title-and-icon">
                            <span class="dark-green-description report-title">Flickering light causing distraction</span>
                            <div class="card-icon">
                                <div class="card-icon-img-apro" style="background-color: var(--approved-green-background); border: 0.1rem solid var(--approved-green-border);">
                                    <img src="../../image/tick.svg" alt="tick" class="report-card-img">
                                </div>
                            </div>
                        </div>

                        <div class="location-text">
                            <img src="../../image/location.svg" alt="location" class="report-card-img">
                            <span class="green-description">Lecture Hall LH2</span>
                        </div>

                        <span class="green-description report-desc">One of the main lights keeps flickering during lectures. 
                            It is very distracting and may be a safety hazard.
                        </span>

                        <div class="sender-info">
                            <span class="green-description">By: John Smith</span>
                            <span class="green-description">2025-01-18</span>
                        </div>

                        <button type="submit" class="green-button" name="viewDetails">View Details</button>
                    </div>
                </div>

                <div class="report-content-card">
                    <img src="../../image/flickering_light.webp" alt="lights-img" class="">
                    <div class="report-text-group">
                        <div class="title-and-icon">
                            <span class="dark-green-description">Flickering light causing distraction</span>
                            <div class="card-icon">
                                <div class="card-icon-img" style="background-color: var(--approved-green-background); border: 0.1rem solid var(--approved-green-border);">
                                    <img src="../../image/tick.svg" alt="tick" class="report-card-img">
                                </div>
                            </div>
                        </div>

                        <div class="location-text">
                            <img src="../../image/location.svg" alt="location" class="report-card-img">
                            <span class="green-description">Lecture Hall LH2</span>
                        </div>

                        <span class="green-description" style="text-align: justify">One of the main lights keeps flickering during lectures. 
                            It is very distracting and may be a safety hazard.
                        </span>

                        <div class="sender-info">
                            <span class="green-description">By: John Smith</span>
                            <span class="green-description">2025-01-18</span>
                        </div>

                        <button type="submit" class="green-button" name="viewDetails">View Details</button>
                    </div>
                </div>

                <div class="report-content-card">
                    <img src="../../image/flickering_light.webp" alt="lights-img" class="">
                    <div class="report-text-group">
                        <div class="title-and-icon">
                            <span class="dark-green-description">Flickering light causing distraction</span>
                            <div class="card-icon">
                                <div class="card-icon-img" style="background-color: var(--approved-green-background); border: 0.1rem solid var(--approved-green-border);">
                                    <img src="../../image/tick.svg" alt="tick" class="report-card-img">
                                </div>
                            </div>
                        </div>

                        <div class="location-text">
                            <img src="../../image/location.svg" alt="location" class="report-card-img">
                            <span class="green-description">Lecture Hall LH2</span>
                        </div>

                        <span class="green-description" style="text-align: justify">One of the main lights keeps flickering during lectures. 
                            It is very distracting and may be a safety hazard.
                        </span>

                        <div class="sender-info">
                            <span class="green-description">By: John Smith</span>
                            <span class="green-description">2025-01-18</span>
                        </div>

                        <button type="submit" class="green-button" name="viewDetails">View Details</button>
                    </div>
                </div>

                <div class="report-content-card">
                    <img src="../../image/flickering_light.webp" alt="lights-img" class="">
                    <div class="report-text-group">
                        <div class="title-and-icon">
                            <span class="dark-green-description">Flickering light causing distraction</span>
                            <div class="card-icon">
                                <div class="card-icon-img" style="background-color: var(--approved-green-background); border: 0.1rem solid var(--approved-green-border);">
                                    <img src="../../image/tick.svg" alt="tick" class="report-card-img">
                                </div>
                            </div>
                        </div>

                        <div class="location-text">
                            <img src="../../image/location.svg" alt="location" class="report-card-img">
                            <span class="green-description">Lecture Hall LH2</span>
                        </div>

                        <span class="green-description" style="text-align: justify">One of the main lights keeps flickering during lectures. 
                            It is very distracting and may be a safety hazard.
                        </span>

                        <div class="sender-info">
                            <span class="green-description">By: John Smith</span>
                            <span class="green-description">2025-01-18</span>
                        </div>

                        <button type="submit" class="green-button" name="viewDetails">View Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>