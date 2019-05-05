<?php
//Video Tutorial Used - MMTUTS https://www.youtube.com/watch?v=wUkKCMEYj9M

//if reset password button was pressed
if (isset($_POST["reset-password-submit"])) {

    //variables
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $newpassword = $_POST["pwd"];
    $passwordRepeat = $_POST["cpwd"];

    //validation
    if (empty($newpassword) || empty($passwordRepeat)) {
        header("Location: ../login.php&error=emptyfields");
        exit();
    } elseif ($newpassword !== $passwordRepeat) {
        header("Location: ../login.php&error=notsame");
        exit();
    }

    //current date variable
    $currentDate = date("U");

    require '../connectDB.php';

    //query
    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        //error checking
        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            echo "You need to resubmit your request.";
            exit();
        } else {

            //variable check
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            //error checking
            if ($tokenCheck == false) {
                echo "You need to resubmit your request.";
                exit();
            } elseif ($tokenCheck == true) {

                //variable
                $tokenEmail = $row["pwdResetEmail"];

                //query
                $sql = "SELECT * FROM user_profile WHERE email=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "There was an error!";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "There was an error!";
                        exit();
                    } else {

                        //query
                        $sql = "UPDATE user_profile SET pwdUsers=? WHERE email=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "There was an error!";
                            exit();
                        } else {
                            $newPwdHash = password_hash($newpassword, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "There was an error!";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../login.php?newpwd=passwordupdated");
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    header("Location: ../index.php");
}
