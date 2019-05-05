<?php

include("../connectDB.php");

//if ID is received, set as variable
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

//multiquery deletes range and then test
$sql = "DELETE FROM ranges_table WHERE blood_test_id = '$id';";
$sql .= "DELETE FROM blood_test_table WHERE blood_test_id = '$id'";
if (mysqli_multi_query($conn, $sql)) {
    do {
        if ($result = mysqli_store_result($conn)) {
            mysqli_free_result($result);
        }
    } while (mysqli_next_result($conn));
}

//return to admin.php
header("Location: ../admin.php?delete=success");
exit();
