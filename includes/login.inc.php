<?php
//Video Tutorial Used - MMTUTS https://www.youtube.com/watch?v=LC9GaXkdxF8
if (isset($_POST['login-submit'])) {

    require '../connectDB.php';

    //variables
    $mail = $_POST['mail'];
    $password = $_POST['pwd'];

    //validation
    if (empty($mail) || empty($password)) {
        header("Location: ../login.php?error=emptyfields");
        exit();
    } else {
        //query
        $sql = "SELECT * FROM user_profile WHERE email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror");
            exit();
        } else {

            mysqli_stmt_bind_param($stmt, "s", $mail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {

                //validation
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                if ($pwdCheck == false) {
                    header("Location: ../login.php?error=incorrectpassword");
                    exit();
                } elseif($row['email'] !== $mail) {
                    header("Location: ../login.php?error=nouser");
                    exit();
                }elseif ($pwdCheck == true) {

                    //set session variables
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['userFname'] = $row['firstName'];
                    $_SESSION['userSname'] = $row['surname'];
                    $_SESSION['userEmail'] = $row['email'];
                    $_SESSION['userNo'] = $row['phoneNumber'];
                    $_SESSION['userDob'] = $row['dob'];
                    $_SESSION['userGen'] = $row['gender'];
                    $_SESSION['userHeight'] = $row['height'];
                    $_SESSION['userWeight'] = $row['weight'];
                    $_SESSION['userBmi'] = $row['bmi'];
                    $_SESSION['time'] = time();
                    $_SESSION['admin'] = $row['admin'];
                    $_SESSION['result'] = $row['first_result'];

                    //sets guardian variables
                    if (!is_null($row['guardian_id'])) {
                        $select = "SELECT * FROM guardian WHERE `id` = '" . $row['guardian_id'] . "'";
                        $result = $conn->query($select);
                        foreach ($result as $row) {
                            $_SESSION['child'] = $row['id'];
                            $_SESSION['childFName'] = $row['first_name'];
                            $_SESSION['childSName'] = $row['surname'];
                            $_SESSION['childRelationship'] = $row['relationship'];
                        }
                    }

                    //creates toastr pop=up if first login
                    if ($_SESSION['result'] == '1') {
                        $_SESSION['toastr'] = array(
                            'type'      => 'info',
                            'message' => 'Enter your first result to access your Dashboard',
                            'title'     => 'Notification'
                        );
                    }

                    //redirect to admin page
                    if ($_SESSION['admin'] == '1') {

                        header("Location: ../admin.php?login=success");
                        exit();
                    } 
                    //redirect to dashboard
                    else {

                        header("Location: ../dashboard.php?login=success");
                        exit();
                    }
                } else {

                    header("Location: ../login.php?error=incorrectpassword");
                    exit();
                }
            } else {
                header("Location: ../login.php?error=nouser");
                exit();
            }
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}
