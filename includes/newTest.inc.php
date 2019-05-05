<?php

include_once("../connectDB.php");

//POST Variables
$test=$_POST['testName'];
$desc=$_POST['testDesc'];
$group=$_POST['testGroup'];
$lower=$_POST['rangeLow'];
$upper=$_POST['rangeUp'];
$units=$_POST['testUnits'];
$date = date('Y-m-d');

//multiquery
$sql = "INSERT INTO blood_test_table (test_name,test_descr,range_lower,range_upper,range_units,blood_group_id) VALUES ('$test','$desc','$lower','$upper','$units', '$group');";
$sql .= "SELECT blood_test_id FROM blood_test_table WHERE blood_test_name = '$test'";
if (mysqli_multi_query($conn, $sql)) {
    do{
        if($result = mysqli_store_result($conn)){
            mysqli_free_result($result);
        }
    }
    while (mysqli_next_result($conn));
}

//set variable of last inserted ID
$last_id = mysqli_insert_id($conn);

//query
$sql = "INSERT INTO ranges_table (blood_test_id,range_lower,range_upper,range_date) VALUES ('$last_id','$lower','$upper','$date')";
mysqli_query($conn, $sql);

//return to adminEdit.php
header("Location: ../adminEdit.php?newTest=success");
exit();
