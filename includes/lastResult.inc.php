<?php

include('../connectDB.php');

//query ran by cron job
$sql = "UPDATE last_result SET days = (days + 1)";
$result = $conn->query($sql);
