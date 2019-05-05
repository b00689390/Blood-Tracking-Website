<?php

session_start();
include("../connectDB.php");

//variable
$user = $_SESSION['userId'];

//multiquery deletes every trace of user 
$sql = "DELETE FROM last_result WHERE user_id = '$user';";
$sql .= "DELETE FROM diagnosis WHERE user_id = '$user';";
$sql .= "DELETE FROM calendar WHERE user_id = '$user';";
$sql .= "DELETE FROM blood_reults_table WHERE user_id = '$user';";
$sql .= "DELETE FROM user_profile WHERE id = '$user'";
if (mysqli_multi_query($conn, $sql)) {
    do{
        if($result = mysqli_store_result($conn)){
            mysqli_free_result($result);
        }
    }
    while (mysqli_next_result($conn));
}

//unsets session
session_unset();
session_destroy();

//return to homepage
header("Location: ../index.php?accDelete=success");
exit();

