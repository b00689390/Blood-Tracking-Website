<?php

$servername = "db759124252.hosting-data.io";
$username = "dbo759124252";
$password = "D0wnh!gh";
$dbname = "db759124252";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
