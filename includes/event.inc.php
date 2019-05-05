<?php

session_start();
include('../connectDB.php');

//variables
$id = $_SESSION['userId'];
$count = 0;
$date = date("Y-m-d");

//Delcaring variable 2 weeks from today's date
$upComingDate = date("Y-m-d");
$upComingDate = strtotime(date("Y-m-d", strtotime($upComingDate)) . " +2 week");
$upComingDate = date("Y-m-d",$upComingDate);

//query
$sql = "SELECT * FROM calendar WHERE user_id = '$id' AND notify_date > '$date' AND notify_date < '$upComingDate'";
$result = $conn->query($sql);

//event count
foreach ($result as $row) {
    $count++;
}

//print number of events within 2 week radius
echo $count;

//free associated result
$result->close();
