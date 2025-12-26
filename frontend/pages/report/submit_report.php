<?php
require_once "../../../backend/auth/session_student.php";
include ('../../../backend/conn.php');
include ('../../../backend/fetch_data.php');

$rooms = getData('room');

if (isset($_POST['submitBtn'])) {
    
    $reportID = uniqid();
    $studentID = 3;
    $roomID = $_POST['classroom'];
    $title = mysqli_real_escape_string($con, $_POST['report_title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $current_date = date("Y-m-d");
    $status = "pending";

    $imageData = null;
    if (!empty($_FILES['report_image']['tmp_name'])) {
        $imageData = mysqli_real_escape_string($con, file_get_contents($_FILES['report_image']['tmp_name']));
    }

    $sql = "INSERT INTO brokenreport(brID, roomID, studentID, title, description, evidence, date, status)
            VALUES('$reportID', '$roomID', '$studentID', '$title', '$description', '$imageData', '$current_date', '$status')";

    if (!mysqli_query($con, $sql)) {
            die("Error: " . mysqli_error($con));
        } else {
            echo "<script>window.success = true;</script>";
        }

    mysqli_close($con);
}
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
    <title>Submit Report</title>
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

            <form method="POST" enctype="multipart/form-data" class="inner-container">
                <img src="../../image/report.svg" alt="report" class="card-img">
                <div class="text-group">
                    <span class="medium-green-title">Report Broken Light</span>
                    <span class="green-description">Help us maintain a well-lit and safe campus environment</span>
                </div>

                <div class="label-field">
                    <label class="green-description">Select Room</label>
                    <select class="dropdown-classroom-choice" name="classroom" required>
                        <option value="" disabled selected>Select a room</option>

                        <?php foreach ($rooms as $room): ?>
                            <option value="<?= $room['roomID'] ?>">
                                <?= htmlspecialchars($room['roomName']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="label-field">
                    <label class="green-description">Report Title</label>
                    <input type="text" placeholder="e.g., Multiple lights not working in back row" name="report_title" required/>
                </div>

                <div class="label-field">
                    <label class="green-description">Description</label>
                    <textarea class="white-area" placeholder="Describe the issue in detail. Include information such as: Which lights are affected? When did you notice the problem? How is it impacting the room usage?" 
                    name="description" required></textarea>
                </div>

                <div class="label-field">
                    <label class="green-description">Evidence (Required)</label>
                    <input type="file" id="file-upload" name="report_image" accept="image/png, image/jpeg" required>
                </div>

                <div class="report-note">
                    <span class="green-description-bold">Note:</span>
                    <span class="green-description">
                        All reports are reviewed by our maintenance team. You'll be notified of the status update via email. 
                        Thank you for helping us maintain a safe and comfortable learning environment!
                    </span>
                </div>

                <div class="thin-line"></div>

                <div class="right-button-group">
                    <a href="reports_page.php" class="white-button">Cancel</a>
                    <button type="submit" class="orange-button" name="submitBtn">Submit Report</button>
                </div>
            </form>
        </div>
    </div>

    <div class="overlay"></div>
        <div class="modal">
            <img src="../../image/tick.svg" alt="approved" class="card-img">
            <div class="text-group">
                <span class="medium-green-title">Report Submitted!</span>
            </div>
        <a href="reports_page.php" class="green-button">Done</a>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/overlay.js"></script>
</body>
</html>