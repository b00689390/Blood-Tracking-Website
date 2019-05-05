<?php

session_start();

include_once("../connectDB.php");

//POST Variables
$blood_test_id = $_POST['blood_test_id'];
$user_id = $_SESSION['userId'];
$result_date = $_POST['result_date'];
$test_result = $_POST['result'];

//multiquery updates last_result days to 0
//and inserts result into results table, whilst selecting range from test table
$sql = "UPDATE last_result SET days = '0' WHERE user_id = '$user_id';";
$sql .= "INSERT INTO blood_reults_table (blood_test_id,user_id,result,result_date,lower,upper) 
        VALUES ('$blood_test_id','$user_id','$test_result','$result_date',
        (SELECT range_lower FROM blood_test_table WHERE blood_test_id = $blood_test_id), 
        (SELECT range_upper FROM blood_test_table WHERE blood_test_id = $blood_test_id))";

if (mysqli_multi_query($conn, $sql)) {
    do {
        if ($result = mysqli_store_result($conn)) {
            mysqli_free_result($result);
        }
    } while (mysqli_next_result($conn));
}

//storing the last created ID as variable (result ID)
$last_id = mysqli_insert_id($conn);

//select everything from test table
$sql = "SELECT * FROM blood_test_table 
        WHERE blood_test_id = '$blood_test_id'";
$result = $conn->query($sql);

foreach ($result as $row) {

    $lower = $row['range_lower'];
    $upper = $row['range_upper'];

    //sets out of range result
    if ($test_result > $upper || $test_result < $lower) {

        $out = 1;

        $sql = "UPDATE blood_reults_table 
                SET out_of_range = '$out' 
                WHERE blood_results_id = '$last_id'";
        $result = $conn->query($sql);
    }
    //sets in range result 
    else {

        $in = 0;

        $sql = "UPDATE blood_reults_table 
                SET out_of_range = '$in' 
                WHERE blood_results_id = '$last_id'";
        $result = $conn->query($sql);
    }
}

//unsets new user after they enter first result
if ($_SESSION['result'] == '1') {
    $zero = 0;
    $sql = "UPDATE user_profile 
            SET first_result = '$zero' 
            WHERE id = '$user_id'";
    $result = $conn->query($sql);

    $_SESSION['result'] = $zero;
}

header("Location: ../dashboard.php?resultAdd=success");
exit();
