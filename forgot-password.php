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

  <title>Trackinus Health - Forgot Password</title>
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
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <div class="text-center mb-4">
          <h4>Forgot your password?</h4>
          <p>Enter your email address and we will send you instructions on how to reset your password.</p>
        </div>
        <form action="includes/reset-request.inc.php" method="post">
          <?php
          if (isset($_GET['error'])) {
            if ($_GET['error'] == "nouser") {
              echo '<div class="alert alert-danger" role="alert">
                                              User does not exist!
                                              <a href="register.php">Register?</a>
                                            </div>';
            }
          }
          ?>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Enter email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Enter email address</label>
            </div>
          </div>
          <button type="submit" name="reset-request-submit" class="btn btn-danger btn-block">Send E-mail</button>
        </form>
        <div class="text-center">
          <a class="text-danger d-block small mt-3" href="register.php">Register an Account</a>
          <a class="text-danger d-block small" href="login.php">Login Page</a>
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