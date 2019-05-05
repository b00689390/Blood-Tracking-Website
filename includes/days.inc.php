<?php

session_start();
include('../connectDB.php');

//variable
$id = $_SESSION['userId'];

//query
$sql = "SELECT * FROM last_result WHERE user_id = '$id'";
$result = $conn->query($sql);

//print days
foreach ($result as $row) {
    $days = $row['days'];

    echo $days;
}

//free associated result
$result->close();
