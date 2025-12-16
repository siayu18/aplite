<?php
include("conn.php");

// Fetch data from table
function getData($table_name) {
    global $con;

    $sql = "SELECT * FROM $table_name";
    $result = mysqli_query($con, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

// Fetch data from table with 1 foreign key
function getDataWithJoin($table_name, $target_table_name, $table1_fk, $table2_pk) {
    global $con;

    $sql = "SELECT t1.*, t2.*
            FROM $table_name AS t1
            INNER JOIN $target_table_name AS t2
            ON t1.$table1_fk = t2.$table2_pk";
    $result = mysqli_query($con, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

// Fetch specific data from table
function getDataByID($table_name, $table_pk, $id) {
    global $con;

    $sql = "SELECT * FROM $table_name WHERE $table_pk = '$id' LIMIT 1";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);;
}

// Fetch specific data from table with Join
function getDataByIDWithJoin($table_name, $target_table_name, $table1_fk, $table2_pk, $table1_pk, $id) {
    global $con;

    $sql = "SELECT t1.*, t2.*
            FROM $table_name AS t1
            INNER JOIN $target_table_name AS t2
            ON t1.$table1_fk = t2.$table2_pk
            WHERE t1.$table1_pk = '$id'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);;
}

function getDataBy2ID($table_name, $key1, $key2, $id1, $id2) {
    global $con;

    $sql = "SELECT * FROM $table_name WHERE $key1 = '$id1' AND $key2 = '$id2' LIMIT 1";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);;
}

function getReportsForStudent($studentID, $roomFilter = 'all', $statusFilter = 'all') {
    global $con;

    $conditions = [];
    $conditions[] = "r.studentID = '$studentID'";

    // STATUS FILTER
    if ($statusFilter !== 'all') {
        $conditions[] = "r.status = '$statusFilter'";
    }

    // ROOM FILTER
    if ($roomFilter === 'classroom') {
        // A–E + 01–09 + 01–20 (example: B0605)
        $conditions[] = "cr.roomName REGEXP '^[A-E][0-9]{4}$'";
    } 
    elseif ($roomFilter === 'lecture') {
        // Audi1–9 @ Level1–7
        $conditions[] = "cr.roomName REGEXP '^Audi[1-9] @ Level[1-7]$'";
    }

    $whereSQL = implode(" AND ", $conditions);

    $sql = "
        SELECT r.*, u.name, cr.roomName
        FROM brokenreport r
        INNER JOIN user u ON r.studentID = u.userID
        INNER JOIN room cr ON r.roomID = cr.roomID
        WHERE $whereSQL
    ";

    $result = mysqli_query($con, $sql);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}


?>
