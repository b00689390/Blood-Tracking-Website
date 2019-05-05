<?php

session_start();
include("../connectDB.php");

//variable
$id = $_SESSION['userId'];

//if update button was pressed
if(isset($_POST['update-submit'])){

    //variables
    $result = $_POST['result'];
    $resultId = $_POST['toBeUpdated'];

    //query
    $sql = "UPDATE blood_reults_table 
            SET result = '$result' 
            WHERE blood_results_id = '$resultId' 
            AND user_id = '$id'";
    $result = $conn->query($sql);

    //return to dashboard.php
    header ("Location: ../dashboard.php?resultUpdate=success");
    exit();
}
