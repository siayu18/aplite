<?php
    require_once "../../../backend/auth/session_staff.php";
    include("../../../backend/conn.php");

    $sql = "SELECT BrightnessLevel FROM Brightnesslog";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $totalBrightness = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $totalBrightness += $row['BrightnessLevel'];
    }
    $avg = ($totalBrightness / $count);

    $sql1 = "SELECT * FROM room AS r, brightnesslog AS bl, session AS s WHERE bl.sessionID = s.sessionID AND s.roomID = r.roomID";
    $result1 = mysqli_query($con, $sql1);
    
    $totalkWh = 0;

    while ($row1 = mysqli_fetch_assoc($result1)) {
        $operatingHours = $row1['operatingHours'];
        $bulbs = $row1['numberOfBulbs'];
        $wattage = $row1['bulbWattage'];
        $brightness = $row1['brightnessLevel'];

        list($h, $m, $s) = explode(':', $operatingHours);
        $seconds = ($h * 3600) + ($m * 60) + $s;
        $h = $seconds / 3600;
        $dailyKwh = ($bulbs * $wattage * $h * ($brightness / 100)) / 1000;
        $totalkWh += $dailyKwh;
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Report</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/component.css">
    <link rel="stylesheet" href="../../styles/report.css">
    <link rel="stylesheet" href="../../styles/room_report.css">
</head>
<body>
    <?php include '../../component/staff_header.php'; ?>
    <div class="col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Report</span>
            <span class="green-description">Display statistics and specific report for room</span>
            <p style="font-size: 8px;"></p>
            <div class="summary-row">
                <div class="summary-card">
                    <img src="../../image/lightning.svg" alt="Points Badge"/>
                    <div class="card-content">
                        <p class="green-description">Total Consumption</p>
                        <p class="value"><?php echo number_format($totalkWh, 2)?> kWh/day</p>
                    </div>
                </div>
                <div class="summary-card">
                    <img src="../../image/small_bulb.svg" alt="Points Badge"/>
                    <div class="card-content">
                        <p class="green-description">Avg Brightness</p>
                        <p class="value"><?php echo $avg?>%</p>
                    </div>
                </div>
            </div>
        </div>
        <main class="main-report-card">
            <div class="report-title">
                <img src="../../image/small_bulb.svg">
                <span class="medium-green-title">Light Consumption Report</span>
            </div>
            <?php
                $sql = "SELECT * FROM room AS r, brightnesslog AS bl, session AS s WHERE bl.sessionID = s.sessionID AND s.roomID = r.roomID LIMIT 1";
                $result = mysqli_query($con, $sql);
                $roomID = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach ($roomID as $r) {
                    $selectedRoom = $r['roomName'];
                }

                if (isset($_POST['select_room'])) {
                    $selectedRoom = $_POST['select_room'];
                    $sql = "SELECT * FROM room AS r, brightnesslog AS bl, session AS s WHERE bl.sessionID = s.sessionID AND s.roomID = r.roomID AND r.roomID = $selectedRoom";
                    
                    $result = mysqli_query($con, $sql);
                    $roomID = mysqli_fetch_all($result, MYSQLI_ASSOC);
                }
            ?>
            <form method="POST" id="reportForm">
            <?php
                
                $sql2 = "SELECT * FROM Room ORDER BY roomName ASC";
            
                $result2 = mysqli_query($con, $sql2);
                $roomID2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
                $selectedValue = isset($_POST['select_room']) ? $_POST['select_room'] : '';
            ?>
                <span class="green-description">Select Room</span>
                <select name="select_room" onchange="this.form.submit()">
                    <?php foreach($roomID as $r){
                        $roomName = $r['roomName'];
                        $selectedRoom = $roomName;
                        }?>
                    <option value="" disabled selected hidden><?php echo $selectedRoom ?></option>
                    
                        <?php foreach ($roomID2 as $r2){ ?>
                            <option value="<?php echo $r2['roomID']; ?>">
                                <?php if ($selectedValue == $r2['roomName']) ?>
                            <?= $r2['roomName']; ?>
                    </option>
                    <?php }?>
                </select>
            </form>
            <div class="details-box">
                <div class="details-header">
                    <?php foreach ($roomID as $r){
                        $roomName = $r['roomName'];
                        $bulbs = $r['numberOfBulbs'];
                        $wattage = $r['bulbWattage'];
                        $operatingHours = $r['operatingHours'];
                        $brightness = $r['brightnessLevel'];
                        $timestamp = $r['timestamp']
                    ?>

                    <span class="sub-value">Room: <?php echo $roomName; ?></span>

                    <?php
                        list($h, $m, $s) = explode(':', $operatingHours);
                        $seconds = ($h * 3600) + ($m * 60) + $s;
                        $h = $seconds / 3600;
                        if (!$h) {
                            $dailyKwh = "";
                            $dailyCost = "";
                        }
                        else {
                            $dailyKwh = ($bulbs * $wattage * $h * ($brightness / 100)) / 1000;
                            $dailyCost = $dailyKwh * 0.27;
                        }
                        
                    ?>

                    <br><br>
                    <span class="sub-value">Date: <?php echo $timestamp; ?></span>

                </div>
                
                <div class="stats-grid">
                    <div>
                        <p class="green-description">Light Bulbs</p>
                        <p class="sub-value"><?php echo $bulbs; ?> bulbs</p>
                    </div>
                    <div>
                        <p class="green-description">Wattage</p>
                        <p class="sub-value"><?php echo $wattage; ?>W each</p>
                    </div>
                    <div>
                        <p class="green-description">Operating Hours</p>
                        <p class="sub-value"><?php echo $operatingHours; ?>h/day</p>
                    </div>
                    <div>
                        <p class="green-description">Brightness</p>
                        <p class="sub-value"><?php echo $brightness; ?>%</p>
                    </div>
                </div>
                <?php }?>
                <div class="cost-footer">
                    <div class="cost-item">
                        <p class="green-description">Daily Consumption</p>
                        <p class="value"><?php echo number_format($dailyKwh, 2); ?> kWh</p>
                    </div>
                    <div class="cost-item">
                        <p class="green-description">Estimated Daily Cost</p>
                        <p class="value">RM <?php echo number_format($dailyCost, 2); ?></p>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php include '../../component/footer.php'; ?>
</body>
</html>