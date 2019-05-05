<?php
//Video Tutorial Used - MMTUTS https://www.youtube.com/watch?v=LC9GaXkdxF8
if (isset($_POST['signup-submit'])) {

    //connects to db
    require '../connectDB.php';

    //variables
    $firstname = $_POST['fname'];
    $surname = $_POST['sname'];
    $email = $_POST['mail'];
    $num = $_POST['number'];
    $dob = $_POST['dob'];
    $gen = $_POST['gender'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $password = $_POST['pwd'];
    $cpassword = $_POST['cpwd'];
    $cName = $_POST['cFname'];
    $cSname = $_POST['cSname'];
    $rShip = $_POST['relationship'];
    $firstResult = '1';

    //checks for empty boxes
    if (empty($firstname) || empty($surname) || empty($email) || empty($password) || empty($cpassword) || empty($num) || empty($dob) || empty($gen)) {
        header("Location: ../register.php?error=emptyfields&fname=" . $firstname . "&sname=" . $surname . "&mail=" . $email . "&num=" . $num . "&dob=" . $dob . "&gender=" . $gen);
        exit();
    }

    //checks valid email
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=invalidmail&fname=" . $firstname . "&sname=" . $surname . "&num=" . $num);
        exit();
    }

    //checks if email already exists **MY CODE**
    elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $select = mysqli_query($conn, "SELECT email FROM user_profile WHERE `email` = '$email'") or exit(mysqli_error($connectionID));
        if (mysqli_num_rows($select)) {

            header("Location: ../register.php?error=emailexists&fname=" . $firstname . "&sname=" . $surname . "&num=" . $num);
            exit();

        } //checks if passwords match
        elseif ($password !== $cpassword) {

            header("Location: ../register.php?error=passwordcheck&fname=" . $firstname . "&sname=" . $surname . "&mail=" . $email . "&num=" . $num);
            exit();
        }
        // ** MY CODE **
        // insert user info if registering as guardian
        elseif (!empty($_POST['cFname'])) {

            //query
            $sql = "INSERT INTO guardian (first_name, surname, relationship) 
                VALUES ('$cName','$cSname','$rShip')";
            $result = $conn->query($sql);

            //stores last insert ID as variable
            $last_id = mysqli_insert_id($conn);

            //variables
            $child = $last_id;
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            
            //query
            $sql = "INSERT INTO user_profile (firstName, surname, email, pwdUsers, phoneNumber, dob, gender, height, weight, guardian_id, first_result) 
                VALUES ('$firstname', '$surname', '$email', '$hashedPwd', '$num', '$dob', '$gen', '$height', '$weight', '$child', '$firstResult')";
            mysqli_query($conn, $sql);

            //stores last insert ID as variable
            $last_id = mysqli_insert_id($conn);

            //query
            $sql = "INSERT INTO last_result (user_id) 
                    VALUES ('$last_id')";
            $result = $conn->query($sql);

            //set session variables
            session_start();
            $_SESSION['userId'] = $last_id;
            $_SESSION['userFname'] = $firstname;
            $_SESSION['userSname'] = $surname;
            $_SESSION['userEmail'] = $email;
            $_SESSION['userNo'] = $num;
            $_SESSION['userDob'] = $dob;
            $_SESSION['userGen'] = $gen;
            $_SESSION['userHeight'] = $height;
            $_SESSION['userWeight'] = $weight;
            $_SESSION['time'] = time();
            $_SESSION['child'] = $child;
            $_SESSION['childFName'] = $cName;
            $_SESSION['childSName'] = $cSname;
            $_SESSION['childRelationship'] = $rShip;
            $_SESSION['result'] = $firstResult;

            //if first login set toastr pop-up
            if ($_SESSION['result'] == '1') {
                $_SESSION['toastr'] = array(
                    'type'      => 'info',
                    'message' => 'Enter your first result to access your Dashboard',
                    'title'     => 'Notification'
                );
            }

            //redirect to add first result
            header("Location: ../addResults.php?signup=success");
            exit();
        }

        //insert user info
        else {

            //query
            $sql = "INSERT INTO user_profile (firstName, surname, email, pwdUsers, phoneNumber, dob, gender, height, weight, first_result) 
                VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);

            //error checking
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../register.php?error=sqlerror");
                exit();
            } else {
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt, "ssssssssss", $firstname, $surname, $email, $hashedPwd, $num, $dob, $gen, $height, $weight, $firstResult);
                mysqli_stmt_execute($stmt);

                //stores last insert ID as variable
                $last_id = mysqli_insert_id($conn);

                //query
                $sql = "INSERT INTO last_result (user_id) 
                        VALUES ('$last_id')";
                $result = $conn->query($sql);

                //set session variables
                session_start();
                $_SESSION['userId'] = $last_id;
                $_SESSION['userFname'] = $firstname;
                $_SESSION['userSname'] = $surname;
                $_SESSION['userEmail'] = $email;
                $_SESSION['userNo'] = $num;
                $_SESSION['userDob'] = $dob;
                $_SESSION['userGen'] = $gen;
                $_SESSION['userHeight'] = $height;
                $_SESSION['userWeight'] = $weight;
                $_SESSION['time'] = time();
                $_SESSION['result'] = $firstResult;

                //if first login set toastr pop-up
                if ($_SESSION['result'] == '1') {
                    $_SESSION['toastr'] = array(
                        'type'      => 'info',
                        'message' => 'Enter your first result to access your Dashboard',
                        'title'     => 'Notification'
                    );
                }

                //redirect to add first result
                header("Location: ../addResults.php?signup=success");
                exit();
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
} else {
    header("Location: ../register.php");
    exit();
}
