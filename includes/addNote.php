<?php

session_start();
include('../connectDB.php');

if (isset($_POST["note"])) {

    //variables
    $note = $_POST['note'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $user = $_SESSION['userId'];

    //query
    $sql = "INSERT INTO calendar (note, note_date, notify_date, user_id) 
                VALUES ('$note','$start','$end','$user')";
    $result = $conn->query($sql);
}
