<?php

session_start();
include('../connectDB.php');

//query
$sql = "SELECT * FROM calendar WHERE calendar.user_id = '" . $_SESSION['userId'] . "' ORDER BY calendar.notes_id ";
$result = $conn->query($sql);

//creates array of events
foreach ($result as $row) {
    $data[] = array(
        'notes_id'    => $row["notes_id"],
        'title'    => $row["note"],
        'start'    => $row["note_date"],
        'end'    => $row["notify_date"]
    );
}

//encodes data as JSON format
echo json_encode($data);
