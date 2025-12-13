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
    <title>Approve Reports</title>
</head>

<body>
    <?php include '../../component/admin_header.php'; ?>
    <div class=" col-12 col-s-12 content-mid fade-in">
        <div class="main-container">
            <div class="back-wrapper">
                <a href="reports_page.php">
                    <div class="interactive-icon-text">
                        <img src="../../image/back.svg" alt="Back" class="icon-img" />
                        <span class="icon-text">Back to Reports</span>
                    </div>
                </a>
            </div>

            <form method="POST" action="submit_report.php" enctype="multipart/form-data" class="inner-container">
                <img src="../../image/report.svg" alt="report" class="card-img">
                <div class="text-group">
                    <span class="medium-green-title">Review Broken Light Report</span>
                    <div class="status-report">
                        <span class="orange-description">Pending</span>
                    </div>
                </div>

                <div class="image-container">
                    <img src="../../image/flickering_light.webp" alt="lights-img" class="container_image">
                </div>

                <div class="report-info">
                    <span class="dark-green-description">Report Information</span>

                    <div class="report-info-text">
                        <span class="green-description">Report Title</span>
                        <span class="dark-green-description">Flickering light causing distraction</span>
                    </div>

                    <div class="report-info-text">
                        <div class="location-text">
                            <img src="../../image/location.svg" alt="location" class="report-card-img">
                            <span class="green-description">Location</span>
                        </div>
                        <span class="dark-green-description">Lecture Hall LH2</span>
                    </div>

                    <div class="report-info-text">
                        <span class="green-description">Description</span>
                        <span class="dark-green-description">One of the main lights keeps flickering during lectures. 
                            It is very distracting and may be a safety hazard.
                        </span>
                    </div>

                    <div class="thin-line"></div>

                    <div class="report-info-footer">
                        <div class="report-info-text">
                            <span class="green-description">Reported By</span>
                            <span class="dark-green-description">John Smith</span>
                            <span class="green-description">TP123457</span>
                        </div>

                        <div class="report-info-text">
                            <span class="green-description">Date Submitted</span>
                            <span class="dark-green-description">2025-01-19</span>
                        </div>
                    </div>
                </div>

                <div class="response-container">
                    <span class="dark-green-description">Your Response</span>

                    <div class="response-text">
                        <span class="green-description-bold" style="font-style: italic;">Admin Notes / Action Taken:</span>
                        <span class="green-description">Provide details about the action to be taken or reason for rejection</span>
                    </div>

                    <textarea class="white-area" placeholder="e.g., Maintenance scheduled for tomorrow morning. Electrician has been contacted." 
                    name="content" required></textarea>
                </div>

                <div class="report-info">
                    <span class="green-description-bold">Tip:</span>
                    <span class="green-description">
                        When you approve a report, the maintenance team will be notified and the student will receive a confirmation. 
                        If you reject a report, please provide a clear explanation so the student understands the decision.
                    </span>
                </div>
                
                <div class="thin-line"></div>

                <div class="right-button-group">
                    <a href="manage_reports.php" class="white-button">Cancel</a>
                    <button class="red-button">
                        <img src="../../image/white_reject.svg" alt="reject" class="button-img">
                        Reject Report
                    </button>
                    <button type="submit" class="green-button" name="submitBtn">
                        <img src="../../image/approve_submit.svg" alt="approve" class="button-img">
                        Approve Report
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>