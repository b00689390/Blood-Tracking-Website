<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Trackinus Health - New Password</title>
  <link rel="shortcut icon" type="image/png" href="img/favicon.png">

  <!-- Bootstrap core CSS-->
  <link href="../bootstrapDashboard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="../bootstrapDashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../bootstrapDashboard/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-secondary">

  <a id="back" href="../index.php">Back <i class="fas fa-arrow-left"></i></a>

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <?php
        $selector = $_GET["selector"];
        $validator = $_GET["validator"];

        if (empty($selector) || empty($validator)) {
          echo "Could not validate your request!";
        } else {
          if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
            ?>
            <form action="../includes/reset-password.inc.php" method="post">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                  <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                  <input type="password" id="pwd" name="pwd" class="form-control" placeholder="Enter new password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="required" autofocus="autofocus">
                  <label for="pwd">New password</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="password" id="cpwd" name="cpwd" class="form-control" placeholder="Confirm password" required="required">
                  <label for="cpwd">Confirm password</label>
                </div>
              </div>
              <button type="submit" class="btn btn-danger btn-block" name="reset-password-submit">Login</button>
            </form>
          <?php
        }
      }

      ?>
        <div class="text-center">
          <a class="text-danger d-block small mt-3" href="register.php">Register an Account</a>
          <a class="text-danger d-block small" href="forgot-password.php">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../bootstrapDashboard/vendor/jquery/jquery.min.js"></script>
  <script src="../bootstrapDashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../bootstrapDashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>