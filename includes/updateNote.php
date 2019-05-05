<?php

session_start();
include('../connectDB.php');

//variable
$user = $_SESSION['userId'];

//if note ID was submitted
if (isset($_POST["notes_id"])) {

    //variables
    $start = $_POST['start'];
    $end = $_POST['end'];
    $id = $_POST['notes_id'];

    //query
    $sql = "UPDATE calendar SET note_date='$start', notify_date='$end'
            WHERE notes_id='$id' AND user_id = '$user'";
    $result = $conn->query($sql);
}
