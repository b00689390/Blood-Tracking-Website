<?php

session_start();
if (!isset($_SESSION['userId'])) {
  header("Location: login.php");
} else if ($_SESSION['admin'] == '1') {
  header("Location: admin.php");
} else {
  if (isset($_SESSION['userId'])) {
    if ((time() - $_SESSION['time']) > 1800) {
      header("Location: includes/logout.inc.php");
    }
  }
}

include("connectDB.php");

//Setting Variables
$id = $_SESSION['userId'];
$fName = $_SESSION['userFname'];
$sName = $_SESSION['userSname'];
$email = $_SESSION['userEmail'];
$no = $_SESSION['userNo'];
$height = $_SESSION['userHeight'];
$weight = $_SESSION['userWeight'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Trackinus Health - Dashboard</title>
  <link rel="shortcut icon" type="image/png" href="img/favicon.png">

  <!-- Bootstrap core CSS-->
  <link href="bootstrapDashboard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="bootstrapDashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="bootstrapDashboard/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="bootstrapDashboard/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top" class="bg-secondary">

  <nav class="navbar navbar-expand navbar-light bg-light static-top">

    <a class="navbar-brand mr-1" href="dashboard.php"><img src="img/navbar-logo.png"></a>

    <button class="btn btn-link btn-sm text-black order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-sm-3 my-2 my-sm-0 static-top">
      <ul class="navbar-nav navbar-right ml-auto ml-sm-0 static-top">
        <li class="nav-item dropdown no-arrow mx-1">
          <p class="nav-link"><?php
                              if (isset($_SESSION['child'])) {
                                echo $_SESSION['childFName'] . " " . $_SESSION['childSName'];
                              } else {
                                echo $_SESSION['userFname'] . " " . $_SESSION['userSname'];
                              }
                              ?>
          </p>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="calendar.php">
            <span class="badge badge-danger"><?php include('includes/event.inc.php'); ?></span>
            <i class="far fa-calendar-check"></i>
          </a>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="includes/logout.inc.php" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>
    </form>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <?php
      if ($_SESSION['result'] == '0') {
        echo '<li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                  <i class="fas fa-fw fa-home"></i>
                  <span>Dashboard</span>
                </a>
              </li>';
      }
      ?>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Results</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="viewResults.php">View Results</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="addResults.php">Add Results</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="calendar.php">
          <i class="fas fa-fw fa-calendar-alt"></i>
          <span>Calendar</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="dashboard.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Profile</li>
          <li class="breadcrumb-item active"><?php include("includes/date.inc.php"); ?></li>
        </ol>

        <!-- Success Alert -->
        <?php

        if (isset($_GET['profileUpdate'])) {
          if ($_GET['profileUpdate'] == "success") {
            echo '<div class="alert alert-info" role="alert">
            Profile successfully updated!
          </div>';
          }
        } else if (isset($_GET['newpwd'])) {
          if ($_GET['newpwd'] == "passworrdupdated") {
            echo '<div class="alert alert-info" role="alert">
            Password successfully updated!
          </div>';
          }
        }
        ?>

        <!-- Profile -->
        <div class="card card-register mx-auto mt-5">
          <div class="card-header">
            <i class="fas fa-user"></i>
            Profile</div>
          <div class="card-body">
            <form action="" method="post">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <p><b>Name:</b> <?php echo ("{$_SESSION['userFname']}" . " " . "{$_SESSION['userSname']}"); ?></p>
                  </div>
                </div>
              </div>
              <?php
              if (isset($_SESSION['child'])) {
                echo '<div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <p><b>Childs Name: </b>' . $_SESSION['childFName'] . ' ' . $_SESSION['childSName'] . '</p>
                    </div>
                  </div>
                </div>';
              }
              ?>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <p><b>Email:</b> <?php echo ("{$_SESSION['userEmail']}"); ?></p>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <p><b>Phone No. :</b> <?php echo ("{$_SESSION['userNo']}"); ?></p>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <p><b>DOB:</b> <?php echo ("{$_SESSION['userDob']}"); ?></p>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <p><b>Height:</b> <?php echo ("{$_SESSION['userHeight']}"); ?> m</p>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <p><b>Weight:</b> <?php echo ("{$_SESSION['userWeight']}"); ?> kg</p>
                  </div>
                </div>
              </div>
              <a name="prf-edit" class="btn btn-danger btn-block text-white" data-toggle="modal" data-target="#editModal">Edit Profile</a>
              <a name="pwd-edit" class="btn btn-danger btn-block text-white" data-toggle="modal" data-target="#pwdModal">Change Password</a>
              <a name="prf-delete" class="btn btn-danger btn-block text-white" data-toggle="modal" data-target="#deleteModal">Delete Account</a>
            </form>
          </div>
        </div>

        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Trackinus Health 2018-<?php $year = date("Y");
                                                      echo $year; ?></span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-danger" href="includes/logout.inc.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Account Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Seleting 'Delete' will remove all of your data.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-danger" href="includes/deleteAcc.inc.php">Delete</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Pwd Modal-->
    <div class="modal fade" id="pwdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Password?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Please enter your new password: </div>
          <form action="includes/editPwd.inc.php" method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="pwd" name="pwd" class="form-control" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="required" autofocus="autofocus">
                <label for="pwd">New password</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="cpwd" name="cpwd" class="form-control" required="required">
                <label for="cpwd">Confirm password</label>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger" name="edit-pwd">Edit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Prf Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Please enter your new information: </div>
          <form action="includes/editPrf.inc.php" method="post">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="text" id="firstName" name="fname" class="form-control" value="<?php echo $fName; ?>" required="required" autofocus="autofocus">
                    <label for="firstName">First name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="lastName" name="sname" class="form-control" value="<?php echo $sName; ?>" required="required">
                    <label for="lastName">Surname</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="mail" class="form-control" value="<?php echo $email; ?>" required="required">
                <label for="inputEmail">Email address</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="num" name="number" class="form-control" value="<?php echo $no; ?>" pattern="^\s*\(?(020[7,8]{1}\)?[ ]?[1-9]{1}[0-9{2}[ ]?[0-9]{4})|(0[1-8]{1}[0-9]{3}\)?[ ]?[1-9]{1}[0-9]{2}[ ]?[0-9]{3})\s*$" required="required">
                <label for="num">Mobile Number</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="number" id="height" name="height" class="form-control" value="<?php echo $height; ?>" step="0.01" min="0.01" max="3.50" required="required">
                    <label for="height">Height (m)</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="number" id="weight" name="weight" class="form-control" value="<?php echo $weight; ?>" min="20" max="250" required="required">
                    <label for="weight">Weight (kg)</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger" name="edit-prf">Edit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="bootstrapDashboard/vendor/jquery/jquery.min.js"></script>
    <script src="bootstrapDashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="bootstrapDashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="bootstrapDashboard/vendor/chart.js/Chart.min.js"></script>
    <script src="bootstrapDashboard/vendor/datatables/jquery.dataTables.js"></script>
    <script src="bootstrapDashboard/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="bootstrapDashboard/js/sb-admin.min.js"></script>

</body>

</html>