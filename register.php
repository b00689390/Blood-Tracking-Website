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

  <title>Trackinus Health - Register</title>
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
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account
      </div>
      <div class="card-body">
        <form action="includes/signup.inc.php" method="post">
          <div class="form-group">
            <a class="collapsible">Registering as a Guardian? <i class="fas fa-chevron-down"></i></a>
            <div class="content">
              <br>
              <div class="form-group">
                <div class="form-label-group">
                  <select id="relationship" name="relationship" class="form-control">
                    <option value="">Choose relationship</option>
                    <option value="Child">Child</option>
                    <option value="Grandchild">Grandchild</option>
                    <option value="Foster Child">Foster Child</option>
                    <option value="Step Child">Step Child</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="text" id="cFirstName" name="cFname" class="form-control" placeholder="First name" autofocus="autofocus">
                      <label for="cFirstName">Child's First name</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="text" id="cLastName" name="cSname" class="form-control" placeholder="Last name">
                      <label for="cLastName">Child's Surname</label>
                    </div>
                  </div>
                </div>
              </div>
              <br />
              <p>Guardian Information:</p>
            </div>
          </div>
          <?php
          if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
              echo '<div class="alert alert-danger" role="alert">
                                                    Fill in all fields!
                                                  </div>';
            } elseif ($_GET['error'] == "invalidmail") {
              echo '<div class="alert alert-danger" role="alert">
                                                    Invalid E-mail!
                                                  </div>';
            } elseif ($_GET['error'] == "passwordcheck") {
              echo '<div class="alert alert-danger" role="alert">
                                                    Passwords do not match!
                                                  </div>';
            } elseif ($_GET['error'] == "emailexists") {
              echo '<div class="alert alert-danger" role="alert">
                                                    Email already registered!
                                                    <a href="login.php">Login?</a>
                                                  </div>';
            }
          }
          ?>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="firstName" name="fname" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                  <label for="firstName">First name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="lastName" name="sname" class="form-control" placeholder="Last name" required="required">
                  <label for="lastName">Surname</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="date" id="dob" name="dob" class="form-control" placeholder="Date of birth" min="1900-01-01" max="2000-12-31" required="required">
                  <label for="dob">Date of birth</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <select id="gender" name="gender" class="form-control" required="required">
                    <option value="">Select Gender</option>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                    <option value="o">Other</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="number" id="height" name="height" class="form-control" placeholder="Height" step="0.01" min="0.01" max="3.50" required="required">
                  <label for="height">Height (m)</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="number" id="weight" name="weight" class="form-control" placeholder="Weight" min="20" max="250" required="required">
                  <label for="weight">Weight (kg)</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="mail" class="form-control" placeholder="Email address" required="required">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="num" name="number" class="form-control" placeholder="Mobile Number" pattern="^\s*\(?(020[7,8]{1}\)?[ ]?[1-9]{1}[0-9{2}[ ]?[0-9]{4})|(0[1-8]{1}[0-9]{3}\)?[ ]?[1-9]{1}[0-9]{2}[ ]?[0-9]{3})\s*$" required="required">
              <label for="num">Mobile Number</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="required">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" name="cpwd" class="form-control" placeholder="Confirm password" required="required">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" name="signup-submit" class="btn btn-danger btn-block">Register</button>
        </form>
        <div class="text-center">
          <a class="text-danger d-block small mt-3" href="login.php">Login Page</a>
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

  <!-- Custom Scripts -->
  <!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_collapsible -->
  <script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
          content.style.display = "none";
        } else {
          content.style.display = "block";
        }
      });
    }
  </script>

</body>

</html>