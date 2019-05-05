<?php

session_start();
include("../connectDB.php");

//if ID is received, set as variable
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

//query
$sql = "DELETE FROM blood_reults_table 
        WHERE blood_results_id = '$id' 
        AND user_id = '" . $_SESSION['userId'] . "'";
$result = $conn->query($sql);

//return to viewResults.php
header("Location: ../viewResults.php?delete=success");
exit();
