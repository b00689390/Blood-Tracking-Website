<?php

session_start();
include('../connectDB.php');

//variables
$id = $_SESSION['userId'];
$count = 0;

//query
$sql = "SELECT * FROM blood_reults_table WHERE user_id = '$id'";
$result = $conn->query($sql);

//count the number of results submitted
foreach ($result as $row) {
    $count++;
}

//print count
echo $count;

//free associated result
$result->close();