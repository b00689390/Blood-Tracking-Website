<?php

session_start();
include('../connectDB.php');

//variables
$id = $_SESSION['userId'];
$count = 0;
$date = date("Y-m-d");

//Delcaring variable 1 month before today's date
$beforeDate = date("Y-m-d");
$beforeDate = strtotime(date("Y-m-d", strtotime($beforeDate)) . " -1 month");
$beforeDate = date("Y-m-d",$beforeDate);

//query
$sql = "SELECT * FROM blood_reults_table WHERE user_id = '$id' AND out_of_range = '1' AND result_date > '$beforeDate'";
$result = $conn->query($sql);

//counts out of range results
foreach ($result as $row) {
    $count++;
}

//prints out of range results
echo $count;

//free associated result
$result->close();