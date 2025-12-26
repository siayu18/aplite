<?php
require_once "../../../backend/auth/session_student.php";
include ('../../../backend/conn.php');
include ('../../../backend/fetch_data.php');

$rooms = getData('room');

if (isset($_POST['checkinBtn'])) {

    $sessionID = uniqid();
    $roomID = $_POST['classroom'];
    $studentID = 3;

    if (isLecturerInRoom($roomID)) {
        echo "<script>window.success = true;</script>";
    } else {
        $sql = "INSERT INTO `session` (sessionID, studentID, roomID, checkInTime, checkOutTime, duration)
                VALUES ('$sessionID', '$studentID', '$roomID', NOW(), NULL, NULL)";

        if (mysqli_query($con, $sql)) {
            header("Location: manage_lighting.php"); 
            exit(); 
        } else {
            die(mysqli_error($con));
        }
    }
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

            <form method="POST" class="content-group">
                <div class="label-field">
                    <label class="green-description">Select Classroom</label>
                    <select class="dropdown-classroom-choice" name="classroom" required>
                        <option value="" disabled selected>Select a classroom</option>

                        <?php foreach ($rooms as $room): ?>
                            <option value="<?= $room['roomID'] ?>">
                                <?= htmlspecialchars($room['roomName']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="green-button" name="checkinBtn">
                    <img src="../../image/check_in_icon.svg" alt="checkin" class="button-img">
                    <span>Check into Classoom<span>
                </button>
            </form>
        </div>
    </div>

    <div class="overlay"></div>
        <div class="modal">
            <img src="../../image/rejected.svg" alt="approved" class="card-img">
            <div class="text-group">
                <span class="medium-green-title">Classroom is currently used by Lecturer!</span>
            </div>
        <a href="control_lights.php" class="green-button">Select Classroom Again</a>
    </div>
    <?php include '../../component/footer.php'; ?>

    <script src="../../scripts/animation.js"></script>
    <script src="../../scripts/overlay.js"></script>
</body>
</html>