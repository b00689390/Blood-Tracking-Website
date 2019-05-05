<?php

session_start();

include_once("../connectDB.php");

$id = $_SESSION['chart'];

//query
$sql = "SELECT blood_reults_table.result, blood_reults_table.result_date, blood_test_table.range_units, 
        blood_reults_table.lower, blood_reults_table.upper,  blood_test_table.test_name
        FROM blood_reults_table 
        JOIN blood_test_table 
        ON blood_reults_table.blood_test_id = blood_test_table.blood_test_id 
        WHERE blood_reults_table.user_id = '".$_SESSION['userId']."' 
        AND blood_test_table.blood_test_id = '$id' ";

//execute query
$result = $conn->query($sql);

//loop through data
$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

//free associated result
$result->close();

//print data in json format
print json_encode($data);
