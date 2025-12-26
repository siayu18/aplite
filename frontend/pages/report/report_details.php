<?php
require_once "../../../backend/auth/session_student.php";
include ('../../../backend/conn.php');
include ('../../../backend/fetch_data.php');

// Get brID from URL
if (!isset($_GET['id'])) {
    die('No report selected.');
}

$brID = $_GET['id'];
$report = getReportByID($brID);

if (!$report) {
    die('Report not found.');
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
    <link rel="stylesheet" href="../../styles/report.css">
    <title>Report Details</title>
</head>

<body>
    <?php include '../../component/stu_header.php'; ?>
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

            <div class="inner-container">
                <img src="../../image/report.svg" alt="report" class="card-img">
                <div class="text-group">
                    <span class="medium-green-title">Review Broken Light Report</span>
                    <div class="
                        <?php
                            if ($report['status'] === 'approved') echo 'status-report-apro';
                            elseif ($report['status'] === 'rejected') echo 'status-report-rej';
                            else echo 'status-report-pen';
                        ?>">
                        <?php
                            $statusClass = '';
                            if ($report['status'] === 'approved') $statusClass = 'green-description';
                            elseif ($report['status'] === 'rejected') $statusClass = 'red-description';
                            else $statusClass = 'orange-description';
                        ?>
                        <span class="<?= $statusClass ?>"><?= ucfirst($report['status']) ?></span>
                    </div>
                </div>

                <div class="image-container">
                    <img src="data:image/jpeg;base64,<?= base64_encode($report['evidence']) ?>" alt="lights-img" class="container_image">
                </div>

                <div class="report-info">
                    <span class="dark-green-description">Report Information</span>

                    <div class="report-info-text">
                        <span class="green-description">Report Title</span>
                        <span class="dark-green-description"><?= htmlspecialchars($report['title']) ?></span>
                    </div>

                    <div class="report-info-text">
                        <div class="location-text">
                            <img src="../../image/location.svg" alt="location" class="report-card-img">
                            <span class="green-description">Location</span>
                        </div>
                        <span class="dark-green-description"><?= htmlspecialchars($report['roomName']) ?></span>
                    </div>

                    <div class="report-info-text">
                        <span class="green-description">Description</span>
                        <span class="dark-green-description"><?= nl2br(htmlspecialchars($report['description'])) ?></span>
                    </div>

                    <div class="thin-line"></div>

                    <div class="report-info-footer">
                        <div class="report-info-text">
                            <span class="green-description">Reported By</span>
                            <span class="dark-green-description"><?= htmlspecialchars($report['name']) ?></span>
                            <span class="green-description"><?= htmlspecialchars($report['studentID']) ?></span>
                        </div>

                        <div class="report-info-text">
                            <span class="green-description">Date Submitted</span>
                            <span class="dark-green-description"><?= date("Y-m-d", strtotime($report['date'])) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
</body>
</html>