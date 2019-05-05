<?php

session_start();
if (!isset($_SESSION['userId'])) {
  header("Location: login.php?error=nologin");
} else if ($_SESSION['admin'] == '1') {
  header("Location: admin.php");
} else if ($_SESSION['result'] == '1') {
  header("Location: addResult.php?login=success");
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
  <?php
  include("includes/notify.inc.php");
  ?>

  <nav class="navbar navbar-expand navbar-light bg-light static-top">

    <a class="navbar-brand mr-1" href="dashboard.php"><img src="img/navbar-logo.png"></a>

    <button class="btn btn-link btn-sm text-black order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>


    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-sm-3 my-2 my-sm-0 static-top">

      <!-- Navbar -->
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
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
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
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
          <li class="breadcrumb-item active"><?php include("includes/date.inc.php"); ?></li>
        </ol>

        <!-- Success Alert -->
        <?php

        if (isset($_GET['resultAdd'])) {
          if ($_GET['resultAdd'] == "success") {
            echo '<div class="alert alert-info" role="alert">
                    Result has been successfully added!
                  </div>';
          }
        } else if (isset($_GET['login'])) {
          if ($_GET['login'] == "success") {
            echo '<div class="alert alert-info" role="alert">
                    Welcome back ' . $_SESSION["userFname"] . '
                  </div>';
          }
        } else if (isset($_GET['error'])) {
          if ($_GET['error'] == "noresult") {
            echo '<div class="alert alert-danger text-white" role="alert">
                    Page cannot be accessed! Result required to edit.
                  </div>';
          }
        } else if (isset($_GET['resultUpdate'])) {
          if ($_GET['resultUpdate'] == "success") {
            echo '<div class="alert alert-info" role="alert">
                    Result has been successfully updated!
                  </div>';
          }
        }
        ?>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-calendar"></i>
                </div>
                <div class="mr-5"><?php include('includes/event.inc.php'); ?> Upcoming Events!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="calendar.php">
                <span class="float-left">View Events</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="far fa-check-circle"></i>
                </div>
                <div class="mr-5"><?php include('includes/testCount.inc.php'); ?> Results Submitted!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="viewResults.php">
                <span class="float-left">View Result</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-dark o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-syringe"></i>
                </div>
                <div class="mr-5"><?php include('includes/rangeCount.inc.php'); ?> Result(s) Out of Range!</div>
                <div class="mr-5 small z-1">In the last 30 days.</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#" data-toggle="modal" data-target="#rangeModal">
                <span class="float-left">View All Out of Range</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="mr-5"><?php include('includes/days.inc.php'); ?> Days Since Last Test!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="addResults.php">
                <span class="float-left">Add New Result</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>

        <!-- Area Chart Home-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Results Chart (Last 10 Days)</div>
          <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
          </div>
          <div class="card-footer small text-muted">Updated <?php
                                                            date_default_timezone_set("Europe/London");
                                                            $date = date("l h:i:s A");
                                                            echo $date;

                                                            ?></div>
        </div>

        <!-- DataTables Home -->
        <?php
        $sql = "SELECT * FROM blood_reults_table JOIN blood_test_table ON blood_reults_table.blood_test_id = blood_test_table.blood_test_id WHERE blood_reults_table.user_id = '" . $_SESSION['userId'] . "' ORDER BY blood_reults_table.result_date DESC";
        $result = $conn->query($sql);
        ?>
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            All Results Table</div>
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
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Date</th>
                    <th>Result</th>
                    <th>Test</th>
                    <th>Range (lower)</th>
                    <th>Range (upper)</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  foreach ($result as $row) {
                    echo '
                      <tr>
                       <td>' . $row["result_date"] . '</td>
                       <td>' . $row["result"] . ' ' . $row["range_units"] . '</td>
                       <td>' . $row["test_name"] . '</td>
                       <td>' . $row["lower"] . '</td>
                       <td>' . $row["upper"] . '</td>
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

  <!-- Out Of Range Modal-->
  <div class="modal fade" id="rangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Result out of range</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Result</th>
                  <th>Test</th>
                  <th>Range (lower)</th>
                  <th>Range (upper)</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Date</th>
                  <th>Result</th>
                  <th>Test</th>
                  <th>Range (lower)</th>
                  <th>Range (upper)</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                $sql = "SELECT * FROM blood_reults_table JOIN blood_test_table ON blood_reults_table.blood_test_id = blood_test_table.blood_test_id 
                        WHERE blood_reults_table.user_id = '" . $_SESSION['userId'] . "' AND blood_reults_table.out_of_range = '1' ORDER BY blood_reults_table.result_date DESC";
                $result = $conn->query($sql);
                foreach ($result as $row) {
                  echo '
                    <tr>
                      <td>' . $row["result_date"] . '</td>
                      <td>' . $row["result"] . ' ' . $row["range_units"] . '</td>
                      <td>' . $row["test_name"] . '</td>
                      <td>' . $row["lower"] . '</td>
                      <td>' . $row["upper"] . '</td>
                    </tr>
                    ';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
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
  <script src="javascript/db.Chart.js"></script>

</body>

</html>