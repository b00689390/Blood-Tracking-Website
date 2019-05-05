<?php

include_once("../connectDB.php");

//POST Variables
$testID=$_POST['blood_test_ID'];
$rangeLower=$_POST['rangeLower'];
$rangeUpper=$_POST['rangeUpper'];
$date = date('Y-m-d');

//multiquery to update range
$sql = "INSERT INTO ranges_table (blood_test_id,range_lower,range_upper,range_date) VALUES ('$testID','$rangeLower','$rangeUpper','$date');";
$sql .= "UPDATE blood_test_table SET range_lower='$rangeLower', range_upper='$rangeUpper' WHERE blood_test_id = '$testID'";

if (mysqli_multi_query($conn, $sql)) {
    do{
        if($result = mysqli_store_result($conn)){
            mysqli_free_result($result);
        }
    }
    while (mysqli_next_result($conn));
}

//return to adminEdit.php
header("Location: ../adminEdit.php?rangeUpdate=success");
exit();
