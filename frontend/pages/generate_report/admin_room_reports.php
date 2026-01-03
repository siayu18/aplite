<?php
    require_once "../../../backend/auth/session_admin.php";
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

    mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Report</title>
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="../../styles/component.css">
    <link rel="stylesheet" href="../../styles/room_report.css">
</head>
<body>
    <?php include '../../component/admin_header.php'; ?>
    <div class="col-12 col-s-12 content fade-in">
        <div class="text-group">
            <span class="green-title">Report</span>
            <span class="green-description">Display statistics and specific report for room</span>
        </div>
        <div class="summary-row">
            <div class="summary-card">   
                <div class="icon-text">
                    <img src="../../image/lightning.svg" alt="Lightning"/>
                    <span class="green-description">Total Consumption</span>
                </div>
                <span class="value"><?php echo number_format($totalkWh, 2)?> kWh/day</span>
            </div>
            <div class="summary-card">   
                <div class="icon-text">
                    <img src="../../image/small_bulb.svg" alt="Light Bulb"/>
                    <span class="green-description">Avg Brightness</span>
                </div>
                <span class="value"><?php echo $avg?>%</span>
            </div>
        </div>

        <div class="wrap-middle">
            <div class="main-report-card">
                <div class="report-title">
                    <img src="../../image/report-paper.svg">
                    <span class="medium-green-title" style="white-space: wrap;">Light Consumption Report</span>
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
                    <div class="label-field">
                        <span class="green-description">Select Room</span>
                        <select style="width: 100%" name="select_room" onchange="this.form.submit()">
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
                    </div>
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

                        <div class="header-text">
                            <span class="value">Room: <?php echo $roomName; ?></span>
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
                            <?php }?>
                            <span class="green-description">Date: <?php echo $timestamp; ?></span>
                        </div>
                    </div>
                    
                    <div class="stats-grid">
                        <div class="icon-text-clean">
                            <img src="../../image/small_bulb.svg" alt="Light Bulb"/>
                            <div class="stats-text">
                                <span class="green-description">Light Bulbs</span>
                                <span class="sub-value"><?php echo $bulbs; ?> bulbs</span>
                            </div>
                        </div>
                        <div class="icon-text-clean">
                            <img src="../../image/lightning.svg" alt="Lightning"/>
                            <div class="stats-text">
                                <span class="green-description">Wattage</span>
                                <span class="sub-value"><?php echo $wattage; ?>W each</span>
                            </div>
                        </div>
                        <div class="icon-text-clean">
                            <img src="../../image/time.svg" alt="Time"/>
                            <div class="stats-text">
                                <span class="green-description">Operating Hours</span>
                                <span class="sub-value"><?php echo $operatingHours; ?>h/day</span>
                            </div>
                        </div>
                        <div class="icon-text-clean">
                            <span class="brightness"><?php echo $brightness; ?>%</span>
                            <span class="green-description">Brightness</span>
                        </div>
                    </div>
                    <div class="cost-footer">
                        <div class="stats-text">
                            <span class="green-description">Daily Consumption</span>
                            <span class="value"><?php echo number_format($dailyKwh, 2); ?> kWh</span>
                        </div>
                        <div class="stats-text">
                            <span class="green-description">Estimated Daily Cost</span>
                            <span class="value">RM <?php echo number_format($dailyCost, 2); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../../component/footer.php'; ?>
</body>
</html>