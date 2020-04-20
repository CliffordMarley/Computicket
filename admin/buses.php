
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
  <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="../css/fonts.css">
  <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../lib/sweetalerts/sweetalert.css">
  <link rel="stylesheet" href="../lib/semantic/dist/semantic.min.css">
	<link rel="stylesheet" href="../lib/datepicker/dist/css/datepicker.css"> 
  <!-- <link rel="stylesheet" href="css/custom.css"> -->

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  
  <script src="js/bus_processes.js"></script>
  <script src="../lib/sweetalerts/sweetalert.min.js"></script>
  <script src="js/transactions.js"></script>
  <script src="../lib/sweetalerts/sweetalert.js"></script>
  <script src="../lib/semantic/dist/semantic.min.js"></script>
  <script src="../lib/datepicker/dist/js/datepicker.js"></script>
  <script>
  </script>

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
        <a href="buses.php" class="list-group-item list-group-item-action bg-light">Bus & Trips</a>
        <a href="hotels.php" class="list-group-item list-group-item-action bg-dark">Hotel </a>
        <a href="events.php" class="list-group-item list-group-item-action bg-dark">Events </a>
        <a href="payments.php" class="list-group-item list-group-item-action bg-dark">Finances </a>
        <a href="accounts.php" class="list-group-item list-group-item-action bg-dark">Accounts </a>
        <a href="config.php" class="list-group-item list-group-item-action bg-dark">Configuration</a>
      </div>
      <div class="container">
        <br><br>
         <div class="row">
         <div class="col-12">
         <button type="button" data-target="#transmodal" id="log_transactions" class="btn btn-md btn-danger btn-block flat-field" data-toggle="modal">
           Log Transaction <i class="fa fa-money-bill-wave"></i>
          </button>
         </div>
         </div>
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
             <a class="nav-link">Logged in as : <span style="color:red;font-family:mali-reg;">
             <?php echo strtoupper($_SESSION["fullname"])."(<span style='color:white;'>".$_SESSION['role']."</span>)";?></span></a>
            </li>
          </ul>
        </div>
      </nav>

     <div class="row">
        <div class="col-12" >
            <div class="row" style="padding:.6em;">
            
            <div class="col-3">
                <div class="ui raised orange segment" style="cursor:pointer;" data-target="#newCompany" data-toggle="modal">
                    <div class="ui grid">
                      <div class="six wide orange column" style="text-align:center;">
                        <h3><i style="font-size:3em;text-align:center;margin-top:.2em;" class="icon chart bar"></i></h3>
                      </div>
                      <div class="ten wide column mini ui statistic">
                          <div class="value" style="font-family:mali-reg;">
                          <?php
                              $company_count = mysqli_query($conn, "SELECT COUNT(*) AS num FROM company_details WHERE indulstry = 1");
                              $row = mysqli_fetch_assoc($company_count); 
                              echo $row['num'];
                          ?>
                        </div>
                          <div class="label" style="font-family:mali-reg;font-size:16px;">Bus Companies</div>
                      </div>
                    </div>
                </div>
              </div>

              <div class="col-3">
                <div class="ui raised blue segment" style="cursor:pointer;" data-target="#newbus" data-toggle="modal">
                    <div class="ui grid">
                      <div class="six wide blue column" style="text-align:center;">
                        <h3><i style="font-size:3em;text-align:center;margin-top:.2em;" class="icon bus"></i></h3>
                      </div>
                      <div class="ten wide column mini ui statistic">
                          <div class="value" style="font-family:mali-reg;"><?php
                              $bus_count = mysqli_query($conn, "SELECT COUNT(*) AS num FROM bus");
                              $row = mysqli_fetch_assoc($bus_count); 
                              echo $row['num'];
                          ?></div>
                          <div class="label" style="font-family:mali-reg;font-size:16px;">Total Buses</div>
                      </div>
                    </div>
                </div>
              </div>

              <div class="col-3">
                <div class="ui raised red segment" style="cursor:pointer;" data-target="#newTrip" data-toggle="modal">
                    <div class="ui grid">
                      <div class="six wide red column" style="text-align:center;">
                        <h3><i style="font-size:3em;text-align:center;margin-top:.2em;" class="icon map alternate marker"></i></h3>
                      </div>
                      <div class="ten wide mini column ui statistic">
                          <div class="value" style="font-family:mali-reg;">
                          <?php
                              $trip_count = mysqli_query($conn, "SELECT COUNT(*) AS num FROM trip");
                              $row = mysqli_fetch_assoc($trip_count); 
                              echo $row['num'];
                          ?>
                        </div>
                          <div class="label" style="font-family:mali-reg;font-size:16px;">Planned Trips</div>
                      </div>
                    </div>
                </div>
              </div>

              <div class="col-3">
                <div class="ui raised green segment">
                    <div class="ui grid">
                      <div class="six wide green column" style="text-align:center;">
                        <h3><i style="font-size:3em;text-align:center;margin-top:.2em;" class="icon users"></i></h3>
                      </div>
                      <div class="ten wide column ui mini statistic">
                      <div class="label" style="font-family:mali-reg;font-size:16px;">Seats Booked</div>
                          <div class="value" style="font-family:mali-reg;">
                          <?php
                              $seats_count = mysqli_query($conn, "SELECT SUM(seats_reserved) AS seats FROM bus_reservation");
                              $row = mysqli_fetch_assoc($seats_count); 
                              echo $row['seats'];
                          ?>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              
            </div>
            <div class="ui divider"></div>
        </div>

        
     </div>
    
     <section class="col-12" id="booking_request" style="display: none;">
       <div class="row">
         <div class="col-12">
            <h3 class="bg-dark" style="font-family:nuni-reg;font-weight:bold; color:white;padding:.3em;width:100%;text-align:center;"
            >Viewing All Pending Booking Requests
            </h3>
         </div>
         <div class="col-9">
            <table class="table table-sm table-striped">
              <thead id="bar">
                <th id="hh">ReferenceID</th>
                <th id="hh">CustomerName</th>
                <th id="hh">Contact Information</th>
                <th id="hh">Bus Company</th>
                <th id="hh">Seats</th>
                <!-- <th id="hh">TotalCost</th> -->
                <!-- <th id="hh">TravelRoute</th> -->
                <th id="hh">DepartureDate </th>
                <th id="hh">TravelTime</th>
                <th id="hh">
                <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" onchange="prepActionAllRequests()" data-toggle="toggle"/>
                        <label class="form-check-label" for="inlineCheckbox1">All</label>
                </div>
                </th>
              </thead>
              <tbody  id="table_area">
                <?php

                  $reservation = mysqli_query($conn, "SELECT bus_reservation.reservation_id, 
                  bus_reservation.customer_name,
                  bus_reservation.email_address,
                  bus_reservation.phone_number,
                  bus_reservation.seats_reserved,
                  bus_reservation.amount, company_details.company_name, 
                  trip.route, trip.departure_time,
                   trip.arrival_time, trip.departure_date,
                  bus.bus_id, bus.type FROM bus_reservation JOIN company_details JOIN bus JOIN trip
                  WHERE bus_reservation.trip_id = trip.trip_id AND trip.bus_id = bus.bus_id AND bus.company = company_details.company_id ORDER BY bus_reservation.stamp");
                  while($row = mysqli_fetch_assoc($reservation)){?>
                   <tr>
                     <th class="data"><?php echo $row['reservation_id'] ?></th>
                     <th class="data"><?php echo $row['customer_name'] ?></th>
                     <th class="data"><?php echo $row['phone_number']." </br>".$row['email_address'] ?></th>
                     <th class="data"><?php echo $row['company_name']." (".strtoupper($row['type'])."), ".$row['bus_id']?></th>
                     <th class="data"><center><?php echo $row['seats_reserved'] ?></center></th>
                     <!-- <th class="data">K<?php //echo $row['amount'] ?></th>
                     <th class="data"><?php //echo $row['route'] ?></th> -->
                     <th class="data"><?php echo strtoupper(date('F jS, Y', strtotime($row['departure_date']))); ?></th>
                      <th class="data"><?php echo strtoupper(date("g:i a", strtotime($row['departure_time'])))." - ".strtoupper(date("g:i a", strtotime($row['arrival_time'])) )?></th>
                      <th>
                      <div class="form-check form-check-inline">
                            <input class="form-check-input"  onchange="preprequestAction(<?php echo $row['reservation_id'] ?>)" type="checkbox" id="inlineCheckbox1" value="option1">
                          </div>
                      </th>
                   </tr>
                 <?php 
                 }
                ?>
              </tbody>
            </table>
         </div>
         <div class="col-3">
            <div class="ui grid">
                 <div class="sixteen wide column">
                    <section class="ui segment" style="margin-top:.5em;">
                      <h3 style="font-family:mali-reg;color:green;text-align:center;text-decoration:underline;">Search Filters</h3>
                      <div class="ui divider"></div>
                      <form action="#">
                        <div class="form-group">
                          <label for="">Reservation Code :</label>
                          <input type="text" class="form-control form-control-sm flat-field" placeholder="e.g BRID-0001">
                        </div>
                        <div class="form-group">
                          <label for="">Customer Name :</label>
                          <input type="text" class="form-control form-control-sm flat-field" placeholder="e.g John Smith">
                        </div>
                        <div class="form-group">
                          <label for="">Bus Company :</label>
                          <select id="s_bus_company" class="form-control form-control-sm">
                          <option selected disabled>Select bus here</option>
                            <?php
                                $get_buses = mysqli_query($conn, "SELECT * FROM bus JOIN company_details 
                                WHERE bus.company = company_details.company_id ORDER BY company_details.company_name, bus.type DESC");
                                $cid = "unset";
                                while($row = mysqli_fetch_assoc($get_buses)){
                                  if($cid !== $row["company_name"]){
                                    echo "<option disabled></option>";
                                    $cid = $row["company_name"];
                                }
                                  echo "<option value='".$row['bus_id']."'>".$row['company_name']." ( ".strtoupper($row['type'])." ), ".$row['bus_id']."</option>";
                                }
                            ?> 
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="">Bus Reg # :</label>
                          <input type="text" class="form-control form-control-sm flat-field" placeholder="e.g LL9876">
                        </div>
                        <div class="form-group">
                          <button id="search_btn" class="btn btn-md btn-block flat-field btn-primary">
                            SEARCH <i class="fa fa-search"></i>
                          </button>
                        </div>
                      </form>
                    </section>
                 </div>
            </div>
         </div>
       </div>
     </section>


     <div class="col-12" id="trip_metrics" style="">
          <div class="row">
            <div class="col-8">
                <div class="ui segment blue row" style="padding:0;">
                 <div class="col-12"> <h3 style="width:100%;color:black;" id="hh">Upcoming Trips <i class="icon cancel" style="float:right;"></i></h3></div>
                  <div class="col-12 table-responsive" style="padding:.2em;">
                    <table class="table table-striped table-sm">
                      <thead id="" class="red">
                        <th id="hh">SN</th>
                        <th id="hh">Bus Service</th>
                        <th id="hh">Bus Assigned</th>
                        <th id="hh">Travel-Route</th>
                        <th id="hh">Date</th>
                        <th id="hh">Time Interval</th>
                        <th id="hh">#-AS</th>
                        <th id="hh">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" data-toggle="toggle" name="paytime" checked type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">All</label>
                          </div>
                        </th>
                      </thead>
                      <tbody>
                        <?php
                          $trip = mysqli_query($conn, "SELECT * FROM trip JOIN bus JOIN company_details 
                          WHERE bus.company = company_details.company_id AND trip.bus_id = bus.bus_id 
                          ORDER BY trip.departure_date, trip.departure_time ASC");
                          while($row = mysqli_fetch_assoc($trip)){
                            $d_time = date("g:i a", strtotime($row['departure_time']));
                            $a_time = date("g:i a", strtotime($row['arrival_time']));
                              echo "
                                  <tr id='".$row['trip_id']."'>
                                      <td class='data'>".$row['trip_id']."</td>
                                      <td class='data'>".$row['company_name']."</td>
                                      <td class='data'>".$row['bus_id']."</td>
                                      <td class='data'>".$row['route']."</td>
                                      <td class='data'>".date('F jS, Y', strtotime($row['departure_date']))."</td>
                                      <td class='data'>".$d_time." - ".$a_time."</td>
                                      <td class='data'>".$row['avail_seats']."</td>
                                      <td><input type='checkbox' onchange='prepTripAction(".$row['bus_id'].")'/></td>
                                  </tr>";
                              }
                        ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
            <div class="col-4">
                <div class="ui segment blue row" style="padding:0;">
                <div class="col-12"> <h3 style="width:100%;color:black;" id="hh">Bus List<i class="icon cancel" style="float:right;"></i></h3></div>
                <div class="col-12 table-responsive" style="padding:.2em;">
                    <table class="table table-striped table-sm">
                      <thead class="blue">
                          <th id="hh">#</th>
                          <th id="hh">Bus_Service</th>
                          <th id="hh">Licence_#</th>
                          <th id="hh">Type</th>
                          <th id="hh">#Seats</th>
                          <th id="hh">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" data-toggle="toggle" name="paytime" checked type="checkbox" id="inlineCheckbox1" value="option1">
                              <label class="form-check-label" for="inlineCheckbox1">All</label>
                            </div>
                          </th>
                      </thead>
                      <tbody>
                        <?php
                          $buses = mysqli_query($conn, "SELECT * FROM bus JOIN company_details
                           WHERE bus.company = company_details.company_id ORDER BY company_details.company_name ASC");
                           $count = 1;
                           while($row = mysqli_fetch_assoc($buses)){
                              echo "<tr id=".$row['bus_id'].">
                                      <td class='data'>".$count."</td>
                                      <td class='data'>".$row['company_name']."</td>
                                      <td class='data'>".$row['bus_id']."</td>
                                      <td class='data'>".strtoupper($row['type'])."</td>
                                      <td class='data'><center>".$row['num_seats']."</center></td>
                                      <td><input type='checkbox' onchange='prepBusAction(".$row['bus_id'].")'/></td>
                                    </tr>";
                                    $count++;
                           }
                        ?>
                        <!--  -->
                      </tbody>
                    </table>
                </div>
                </div>
            </div>
          </div>
        </div>
        
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

     $(".nav-tabs a").click(function(){
     $(this).tab('show');
     });
  </script>

<!-- Client Aid Modal -->
<?php
  require("newCompanyModal.php");
?>
<!-- Modal -->
<div class="modal fade" id="newbus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hiiden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header blue">
              <h5 class="modal-title" id="exampleModalCenterTitle" style="color:white; font-family:mali-reg;">NEW BUS ENTRY</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hiiden="true">&times;</span>
              </button>
            </div>

            <form class="modal-body" action="php_scripts/addBus.php" method="GET" enctype="multipart/form-data">
              <div class="row">
                <div class="col-6">
                  <label for="">Car Registration #</label>
                  <input type="text" placeholder="Registration Number" class="form-control form-control-sm" id="reg_number" name="reg_number">
                </div>
                <div class="col-6 form-group">
                        <label for="Company name">Assoc Company / Owner</label>
                        <select id="company" name="company" class="form-control form-control-sm">
                            <option selected disabled>Select Company</option>
                            <?php
                                $opt = mysqli_query($conn, "SELECT * FROM company_details WHERE indulstry = 1 ORDER BY company_name ASC");
                                while($row = mysqli_fetch_assoc($opt)){
                                    echo "<option value=".$row['company_id'].">".$row['company_name']."</option>";
                                }
                            ?>
                        </select>
                    </div>
              </div>
                <div class="row">
                    <div class="form-group col-6">
                      <label for="">Bus Type</label>
                        <select id="bus_type" name="bus_type" class="form-control form-control-sm">
                            <option selected disabled>Select type</option>
                            <option value="minibus">Minibus</option>
                            <option value="coaster">Coaster</option>
                            <option value="coach">Coach</option>
                            <option value="Double Decker">Double Decker</option>
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for=""># Seats</label>
                        <input type="number" class="form-control form-control-sm" min="14" value="14" placeholder="" id="num_seats" name="num_seats">
                    </div>
                    <div class="col-12 form-group">
                      <label for="">Images</label>
                      <div class="custom-file">
                            <input type="file" class="custom-file-input" name="images" multiple>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                    </div>
                    <div class="col-12 form-group">
                        <label for="">Description</label>
                        <textarea  name="description" id="description" rows="5" class="form-control form-control-sm" placeholder="Write description here e.g Color, weight and others..."></textarea>
                    </div>
                </div>
              </form>
            <div class="modal-footer">
              <button type="reset" id="modal_dismiss" class="btn btn-secondary btn-sm flat-field" data-dismiss="modal">DISCARD</button>
              <input type="submit" id="submit_bus" class="btn btn-primary btn-sm flat-field" value="ADD BUS">
            </div>
          </div>
        </div>
      </div>
<!-- Modal Ends here -->



<!--Set Trip Modal -->
<div class="modal fade" id="newTrip" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hiiden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header red">
              <h5 class="modal-title" id="exampleModalCenterTitle" style="color:white; font-family:mali-reg;">SET NEW TRIP</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hiiden="true">&times;</span>
              </button>
            </div>

            <form class="modal-body">
              <div class="row">
                <div class="col-6 form-group">
                  <label for="">Origin</label>
                  <select id="origin"  class="form-control form-control-sm">
                            <option selected disabled>Select origin</option>
                            <?php
                                 $district = mysqli_query($conn, "SELECT * FROM district ORDER BY district_name ASC");
                                 while($row = mysqli_fetch_assoc($district)){
                                     echo "<option value=".$row['district_id'].">".$row['district_name']."</option>";
                                 }
                            ?>
                        </select>
                              </div>
                      <div class="col-6 form-group">
                        <label >Destination</label>
                        <select id="destination" class="form-control form-control-sm">
                            <option selected disabled>Select Destination</option>
                            <?php
                             $district = mysqli_query($conn, "SELECT * FROM district ORDER BY district_name ASC");
                             while($row = mysqli_fetch_assoc($district)){
                                 echo "<option value=".$row['district_id'].">".$row['district_name']."</option>";
                             }
                            ?>
                        </select>
                    </div>
              </div>
                <div class="row">
                    <div class="form-group col-6">
                      <label for="">Travel Date</label>
                      <input type="date" placeholder="DD/MM/YYYY" class="form-control form-control-sm" id="dept_date">
                    </div>
                    <div class="col-3 form-group">
                        <label for="">Detp Time</label>
                        <input type="time" class="form-control form-control-sm timepicker"  id="dept_time">
                    </div>
                    <div class="col-3 form-group">
                        <label for="">Arrival Time</label>
                        <input type="time" class="form-control form-control-sm timepicker"  id="arrival_time">
                    </div>
                </div>
                <div class="row">
                <div class="col-12 form-group">
                  <label for="">Assign Bus</label>
                  <select id="bus"  class="form-control form-control-sm">
                            <option selected disabled>Select bus here</option>
                            <?php
                                $get_buses = mysqli_query($conn, "SELECT * FROM bus JOIN company_details 
                                WHERE bus.company = company_details.company_id ORDER BY company_details.company_name, bus.type DESC");
                                $cid = "unset";
                                while($row = mysqli_fetch_assoc($get_buses)){
                                  if($cid !== $row["company_name"]){
                                    echo "<option disabled></option>";
                                    $cid = $row["company_name"];
                                }
                                  echo "<option value='".$row['bus_id']."'>".$row['company_name']." ( ".strtoupper($row['type'])." ), ".$row['bus_id']."</option>";
                                }
                            ?> 
                        </select>
                              </div>
                      <div class="col-12 form-group">
                        <label >Demarcate Travel Route</label>
                        <input type="text" placeholder ="e.g LL-DZ-NTH-BLK-MHN-ZA-BT" class="form-control form-control-sm" id="route">
                    </div>
              </div>
              <input type="reset" hidden id="reset_modal">
              </form>
            <div class="modal-footer">
              <button type="reset" id="modal_dismiss" class="btn btn-secondary btn-sm flat-field" data-dismiss="modal">DISCARD</button>
              <input type="button" id="schedule_trip" class="btn btn-success btn-sm flat-field" value="SCHEDULE TRIP">
            </div>
          </div>
        </div>
      </div>
<!--set Trip Modal Ends here -->

<!-- TRANSACTIONS MODAL STARTS HERE -->

<div class="modal fade" id="transmodal" tabindex="-1" role="dialog" aria-labelledby="transaction-modal" aria-hiiden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header red">
              <h5 class="modal-title" id="exampleModalCenterTitle" style="color:white; font-family:mali-reg;txet-align:center;">TRANSACTION LOG</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hiiden="true">&times;</span>
              </button>
            </div>
              <div class="modal-body">
                  <form class="row">
                  <div class="col-12 form-group">
                      <label for="">Payment Network / Service</label>
                      <select class="form-control form-control-d flat-field" id="money_service">
                        <option selected disabled>Select Money Servive</option>
                        <option value="Mo626">Mo 626</option>
                        <option value="Airtel-Money">Airtel Money</option>
                        <option value="TNM Mpamba">TNM Mpamba</option>
                        <option value="FDH-Mobile">FDH Mobile</option>
                      </select>
                    </div>
                    <div class="col-6 form-group">
                      <label for="">Transaction ID</label>
                      <input class="form-control form-control-d flat-field" type="text" id="transid1" placeholder="Enter TransID Here...">
                    </div>
                    <div class="col-6 form-group">
                      <label for="">Confirm Transaction ID</label>
                      <input class="form-control form-control-md flat-field" type="text" id="transid2" placeholder="Confirm TransID Here...">
                    </div>
                    <div class="col-6 form-group">
                      <label class="custom-label">Enter Amount Here</label>
                      <input class="form-control form-control-md flat-field" type="number" value ="" placeholder="e.g 10000" id="amount1">
                  </div>
                  <div class="col-6 form-group">
                      <label class="custom-label">Confirm Amount Here</label>
                      <input class="form-control form-control-md flat-field" type="number" value="" placeholder="Confirm amount.." id="amount2">
                  </div>
                              </form>
                              </div>
            <div class="modal-footer">
            <button type="reset" id="modal_dismiss3" class="btn btn-secondary btn-sm flat-field" data-dismiss="modal">IGNORE</button>
            <button type="button"  id="log_transaction_btn" class="btn btn-primary btn-sm flat-field">LOG NOW <i class="fa fa-cash-register"></i></button>
            </div>
 </div>

<!-- TRANSACTIONS MODAL ENDS HERE -->
<footer id="footer" class="ui bottom fixed attached label">
          copyright&copy;2019 - All Rights Reserved <span>COMPUTICKETMW</span>
</footer>

</body>

</html>
