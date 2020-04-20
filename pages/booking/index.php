<?php
    session_start();
    include_once("../../backend/controller/db_conn.php");
   // error_reporting(1);
    /*TransID=252861E1-2577-4A8C-8F2F-DCFEE33274B0&CCDapproval=4444444438&PnrID=EVT-8346&TransactionToken=252861E1-2577-4A8C-8F2F-DCFEE33274B0&CompanyRef=EVT-8346*/
    $message = "";
    //echo $_GET["TransactionToken"];
    if(isset($_GET['TransID']) && isset($_GET['TransactionToken'])){
    	include("../../backend/controller/DPOIntegration.php");
		$res = verifyToken($_GET['TransactionToken'],$_GET["CompanyRef"]);
		$message = "<div class='ui ".$res['status']." message'>
						<i class='close icon'></i>
						<div class='header'>
							".strtoupper($res['title'])."
						</div>
						".$res['message']."
					</div>";
	}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
    <title>Bus Reservation</title>
	<link rel="icon"  type="image/png" href="../../assets/img/Computicket.jpg">
	
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
	<link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../lib/semantic/dist/semantic.min.css">
	<link rel="stylesheet" href="../../css/common.css">
	<link rel="stylesheet" href="../../css/booking.css">
	<link rel="stylesheet" href="../../css/fonts.css">
	<link rel="stylesheet" href="../../lib/sweetalerts/sweetalert.css">
	<link rel="stylesheet" href="../../lib/datepicker/dist/css/datepicker.css"> 

	<script type="text/javascript" src="../../js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="../../js/general.js"></script>
	<script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../lib/semantic/dist/semantic.min.js"></script>
	<script type="text/javascript" src="../../lib/sweetalerts/sweetalert.js"></script>
	<script type="text/javascript" src="../../lib/sweetalerts/sweetalert.min.js"></script>
	<script type="text/javascript" src="../../js/bus_ticket_booking.js"></script>
	<script src="../../lib/datepicker/dist/js/datepicker.js"></script>
</head>
<body  stylw="padding:5em;">
	 <!-- Navbar start here  -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
			<a class="navbar-brand" id="brand_image">
				<div class="ui image tiny">
					<img src="../../assets/img/logo-main.png" alt="">
				</div>
			</a>
			<a class="navbar-brand" style="display:none;" id="brand_txt">
				Compu<span style="color:red;font-family:nuni-reg;">ticket</span>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="../home">HOME </a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="../booking">BOOKING</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../accommodation">HOTELS <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../car-rentals">CAR RENTALS</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../subscription">DSTV & GOTV</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../subscription/utilities.php">WATER & ELECTRICITY</a>
				</li>
				<li class="nav-item">
					<a href="../events" class="nav-link">EVENTS</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="../payments">PAYMENTS</a>
				</li>
				</ul>
				 <form class="form-inline my-2 my-lg-0">
				<input class="form-control flat-field mr-sm-2" type="search" placeholder="Search bus name" aria-label="Search">
				<button class="btn flat-field btn-success my-2 my-sm-0" type="submit">Search</button>
				</form> 
			</div>
			</nav>
			<section class="row" id="upper">
			   <div class="container">
				<div class="row">
				<div class="col-12"><?php echo $GLOBALS["message"];?></div>
				</div>
			</div>
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h1 id="buses_title">
								TRAVEL WITH A SENSE OF LIBERTY
							</h1>
							<div class="row">
								<div class="col-12 col-lg-3"></div>
								<div class="col-12 col-lg-6">
										<center>
											<div class="ui buttons mini">
												 <button class="ui button mini  negative" id="flights_form">Bus Booking</button>
													<div class="or"></div>
												<button class="ui button mini" id="buses_form">Flight Booking</button> 
											</div>
											<div class="divider ui"></div>
											<form action="#">
												<div class="row" style="padding:1em;">
													<div class="col-12 form-group">
														<select class="form-control form-control-lg" id="bus_company">
														<option selected value="">All</option>
															<?php
																$company = mysqli_query($conn, "SELECT * FROM company_details WHERE indulstry = 1 ORDER BY company_name ASC");
																while($row = mysqli_fetch_assoc($company)){
																	echo "<option value=".$row['company_id'].">".$row['company_name']."</option>";
																}
															?>
														</select>
													</div>
													<div class="col-12 col-md-6 form-group">
														<input type="text" placeholder="Departure date" id="dept_date" class="form-control form-control-lg datepicker-here" >
													</div>
													<div class="col-12 col-md-6 form-group">
														<input type="text" id="arrival_date" class="form-control form-control-lg datepicker-here" placeholder="Arrival date (optional)">
													</div>
													<div class="col-12 col-md-6 form-group">
														<select class="form-control form-control-lg " id="origin">
															<option disabled selected>Select Origin</option>
															<?php
															$district = mysqli_query($conn, "SELECT * FROM district ORDER BY district_name ASC");
															while($row = mysqli_fetch_assoc($district)){
																echo "<option value=".$row['district_id'].">".$row['district_name']."</option>";
															}
															?>
														</select>
													</div>
													<div class="col-12 col-md-6 form-group">
														<select class="form-control form-control-lg" id="destination">
																<option selected disabled>Select Destination</option>
																	<?php
																	$district = mysqli_query($conn, "SELECT * FROM district ORDER BY district_name ASC");
																	while($row = mysqli_fetch_assoc($district)){
																		echo "<option value=".$row['district_id'].">".$row['district_name']."</option>";
																	}
																	?>
														</select>
													</div>
													<div class="col-12 form-group">
													<input type="button" data-toggle="modal" data-target="#loader" hidden id="loader_click">
														<button type="button"  class="btn btn-lg btn-success btn-block flat-field" id="search_trips">
																	SEARCH TRIPS
														</button>
													</div>
												</div>
											</form>
										</center>
								</div>
								<div class="col-12 col-lg-3"></div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="row" id="b_s_results">
				<div class="container">
					<div class="row">
						<div class="col-12">
						    <br>
							<h1 id="s_r_txt">SHOWING ALL AVALABLE TRIPS</h1>
						</div>
						<div class="col-12" style="padding:3%;" id="bus_results">
						<?php
									function getDistrict($id){
										$district =mysqli_query($GLOBALS['conn'], "SELECT district_name FROm district WHERE district_id = $id ");
										$row = mysqli_fetch_assoc($district);
										return $row["district_name"];
									}

									$trip = mysqli_query($conn, "SELECT *  FROM trip JOIN bus JOIN company_details 
									WHERE bus.company = company_details.company_id AND trip.bus_id = bus.bus_id AND trip.status = 'Pending' 
									ORDER BY trip.departure_date, trip.departure_time  ASC") or die(mysqli_error($conn));
									while($row = mysqli_fetch_assoc($trip)){
										$d_time = date("g:i a", strtotime($row['departure_time']));
										$a_time = date("g:i a", strtotime($row['arrival_time']));
										$eta = abs($row['lapse'])/(10000);
										echo "<div class='ui segment bus_data' >
											<div class='row'>
												<div class='col-12 col-md-2'><h4 class='time'>From: ".$d_time."</h4></div>
												<div class='col-12 col-md-6'>
													<h3 class='bus'>".$row['company_name']." (".strtoupper($row['type']).") / ".$row['bus_id']."</span></h3>
												</div>
												<div class='col-12 col-md-3'><h2 class='float-right fare'>".$row["currency"]." ".$row['_price']."</h2></div>
											</div>
										<div class='row'>
												<div class='col-12 col-md-2'><p class='midrow'>ETA: ".$eta."hrs</p> </div>
												<div class='col-12 col-md-6'>
													<label class='midrow'>Origin: <span>".getDistrict($row['origin'])."</span> |   | Destination: ".getDistrict($row['destination'])."</span></label>
												</div>
												<div class='col-12 col-md-3'><h4 class='float-right midrow'>".$row['avail_seats']." Seats Left</h4></div>
											</div>
										<div class='row'>
												<div class='col-12 col-md-2'><h4 class='time'>To: ".$a_time."</h4></div>
												<div class='col-12 col-md-6'>
													
												</div>
												<div class='col-12 col-md-3'>
													<button  type='button'  onclick='buildTicket(".$row['trip_id'].")'  class='float-right ui button basic mini blue circular booking_btn'>BOOK SEATS</button>
												</div>
											</div>
									</div>";
											
									}
                        	?>	
						</div>
					</div>
				</div>
			</section>
			<?php require("../footer.html")?>

 <!-- Modal  -->
<div class="modal fade" id="loader" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"  role="document">
    <div class="modal-content" style="background:rgb(0,0,0,.7);">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5> 
        <button type="button" class="close" style="color:red;" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="processing">
            <center>
            <h4 style="color:white;">Searching for Buses...</h4>
            <div class="ui image small">
                <img src="../../assets/img/ajax.gif" alt="">
            </div>
            </center>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="book_bus_confirm"  tabindex="-1" role="dialog" aria-labelledby="book_bus_confirm" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:orangered;">
		<h5 class="modal-title" id="confirm_title">CONFIRM BUS BOOKING</h5>
		<button id="close_btn1" hidden type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"  >
	  <div class="row" id="ticket_data" >
		  <div class="col-12 col-md-9">
			  <div class="row" id="ticket_data_preview">
				  <div class="col-12">
					  <h1 style="font-family:nuni-reg;">Is the ticket information below correct ?</h1>
					  <div class="ui divider"></div>
				  </div>
			  </div>
			  <div class="row">
				<div class="col-6 col-md-5 data_label time">Number of Seats :</div>
				<div class="col-6 col-md-7 data_actual bus">
					<input id="num_seats" placeholder="1" type="number" min = "1" class="form-control form-control-sm" value="1" required/>
				</div>
			</div>
		  <div class="row">
				<div class="col-6 col-md-5 data_label time">Trip Number :</div>
				<div class="col-6 col-md-7 data_actual bus" id="v_trip_id">CTC-4GHTU-000</div>
			</div>
			<div class="row">
				<div class="col-6 col-md-5 data_label time">Origin :</div>
				<div class="col-6 col-md-7 data_actual bus" id="v_origin">Lilongwe</div>
			</div>
			<div class="row">
				<div class="col-6 col-md-5 data_label time">Destination :</div>
				<div class="col-6 col-md-7 data_actual bus" id="v_destination">Blantyre</div>
			</div>
			<div class="row">
				<div class="col-6 col-md-5 data_label time">Bus Service :</div>
				<div class="col-6 col-md-7 data_actual bus" id="v_service"></div>
			</div>
			<div class="row">
				<div class="col-6 col-md-5 time">Travel Date :</div>
				<div class="col-6 col-md-7 bus" id="v_date">00/00/00</div>
			</div>
			<div class="row">
				<div class="col-6 col-md-5 time">Departure Time :</div>
				<div class="col-6 col-md-7 bus" id="v_dtime">09:30 PM</div>
			</div>
			<div class="row">
				<div class="col-6 col-md-5 time">Arrival Time :</div>
				<div class="col-6 col-md-7 bus" id="v_atime">09:30 PM</div>
			</div>
			<div class="row">
				<div class="col-6 col-md-5 time">ETA :</div>
				<div class="col-6 col-md-7 bus" id="v_eta">6hrs 30min</div>
			</div>
			<div class="row">
				<div class="col-6 col-md-5 time">Available Seats :</div>
				<div class="col-6 col-md-7 bus" id="v_seats"></div>
			</div>
			<div class="row">
				<div class="col-6 col-md-5 time">Price / Seat:</div>
				<div class="col-6 col-md-7 bus">K <span id="v_fare">6500</span></div>
			</div>
		  </div>
		  <div class="col-12 col-md-3">
			  <div class="ui image tiny">
				  <img src="../../assets/img/QR.png" alt="">
			  </div>
		  </div>
	  </div>
	</div>
	  
	  <div class="row" id="price_preview" style="display:none;">
			<div class="col-12">
				<h3 id="price_preview_statement">
					You have requested to reserve <span id="nsrseatcount"></span> seats on <span id="nsr"  style="color:blue;font-family:mali-reg;font-size:17px;"></span> 
					for a tour on <span id="nsrdate" style="color:green; font-family:mali-reg;font-size:17px;"></span> at K<span id="nsrprice" style="color:green;font-family:mali-reg;font-size:17px;"> </span>/ Seat
					. This brings the total fare K <span id="nsrtotal" style="color:red;font-family:mali-reg;font-size:17px;"></span>. Click <span style="color:green;">"I Agree"</span> to proceed with this reservation!
				</h3>
			</div>
	  </div>

	  <div id="customer_info" style="padding:.6em; display:none;">
	  <form>
         <div class="form-row">
				<div class="col-4">
					<label for="">First Name</label>
					<input type="text" id="fname" class="form-control form-control-md flat-field" placeholder="e.g John">
				</div>
				<div class="col-4">
					<label for="">Last Name</label>
					<input type="text" id="lname" class="form-control form-control-md flat-field" placeholder="e.g Smith">
				</div>
				<div class="col-4 form-group">
					<label for="">Sex / Gender</label>
					<select  class="form-control form-control-md flat-field"  id="gender">
						<option disabled selected>Select Gender</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>

				<div class="col-6">
					<label for="">Phone Number</label>
					<input type="tel" id="phoneNo" class="form-control form-control-md flat-field" placeholder="e.g +265 99 123 456">
				</div>

				<div class="col-6">
					<label for="">Email Address</label>
					<input type="email" id="email" class="form-control form-control-md flat-field" placeholder="e.g yourname@domain.ext">
				</div>

				<input type="reset" value="reset" id="modal_reset2" hidden/>
         </div>
    	</form>
	  </div>

	  <div id="pay_option">
				
	  </div>

      <div class="modal-footer">
		  <div id="ticket_logo" class="ui image tiny" style="float:left;">
			  <img src="../../assets/img/logo-main.png" alt="">
		  </div>
        <button type="button" data-dismiss="modal" id="close_ticket_btn"  class="btn btn-secondary btn-lg flat-field">No, Cancel</button>
        <button type="button" class="btn btn-lg btn-success flat-field" id="ticket_yes_btn">Yes, Proceed</button>
      </div>
    </div>
  </div>
</div>
<button hidden type="button" id="view_ticket" data-toggle='modal' data-target='#book_bus_confirm'></button>
 <!-- LOADING MODAL  -->

<?php require("../loader.php");?>

</body>
</html>