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
function getDataByID($table_name, $key, $id) {
    global $con;

    $sql = "SELECT * FROM $table_name WHERE $key = '$id' LIMIT 1";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);;
}

function getAllByID($table, $key, $id) {
    global $con;

    $sql = "SELECT * FROM $table WHERE $key = '$id'";
    $result = mysqli_query($con, $sql);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
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

function getReportsForStudent($studentID) {
    global $con;

    $sql = "SELECT r.*, u.name, cr.roomName
            FROM brokenreport r
            INNER JOIN user u ON r.studentID = u.userID
            INNER JOIN room cr ON r.roomID = cr.roomID
            WHERE r.studentID = '$studentID'
            ORDER BY r.date DESC";

    $result = mysqli_query($con, $sql);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}

function getReportByID($brID) {
    global $con;

    $sql = "SELECT r.*, u.name, u.userID, cr.roomName
            FROM brokenreport r
            INNER JOIN user u ON r.studentID = u.userID
            INNER JOIN room cr ON r.roomID = cr.roomID
            WHERE r.brID = '$brID'";

    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function getAllReports() {
    global $con;

    $sql = "SELECT r.*, u.name, u.userID, cr.roomName
            FROM brokenreport r
            INNER JOIN user u ON r.studentID = u.userID
            INNER JOIN room cr ON r.roomID = cr.roomID
            ORDER BY r.date DESC";

    $result = mysqli_query($con, $sql);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}



?>
