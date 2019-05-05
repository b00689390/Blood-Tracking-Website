<?php

session_start();
include('../connectDB.php');

//if edit-prf button was pressed
if (isset($_POST["edit-prf"])) {

    //store submitted variables
    $fName = $_POST['fname'];
    $sName = $_POST['sname'];
    $email = $_POST['mail'];
    $no = $_POST['number'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $id = $_POST['id'];

    //query
    $sql = "UPDATE user_profile 
            SET firstName='$fName', surname='$sName', email='$email', 
            phoneNumber='$no', height='$height', weight='$weight'
            WHERE id='$id'";
    $result = $conn->query($sql);

    //new logged in user information
    $_SESSION['userFname'] = $fName;
    $_SESSION['userSname'] = $sName;
    $_SESSION['userEmail'] = $email;
    $_SESSION['userNo'] = $no;
    $_SESSION['userHeight'] = $height;
    $_SESSION['userWeight'] = $weight;
}

//return to profile.php
header("Location: ../profile.php?profileUpdate=success");
exit();
