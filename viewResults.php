<?php

session_start();
if (!isset($_SESSION['userId'])) {
  header("Location: login.php");
} else if ($_SESSION['admin'] == '1') {
  header("Location: admin.php");
} else if ($_SESSION['result'] == '1') {
  header("Location: addResult.php");
} else {
  if (isset($_SESSION['userId'])) {
    if ((time() - $_SESSION['time']) > 1800) {
      header("Location: includes/logout.inc.php");
    }
  }
}
date_default_timezone_set("Europe/London");
$date = date("l h:i:s A");

include("connectDB.php");

if (isset($_POST['view-result-submit'])) {
  $_SESSION['chart'] = $_POST['blood_test_id'];
}

if (isset($_POST['view-result-reset'])) {
  unset($_SESSION['chart']);
  header("Location: viewResults.php");
  exit();
}

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
  <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

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
            <a class="dropdown-item" href="profile.php">Profile</a>
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
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Results</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="#">View Results</a>
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
          <li class="breadcrumb-item active">View Results</li>
          <li class="breadcrumb-item active"><?php include("includes/date.inc.php"); ?></li>
        </ol>

        <!-- Success Alert -->
        <?php
        if (isset($_GET['delete'])) {
          if ($_GET['delete'] == "success") {
            echo '<div class="alert alert-info" role="alert">
                    Result successfully deleted!
                  </div>';
          }
        }
        ?>

        <!-- View Result -->
        <?php
        $id = $_POST['blood_test_id'];

        $sql = "SELECT DISTINCT blood_test_table.blood_test_id, blood_test_table.test_name
                FROM blood_reults_table 
                JOIN blood_test_table 
                ON blood_reults_table.blood_test_id = blood_test_table.blood_test_id 
                WHERE blood_reults_table.user_id = '" . $_SESSION['userId'] . "'";
        $result = $conn->query($sql);

        if (isset($_POST['view-result-submit'])) {

          $sql = "SELECT blood_test_table.blood_test_id, blood_test_table.test_name, blood_test_table.range_units, 
                  blood_reults_table.result_date, blood_reults_table.result, blood_reults_table.lower, 
                  blood_reults_table.upper, blood_reults_table.blood_results_id
                  FROM blood_reults_table 
                  JOIN blood_test_table 
                  ON blood_reults_table.blood_test_id = blood_test_table.blood_test_id 
                  WHERE blood_reults_table.user_id = '" . $_SESSION['userId'] . "' 
                  AND blood_test_table.blood_test_id = '$id' ";
          $result = $conn->query($sql);
        }
        ?>
        <div class="card card-register mx-auto mt-5">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Select a Test</div>
          <div class="card-body">
            <?php
            if (!isset($_POST['view-result-submit'])) {
              echo '<form action="viewResults.php" method="post">
                          <div class="form-group">
                              <div class="form-row">
                                  <div class="col-md-12 ">
                                      <div class="form-label-group">
                                          <select id="id" name="blood_test_id" class="form-control" required>
                                            <option value="">Select a Test</option>
                                            ';
              foreach ($result as $row) {
                echo '<option value="' . $row["blood_test_id"] . '">' . $row["test_name"] . '</option>';
              }
              echo '
                                          </select>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <button type="submit" name="view-result-submit" class="btn btn-danger btn-block">Show Results</button>
                        </form>';
            } else {
              echo '<form action="viewResults.php" method="post">
                        <button type="submit" name="view-result-reset" class="btn btn-danger btn-block">Reset</button>
                      </form>';
            }
            ?>

          </div>
        </div>
        <div class="container-fluid">
          <br />

          <!-- Area Chart Results-->
          <?php
          if (isset($_POST['view-result-submit'])) {
            echo '
              <div class="card mb-3">
                <div class="card-header">
                  <i class="fas fa-chart-area"></i>
                  Results Chart
                </div>
                <div class="card-body">
                  <canvas id="selectedAreaChart" width="100%" height="30" ></canvas>
                </div>
                <div class="card-footer small text-muted">Updated  ';
            echo $date;
            echo '</div>
              </div>';
          }
          ?>

          <!-- DataTables Results -->
          <?php
          if (isset($_POST['view-result-submit'])) {
            echo '
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-table"></i>
                Results Table</div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Result</th>
                        <th>Test</th>
                        <th>Range (lower)</th>
                        <th>Range (upper)</th>
                        <th>Actions</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Date</th>
                        <th>Result</th>
                        <th>Test</th>
                        <th>Range (lower)</th>
                        <th>Range (upper)</th>
                        <th>Actions</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                    <tbody>';

            foreach ($result as $row) {
              if (isset($_POST['view-result-submit'])) {
                echo '
                        <tr>
                        <td>' . $row["result_date"] . '</td>
                        <td>' . $row["result"] . ' ' . $row["range_units"] . '</td>
                        <td>' . $row["test_name"] . '</td>
                        <td>' . $row["lower"] . '</td>
                        <td>' . $row["upper"] . '</td>
                        <td><a class="btn btn-secondary" href="editResult.php?id=' . $row["blood_results_id"] . '">Edit</a></td>
                        <td><a class="btn btn-danger" href="includes/deleteResult.php?id=' . $row["blood_results_id"] . '">Delete</a></td>
                        </tr>
                        ';
              }
            }
            echo '
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer small text-muted">Updated  ' . $date . ' </div>
            </div>';
          }
          ?>

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
    <script src="javascript/db.SelectedChart.js"></script>
    <script src="bootstrapDashboard/js/demo/datatables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

</body>

</html>