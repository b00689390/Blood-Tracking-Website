<?php

include("../connectDB.php");

//if ID received set as variable
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

//query
$sql = "DELETE FROM blood_groups WHERE id = '$id';";
$result = $conn->query($sql);

//return to admin.php
header("Location: ../admin.php?delete=success");
exit();
