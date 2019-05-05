<?php

session_start();
include('../connectDB.php');

//variables
$date = date("Y-m-d");
$user = $_SESSION['userId'];

//if note ID was submitted
if (isset($_POST['notes_id'])) {

    //variable
    $id = $_POST['notes_id'];
    
    //query
    $sql = "DELETE FROM calendar WHERE notes_id='$id' AND user_id = '$user'";
    $result = $conn->query($sql);
}

//if user is logged in
if(isset($_SESSION['userId'])) {

    //query
    $sql = "DELETE FROM calendar WHERE notify_date < '$date' AND user_id = '$user'";
    $result = $conn->query($sql);
}
