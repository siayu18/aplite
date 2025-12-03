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

// Fetch specific data from table
function getDataByID($table_name, $attribute_name, $id) {
    global $con;

    $sql = "SELECT * FROM $table_name WHERE $attribute_name = $id LIMIT 1";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);;
}

// Fetch data from table with 1 foreign key
function getDataWithJoin($table_name, $target_table_name, $attribute_id, $target_attribute) {
    global $con;

    $sql = "SELECT t1.*, t2.*
            FROM $table_name AS t1
            INNER JOIN $target_table_name AS t2
            ON t1.$attribute_id = t2.$target_attribute";
    $result = mysqli_query($con, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}
?>
