<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Trackinus Health - Login</title>
  <link rel="shortcut icon" type="image/png" href="img/favicon.png">

  <!-- Bootstrap core CSS-->
  <link href="bootstrapDashboard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="bootstrapDashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="bootstrapDashboard/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-secondary">

  <a id="back" href="index.php">Back <i class="fas fa-arrow-left"></i></a>

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login
      </div>
      <div class="card-body">
        <form action="includes/login.inc.php" method="post">
          <?php
          if (isset($_GET['reset'])) {
            if ($_GET['reset'] == "success") {
              echo '<div class="alert alert-info" role="alert">
                                                Check your emails for a link!
                                              </div>';
            }
          } elseif (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
              echo '<div class="alert alert-danger" role="alert">
                                                Fill in all fields!
                                              </div>';
            } elseif ($_GET['error'] == "incorrectpassword") {
              echo '<div class="alert alert-danger" role="alert">
                                                Incorrect password!
                                                <a href="forgot-password.php">Reset Password?</a>
                                              </div>';
            } elseif ($_GET['error'] == "nouser") {
              echo '<div class="alert alert-danger" role="alert">
                                                User does not exist!
                                                <a href="register.php">Register?</a>
                                              </div>';
            } elseif ($_GET['error'] == "notsame") {
              echo '<div class="alert alert-danger" role="alert">
                                                New passwords did not match!
                                                <a href="register.php">Try again?</a>
                                              </div>';
            }
          }
          ?>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="mail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <button type="submit" class="btn btn-danger btn-block" name="login-submit">Login</button>
        </form>
        <div class="text-center">
          <a class="text-danger d-block small mt-3" href="register.php">Register an Account</a>
          <a class="text-danger d-block small" href="forgot-password.php">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="bootstrapDashboard/vendor/jquery/jquery.min.js"></script>
  <script src="bootstrapDashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="bootstrapDashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>