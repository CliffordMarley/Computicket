<?php
    session_start();
    if(!isset($_SESSION['access']) && $_SESSION['access'] != "granted" || (time() - $_SESSION['timeout']) > 1200){
      session_destroy();
      header("LOCATION:cgi-bin.php");
    }
    $_SESSION['timeout'] = time();
    include_once("php_scripts/db_conn.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Computicket Admin Dashboard</title>
  <link rel="icon" href="../assets/img/Computicket.jpg" type="image/jpg">

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="../css/fonts.css">
  <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../lib/sweetalerts/sweetalert.css">
  <link rel="stylesheet" href="../lib/semantic/dist/semantic.min.css">
  <link rel="stylesheet" href="../lib/datepicker/dist/css/datepicker.css">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="js/events.js"></script>
  <script src="../lib/sweetalerts/sweetalert.min.js"></script>
  <script src="../lib/sweetalerts/sweetalert.js"></script>
  <script src="../lib/datepicker/dist/js/datepicker.js"></script>
  <script src="../lib/semantic/dist/semantic.min.js"></script>
</head>

<body>

<div class="d-flex" id="wrapper">

<!-- Sidebar -->
<div class="bg-dark border-dark" id="sidebar-wrapper">
<div class="sidebar-heading" style="color:white;font-family:electra;">Compu<span style="color:red;">ticket</span></div>
  <div class="list-group list-group-flush">
    <a href="dashboard.php" class="list-group-item list-group-item-action bg-dark">Dashboard</a>
    <a href="index.php" class="list-group-item list-group-item-action bg-dark">Merchants </a>
    <a href="car-rental.php" class="list-group-item list-group-item-action bg-dark">Car Rentals</a>
    <a href="buses.php" class="list-group-item list-group-item-action bg-dark">Bus & Trips</a>
    <a href="hotels.php" class="list-group-item list-group-item-action bg-dark">Hotel </a>
    <a href="events.php" class="list-group-item list-group-item-action bg-light">Events </a>
    <a href="payments.php" class="list-group-item list-group-item-action bg-dark">Finances </a>
    <a href="accounts.php" class="list-group-item list-group-item-action bg-dark">Accounts </a>
    <a href="config.php" class="list-group-item list-group-item-action bg-dark">Configuration</a>
  </div>
</div>
<!-- /#sidebar-wrapper -->

<!-- Page Content -->
<div id="page-content-wrapper">

 
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
    <button class="btn btn-primary btn-sm flat-field" id="menu-toggle">Extend Page</button>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a  class="nav-link">Logged in as : <span style="color:red;font-family:mali-reg;">
          <?php echo strtoupper($_SESSION["fullname"])."(<span style='color:white;'>".$_SESSION['role']."</span>)";?></span></a>
        </li>
      </ul>
    </div>
  </nav>

    <div class="container-fluid">
        <div class="row">
        <!-- ACTION BUTTONS START -->
            <div class="col-10" style="padding:.4em;">
                <div class="row">
                    <div class="col-3">
                        <button class="btn btn-block btn-md btn-primary flat-field">MANAGE EVENTS</button>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-block btn-md btn-success flat-field">MANAGE TICKETS</button>
                    </div>
                   
                </div>
                <div class="ui divider"></div>
                <h3 class="title" style="text-align:center;color:white;
                background:gray;font-family:mali-reg;width:100%;padding:.4em;">Viewing Upcoming Events</h3>
                

                <main class="row">
                    <div class="col-12" id="tables">
                        <table id="events_table" class="ui table table-striped mini">
                            <thead class="bg-dark">
                                <th id="hh">#</th>
                                <th id="hh">Events Name</th>
                                <th id="hh">Organiser</th>
                                <th id="hh">Event Type</th>
                                <th id="hh">Venu / Location</th>
                                <th id="hh">Date_Of_Event</th>
                                <th id="hh">Start_Time</th>
                                <th id="hh">
                                  <input type="checkbox" id="checkAllEvents">
                                </th>
                            </thead>
                            <tbody id="events_table_body">
                                <?php 
                                    $get_events = mysqli_query($conn, "SELECT * FROM events WHERE status = 'upcoming'");
                                    $count = 1;
                                    while($row = mysqli_fetch_assoc($get_events)){
                                      $coloring = "ui positive";
                                      if($row['status'] == "deleted"){
                                        $coloring = "ui negative";
                                      }else if($row['status'] == "cancelled"){
                                        $coloring = "ui orange";
                                      }
                                        echo "<tr id='".$row['event_id']."' class='".$coloring."'>
                                                <td class='data'>".$count."</td>
                                                <td class='data'>".strtoupper($row['event_name'])."</td>
                                                <td class='data'>".strtoupper($row['organiser'])."</td>
                                                <td class='data'>".strtoupper($row['type'])."</td>
                                                <td class='data'>".strtoupper($row['venue'])."</td>
                                                <td class='data'>".strtoupper(date('F jS, Y', strtotime($row['event_date'])))."</td>
                                                <td class='data'>".strtoupper(date("g:i a", strtotime($row['event_time'])))."</td>
                                                <td class='data'>
                                                    <input type='checkbox' class='toggleEventCheck' onclick = toggleSelection('".$row['event_id']."')>
                                                </td>
                                            </tr>";
                                            $count++;
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        <!-- ACTION BUTTONS END -->

            <div class="col-2" style="border-left:thick solid black;height:100%;">
                <div class="row">
                <h4 style="background:black;color:white;font-family:electra;
                width:100%;padding:.4em;text-align:center;margin-bottom:1.2em;">Actions</h4>
                    <div class="col-12" style="margin-bottom:1em;">
                        <button data-target="#newEvent" data-toggle="modal" type="button"  class="btn btn-block btn-md btn-success flat-field">ADD EVENT <i class="icon plus"></i></button>
                    </div>
                    <div class="col-12" style="margin-bottom:1em;">
                        <button class="btn btn-block btn-md btn-warning flat-field">EDIT <i class="icon edit"></i></button>
                    </div>
                    <div class="col-12" style="margin-bottom:1em;">
                        <button type="button" id="delete_event_btn" class="btn btn-block btn-md btn-danger flat-field">DELETE <i class="icon trash"></i></button>
                    </div>
                </div>
            </div>
        </div>

        

    </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

<!-- Client Aid Modal -->
<?php require("addEvent.php");?>
<?php include("loader.php");?>
</body>

</html>
