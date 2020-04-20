<?php
    session_start();
     require_once("../../backend/controller/DPOIntegration.php");
     require_once("../../backend/controller/db_conn.php");
    $message = "";
    if(isset($_GET['TransID']) && isset($_GET['TransactionToken'])){
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
<html>
<head>
<meta charset="utf-8">
    <title>Events</title>
    <link rel="icon"  type="image/png" href="../../assets/img/Computicket.jpg">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
	<link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../lib/semantic/dist/semantic.min.css">
    <link rel="stylesheet" href="../../css/common.css">
    <link rel="stylesheet" href="../../css/events.css">
	<link rel="stylesheet" href="../../css/fonts.css">
	<link rel="stylesheet" href="../../lib/sweetalerts/sweetalert.css">

    <script type="text/javascript" src="../../js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../../js/general.js"></script>
	<script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../lib/semantic/dist/semantic.min.js"></script>
	<script type="text/javascript" src="../../lib/sweetalerts/sweetalert.js"></script>
	<script type="text/javascript" src="../../lib/sweetalerts/sweetalert.min.js"></script>
	<script src="../../js/event_ticket_booking.js"></script>

	
</head>
<body>
	
	 <!-- Navbar start here  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="border-radius: 0;padding:.4em;">
			<a href="../home" class="navbar-brand" id="brand_image" style="margin:0;top:0; position: relative;">
				 <h3 style="color:white;font-family: electra; ">Compu<span style="color:red;">ticket</span></h3>
				 
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
				<li class="nav-item">
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
				<li class="nav-item active">
					<a href="../events" class="nav-link">EVENTS</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="../payments">PAYMENTS</a>
				</li>
				</ul>
			</div>
			</nav>
            
        <div class="row" style="">
		
		<div class="col-12">
			<div class="container">
				<div class="row">
				<div class="col-12"><?php echo $GLOBALS["message"];?></div>
				</div>
			</div>
			<div class="container ui raised segment" style="padding:2%;">
				<div class="row">
					<div class="col-12 col-md-7" id="football_title_header">
						<h1 class="display-4">COMPUTICKET WORLD OF FOOTBALL</h1>
					</div>
					<div class="col-12 col-md-5">
						<h2 class="h3 row" id="football_tag_line">
							<div class="col-12">BUY A MATCH TICKET @ A CHEAPER PRICE HERE AND NOW!</div>
							<div class="col-12">
								<h3 id="extract">Grab the opportunity while you still can!!</h3>
							</div>
						</h2>
					</div>
					
				</div>
				<div class="ui divider"></div>
				<div class="row">
					 <!-- MATCH SLIDER  -->
					<div class="col-12 col-lg-6">
						<?php include("football_couresel.php")?>
						<div class="row">
							<div class="col-12 table-responsive">
							<h2>WEEKEND GAMES</h2>
								<table class="table table-sm">
									<thead>
										<th>SN</th>
										<th>MATCH_SET</th>
										<th>STADIUM</th>
										<th>DATETIME</th>
										<th>PRICING</th>
										<th>#</th>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Big Bullets vs BF-Wanderors</td>
											<td>Bingu</td>
											<td>Saturday, 14<sup>th</sup>, 14:00 PM</td>
											<td>K2500</td>
											<td>
												<input type="checkbox" class="" id="">
											</td>
										</tr>
										<tr>
											<td>2</td>
											<td>Moyale Barracks FC vs Civil Service</td>
											<td>Civil</td>
											<td>Sunday, 15<sup>th</sup>, 14:30 PM</td>
											<td>K3000</td>
											<td>
												<input type="checkbox" class="" id="">
											</td>
										</tr>
										<tr>
											<td>3</td>
											<td>Kamuzu Barracks FC vs Illovo FC</td>
											<td>Bingu</td>
											<td>Saturday, 21<sup>st</sup>, 14:00 PM</td>
											<td>K3000</td>
											<td>
												<input type="checkbox" class="" id="">
											</td>
										</tr>
									</tbody>
								</table>
								<div class="row">
									<div class="col-12 col-md-8"></div>
									<div class="col-12 col-md-4">
										<button class="btn flat-field btn-primary btn-block">BUY TICKET</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					 <!-- POSTERS AND ADS -->
					<div class="col-12 col-lg-3">
						<h3 style="text-align:center;font-family:oswald;color:white;background-color:rgb(211,3,3);padding:2%;">ADVERTISEMENT</h3>
						<div class="row no-gutters">
							<div class="col-12">
								<div class="ui image medium ad_poster">
									<img src="../../assets/img/football/ad2.png" alt="" class="img img-thumbnail">
								</div>
							</div>
							<div class="col-12" style="margin-bottom:2%;"></div>
							<div class="col-12">
								<div class="ui image medium ad_poster">
									<img src="../../assets/img/football/ad3.jpg" alt="" class="img img-thumbnail">
								</div>
							</div>
						</div>
					</div>
					 <!-- SIGNUP FOR NEWSLETTER  -->
					<div class="col-12 col-lg-3">
						<aside id="signup_newsletter">
							<h3>MATCH UPDATES</h3>
							<p>To get realtime match updates vai text messages, fill the signup form below!</p>
							<br>
							<div class="form">
								<div class="form-row">
									<div class="col-12">
										<label for="">Firstname :</label>
										<input type="text" placeholder="e.g John" class="form-control form-control-lg flat-field" required/>
									</div>
									<div class="col-12">
										<label for="">Lastname :</label>
										<input type="text" placeholder="Smith" class="form-control form-control-lg flat-field" required/>
									</div>
									<div class="col-12">
										<label for="">Mobile Number :</label>
										<input type="tel" placeholder="e.g +265(0)123456789" class="form-control form-control-lg flat-field" required/>
									</div>
									<div class="col-12">
										<button  type="button" style="color:white;float:right;" class="btn btn-danger btn-lg flat-field">SIGNUP</button>
									</div>
								</div>
							</div>
						</aside>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12" style="margin:5%;"></div>
        <div class="col-12">
		<?php 
			require("events_body.php");
		?>
        </div>
	    </div>
	 <!-- Subscription form starts here  -->
		 <section class="row ftco-section-parallax" id="subcription_area" style="background:orange;">
            <div class="col text-center heading-section heading-section-white ftco-animate">
              <h2 style="color:white;font-family:'Yu Gothic';">Subcribe to our Newsletter</h2>
              <p style="color:white;font-family:'Yu Gothic';">Stay updated on all Offers, Promotions, Features and Many more. Make your convenience Our priority!</p>
              <div class="row d-flex justify-content-center mt-5">
                <div class="col-md-6">
                <form action="#" class="subscribe-form">
                    <div class="form-group d-flex">
                      <input type="text" id="sub_email" class="form-control" style="border-radius:0;border:none;" placeholder="Enter email address" required/>
                      <button type="button" id="sub_btn" style="background:#C82333;color:white;border:none;cursor:pointer;"  class="submit px-3">Subscribe</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
    	</section> 
    	
	<?php require("../footer.html")?>
	<?php require("../loader.php")?>
// 	<?php
// 		echo $message;
// 	?>
</body>
</html>
