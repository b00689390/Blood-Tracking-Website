<?php

session_start();
if (!isset($_SESSION['userId'])) {
  header("Location: login.php");
} else if ($_SESSION['admin'] != '1') {
  header("Location: dashboard.php");
} else {
  if (isset($_SESSION['userId'])) {
    if ((time() - $_SESSION['time']) > 1800) {
      header("Location: includes/logout.inc.php");
    }
  }
}

include("connectDB.php");
$sql = "SELECT * FROM blood_test_table";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Trackinus Health - Admin</title>
  <link rel="shortcut icon" type="image/png" href="img/favicon.png">

  <!-- Bootstrap core CSS-->
  <link href="bootstrapDashboard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="bootstrapDashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="bootstrapDashboard/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="bootstrapDashboard/css/sb-admin.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

</head>

<body id="page-top" class="bg-secondary">

  <nav class="navbar navbar-expand navbar-light bg-light static-top">

    <a class="navbar-brand mr-1" href="admin.php"><img src="img/navbar-logo.png"></a>

    <button class="btn btn-link btn-sm text-black order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <ul class="navbar-nav navbar-right ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          <p class="nav-link dropdown-toggle">Welcome Admin</p>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="includes/logout.inc.php" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>
    </form>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-table"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="adminEdit.php">
          <i class="fas fa-fw fa-database"></i>
          <span>Database</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Blood Tests -->
        <div class="card mb-3 mt-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Test Table</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="testTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Range</th>
                    <th>Units</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Range</th>
                    <th>Units</th>
                    <th>Actions</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  foreach ($result as $row) {
                    echo '
                      <tr>
                      <td>' . $row["blood_test_id"] . '</td>
                      <td>' . $row["test_name"] . '</td>
                      <td>' . $row["test_descr"] . '</td>
                      <td>' . $row["range_lower"] . ' - ' . $row["range_upper"] . '</td>
                      <td>' . $row["range_units"] . '</td>
                      <td><a class="btn btn-danger" href="includes/deleteTest.php?id=' . $row["blood_test_id"] . '">Delete</a></td>
                      </tr>
                      ';
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated <?php

                                                            date_default_timezone_set("Europe/London");
                                                            $date = date("l h:i:s A");
                                                            echo $date;

                                                            ?></div>
        </div>

        <!-- User's Table -->
        <div class="card mb-3 mt-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            User's Table</div>
          <?php
          $result->close();
          $sql = "SELECT * FROM user_profile";
          $result = $conn->query($sql);
          ?>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>DOB</th>
                    <th>Gender</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>DOB</th>
                    <th>Gender</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  foreach ($result as $row) {
                    if ($row['admin'] !== '1') {
                      echo '
                                <tr>
                                <td>' . $row["id"] . '</td>
                                <td>' . $row["firstName"] . ' ' . $row["surname"] . '</td>
                                <td>' . $row["email"] . '</td>
                                <td>' . $row["phoneNumber"] . '</td>
                                <td>' . $row["dob"] . '</td>
                                <td>' . $row["gender"] . '</td>
                                </tr>
                                ';
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated <?php

                                                            date_default_timezone_set("Europe/London");
                                                            $date = date("l h:i:s A");
                                                            echo $date;

                                                            ?></div>
        </div>

        <!-- Blood Group's Table -->
        <div class="card mb-3 mt-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Groups Table</div>
          <?php
          $result->close();
          $sql = "SELECT * FROM blood_groups";
          $result = $conn->query($sql);
          ?>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="groupTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  foreach ($result as $row) {
                    echo '
                      <tr>
                      <td>' . $row["id"] . '</td>
                      <td>' . $row["group_name"] . '</td>
                      <td><a class="btn btn-danger" name="group" href="includes/deleteGroup.php?id=' . $row["id"] . '">Delete</a></td>
                      </tr>
                      ';
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated <?php

                                                            date_default_timezone_set("Europe/London");
                                                            $date = date("l h:i:s A");
                                                            echo $date;

                                                            ?></div>
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
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="bootstrapDashboard/js/demo/datatables.js"></script>
  <script src="bootstrapDashboard/js/demo/testtables.js"></script>
  <script src="bootstrapDashboard/js/demo/grouptables.js"></script>

</body>

</html>