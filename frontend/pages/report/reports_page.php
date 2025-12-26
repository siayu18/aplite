<?php
require_once "../../../backend/auth/session_student.php";
include ('../../../backend/conn.php');
include ('../../../backend/fetch_data.php');

// TEMP: replace with $_SESSION later
$studentID = 3;

$reports = getReportsForStudent($studentID);

$totalCount = 0;
$approvedCount = 0;
$pendingCount = 0;
$rejectedCount = 0;

foreach ($reports as $report) {
    $totalCount++;

    if ($report['status'] === 'approved') {
        $approvedCount++;
    } elseif ($report['status'] === 'rejected') {
        $rejectedCount++;
    } else {
        $pendingCount++; // default = pending
    }
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
    <title>Reports</title>
</head>

<body>
    <?php include '../../component/stu_header.php'; ?>
    <div class=" col-12 col-s-12 content-mid fade-in">
        <div class="reports-page-container">
            <div class="header-section">
                <div class="header-text">
                    <span class="dark-green-description">Broken Light Reports</span>
                    <span class="green-description">Report any malfunctioning lights<span>
                </div>

                <div class="report-icon">
                    <a href="submit_report.php" class="orange-button">
                        <img src="../../image/add_icon.svg" alt="add" class="button-img">
                        <span>Report Issue</span>
                    </a>
                </div>
            </div>

            <div class="report-count">
                <div class="report-count-card" style="background-color: var(--transparent-green); border: 0.1rem solid var(--border-green);">
                    <div class="report-card-text">
                        <img src="../../image/warning_small.svg" alt="warn_small" class="report-card-img">
                        <span class="green-description">Total Reports</span>
                    </div>
                    <span class="green-description"><?= $totalCount ?></span>
                </div>

                <div class="report-count-card" style="background-color: var(--pending-orange-background); border: 0.1rem solid var(--pending-orange-border);">
                    <div class="report-card-text">
                        <img src="../../image/timer.svg" alt="timer" class="report-card-img">
                        <span class="orange-description">Pending</span>
                    </div>
                    <span class="orange-description"><?= $pendingCount ?></span>
                </div>

                <div class="report-count-card" style="background-color: var(--approved-green-background); border: 0.1rem solid var(--approved-green-border);">
                    <div class="report-card-text">
                        <img src="../../image/tick.svg" alt="tick" class="report-card-img">
                        <span class="dark-green-description">Approved</span>
                    </div>
                    <span class="dark-green-description"><?= $approvedCount ?></span>
                </div>

                <div class="report-count-card" style="background-color: var(--rejected-red-background); border: 0.1rem solid var(--rejected-red-border);">
                    <div class="report-card-text">
                        <img src="../../image/rejected.svg" alt="rejected" class="report-card-img">
                        <span class="red-description">Rejected</span>
                    </div>
                    <span class="red-description"><?= $rejectedCount ?></span>
                </div>
            </div>

            <div class="filterbar">
                <div class="label-field">
                    <label class="green-description">Filter By Room</label>
                    <select class="dropdown-classroom-choice" name="room">
                        <option value="all">All Rooms</option>
                        <option value="classroom">Classrooms</option>
                        <option value="lecture">Lecture Halls</option>
                    </select>
                </div>

                <div class="label-field">
                    <label class="green-description">Fitler By Status</label>
                    <select class="dropdown-classroom-choice" name="status">
                        <option value="all">All Status</option>
                        <option value="approved">Approved</option>
                        <option value="pending">Pending</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>

            <div class="report-content">
                <?php if (empty($reports)): ?>
                    <div class="mid-text-group">
                        <span class="medium-green-title">No reports submitted</span>
                        <span class="green-description">You have not submitted any reports yet.</span>
                    </div>
                <?php else: ?>
                    <?php foreach ($reports as $report): ?>
                        <div class="report-content-card" data-room="<?= $report['roomName'] ?>" data-status="<?= $report['status'] ?>">
                            <img src="data:image/jpeg;base64,<?= base64_encode($report['evidence']) ?>" class="report-img" />
                            <div class="report-text-group">
                                <div class="title-and-icon">
                                    <span class="dark-green-description report-title">
                                        <?= htmlspecialchars($report['title']) ?>
                                    </span>

                                    <div class="
                                        <?php
                                            if ($report['status'] === 'approved') echo 'card-icon-img-apro';
                                            elseif ($report['status'] === 'rejected') echo 'card-icon-img-rej';
                                            else echo 'card-icon-img-pen';
                                        ?>">
                                        <img src="../../image/<?=
                                            ($report['status'] === 'approved') ? 'tick.svg' :
                                            (($report['status'] === 'rejected') ? 'rejected.svg' : 'timer.svg')
                                        ?>" alt="status" class="report-card-img">
                                    </div>
                                </div>

                                <div class="location-text">
                                    <img src="../../image/location.svg" class="report-card-img">
                                    <span class="green-description">
                                        <?= htmlspecialchars($report['roomName']) ?>
                                    </span>
                                </div>

                                <span class="green-description report-desc" >
                                    <?= nl2br(htmlspecialchars($report['description'])) ?>
                                </span>

                                <div class="sender-info">
                                    <span class="green-description">
                                        By: <?= htmlspecialchars($report['name']) ?>
                                    </span>
                                    <span class="green-description">
                                        <?= date("Y-m-d", strtotime($report['date'])) ?>
                                    </span>
                                </div>

                                <a href="report_details.php?id=<?= $report['brID'] ?>"
                                    class="green-button">
                                        View Details
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/report.js"></script>
</body>
</html>