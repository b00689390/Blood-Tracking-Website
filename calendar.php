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
include("includes/deleteNote.php");
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

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
      <li class="nav-item active">
        <a class="nav-link" href="#">
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
          <li class="breadcrumb-item active">Calendar</li>
          <li class="breadcrumb-item active"><?php include("includes/date.inc.php"); ?></li>
        </ol>


        <!-- Add Result -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-calendar"></i>
            Calendar</div>
          <div class="card-body" id="calendar">

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script>
      // https://www.youtube.com/watch?v=_lH9ZwAsvWM -- Tutorial for calendar
      $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
          editable: true,
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          events: 'includes/calendarLoad.php',
          selectable: true,
          selectHelper: true,
          select: function(start, end, allDay) {
            var note = prompt("Enter Calendar Event");
            if (note) {
              var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
              var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
              $.ajax({
                url: "includes/addNote.php",
                type: "POST",
                data: {
                  note: note,
                  start: start,
                  end: end
                },
                success: function() {
                  calendar.fullCalendar('refetchEvents');
                  alert("Added Successfully");
                }
              });
            }
          },
          editable: true,
          eventResize: function(event) {
            var start = $.fullCalendar.formatDate(event.start,
              "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end,
              "Y-MM-DD HH:mm:ss");
            var note = event.note;
            var notes_id = event.notes_id;
            $.ajax({
              url: "includes/updateNote.php",
              type: "POST",
              data: {
                note: note,
                start: start,
                end: end,
                notes_id: notes_id
              },
              success: function() {
                calendar.fullCalendar('refetchEvents');
                alert('Event updated.');
              }
            })
          },
          eventDrop: function(event) {
            var start = $.fullCalendar.formatDate(event.start,
              "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end,
              "Y-MM-DD HH:mm:ss");
            var note = event.note;
            var notes_id = event.notes_id;
            $.ajax({
              url: "includes/updateNote.php",
              type: "POST",
              data: {
                note: note,
                start: start,
                end: end,
                notes_id: notes_id
              },
              success: function() {
                calendar.fullCalendar('refetchEvents');
                alert('Event updated.');
              }
            });
          },
          eventClick: function(event) {
            if (confirm("Are you sure you want to remove note?")) {
              var notes_id = event.notes_id;
              $.ajax({
                url: "includes/deleteNote.php",
                type: "POST",
                data: {
                  notes_id: notes_id
                },
                success: function() {
                  calendar.fullCalendar('refetchEvents');
                  alert("Note Removed");
                }
              })
            }
          }
        });
      });
    </script>

</body>

</html>