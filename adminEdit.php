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

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Trackinus Health - Admin Database</title>
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

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
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
      <li class="nav-item">
        <a class="nav-link" href="admin.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-database"></i>
          <span>Database</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="admin.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Add Test -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Add Test</div>
          <div class="card-body">
            <div class="table-responsive">
              <form action="includes/newTest.inc.php" method="post">
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="text" id="testName" name="testName" class="form-control" placeholder="Test Name" required="required" autofocus="autofocus">
                    <label for="testName">Test Name</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <select id="testGroup" name="testGroup" class="form-control" placeholder="Test Group" required="required" autofocus="autofocus">
                      <option value="">Select Test Group</option>
                      <option value="">None</option>
                      <?php
                      include("connectDB.php");
                      $sql = "SELECT group_name, id FROM blood_groups";
                      $result = $conn->query($sql);

                      foreach ($result as $row) {
                        echo '<option value="' . $row["id"] . '">' . $row["group_name"] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="text" id="testDesc" name="testDesc" class="form-control" placeholder="Test Description" required="required" autofocus="autofocus">
                    <label for="testDesc">Test Desription</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="number" id="lower" name="rangeLow" class="form-control" placeholder="0" step="0.01" min="0.00" max="300.00" value="" required="required" autofocus="autofocus">
                    <label for="lower">Range Lower</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="number" id="upper" name="rangeUp" class="form-control" placeholder="0" step="0.01" min="0.01" max="500.00" value="" required="required" autofocus="autofocus">
                    <label for="upper">Range Upper</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="text" id="units" name="testUnits" class="form-control" placeholder="Test Units" required="required" autofocus="autofocus">
                    <label for="units">Test Units</label>
                  </div>
                </div>
                <button type="submit" class="btn btn-danger btn-block" name="test-submit">Submit</button>
              </form>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated <?php

                                                            date_default_timezone_set("Europe/London");
                                                            $date = date("l h:i:s A");
                                                            echo $date;

                                                            ?></div>
        </div>

        <!-- Update Range -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Update Range</div>
          <div class="card-body">
            <div class="table-responsive">
              <form action="includes/range.inc.php" method="post">
                <div class="form-group">
                  <div class="form-label-group">
                    <select id="bID" name="blood_test_ID" class="form-control" required="required">
                      <?php
                      $sql2 = "SELECT test_name, blood_test_id FROM blood_test_table";
                      $resultSet = $conn->query($sql2);
                      foreach ($resultSet as $row) {
                        echo '<option value="' . $row["blood_test_id"] . '">' . $row["test_name"] . '</option>';
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="number" id="Rlower" name="rangeLower" class="form-control" placeholder="0" step="0.01" min="0.00" max="300.00" value="" required="required" autofocus="autofocus">
                    <label for="Rlower">Range Lower</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="number" id="Rupper" name="rangeUpper" class="form-control" placeholder="0" step="0.01" min="0.01" max="500.00" value="" required="required" autofocus="autofocus">
                    <label for="Rupper">Range Upper</label>
                  </div>
                </div>
                <button type="submit" class="btn btn-danger btn-block" name="test-submit">Submit</button>
              </form>
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

  <!-- Demo scripts for this page-->
  <script src="bootstrapDashboard/js/demo/datatables.js"></script>
  <script src="bootstrapDashboard/js/demo/testtables.js"></script>

</body>

</html>