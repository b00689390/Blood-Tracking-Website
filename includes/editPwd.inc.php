<?php

session_start();

//if edit-pwd button was pressed
if (isset($_POST['edit-pwd'])) {

    //store submitted variables
    $newpassword = $_POST["pwd"];
    $passwordRepeat = $_POST["cpwd"];
    $id = $_SESSION['userId'];

    //validation
    if (empty($newpassword) || empty($passwordRepeat)) {
        header("Location: ../profile.php?newpwd=empty");
        exit();
    } elseif ($newpassword !== $passwordRepeat) {
        header("Location: ../profile.php?newpwd=pwdnotsame");
        exit();
    }

    require '../connectDB.php';

    //query
    $sql = "UPDATE user_profile SET pwdUsers=? WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    } else {
        //hash password for security
        $newPwdHash = password_hash($newpassword, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $id);
        mysqli_stmt_execute($stmt);

        //return to profile.php
        header("Location: ../profile.php?newpwd=passworrdupdated");
        exit();
    }
}
