<?php

$db_host = 'localhost'; 
$db_name = 'managetasks';
$db_user = 'root';
$db_pass = '1245';

try {
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (!$conn) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }
} catch (Exception $e) {
    die($e->getMessage());
}

function executeQuery($sql) {
    global $conn;
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    return $result;
}

function fetchArray($result) {
    return mysqli_fetch_assoc($result);
}

function fetchAll($result) {
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
?>
