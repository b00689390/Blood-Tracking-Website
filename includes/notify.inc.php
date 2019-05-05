<?php

session_start();
include_once('../connectDB.php');

//creating date variable
$date = date("Y-m-d");
$user = $_SESSION['userId'];

//sql query
$sql = "SELECT * FROM calendar WHERE user_id = '$user' AND notify_date = '$date'";
$result = $conn->query($sql);

//print notification
foreach ($result as $row) {
    $message = $row['note'];
    if($row['notify_date'] == $date){
        echo '<br><b>Reminder: </b>'.$message;
    }
}
$result->close();
