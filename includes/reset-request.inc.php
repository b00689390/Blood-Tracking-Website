<?php
//Video Tutorial Used - MMTUTS https://www.youtube.com/watch?v=wUkKCMEYj9M
if (isset($_POST["reset-request-submit"])) {

    //for safety
    $selector = bin2hex(random_bytes(8));
    //authenticate user
    $token = random_bytes(32);

    //variable URL
    $url = "http://trackinushealth.uk/forgottenpwd/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    //sets 30 min expiration
    $expires = date("U") + 900;

    //connect to db
    require '../connectDB.php';

    //variable
    $userEmail = $_POST["email"];

    //query
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    //query
    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    //close query connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    //Server Side Email
    $to = $userEmail;

    $subject = 'Reset your password for Trackinus Health';

    $message = '<p>We recieved a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this e-mail.</p>';
    $message .= '<p>Here is your password reset link: </br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From: trackinus health <trackinushealth@gmail.com>\r\n";
    $headers .= "Reply-To: trackinushealth@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

    header("Location: ../login.php?reset=success");
} else {
    header("Location: ../index.php");
}
