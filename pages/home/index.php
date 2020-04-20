<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Home</title>
	<link rel="icon"  type="image/png" href="../../assets/img/Computicket.jpg">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
	<link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../lib/semantic/dist/semantic.min.css">
	<link rel="stylesheet" href="../../css/common.css">
	<link rel="stylesheet" href="../../css/home.css">
	<link rel="stylesheet" href="../../css/fonts.css">
	<link rel="stylesheet" href="../../lib/sweetalerts/sweetalert.css">

	<script type="text/javascript" src="../../js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../lib/semantic/dist/semantic.min.js"></script>
	<script type="text/javascript" src="../../js/customer_registration.js"></script>
	<script type="text/javascript" src="../../lib/sweetalerts/sweetalert.js"></script>
	<script type="text/javascript" src="../../lib/sweetalerts/sweetalert.min.js"></script>
	<script type="text/javascript" src="../../js/general.js"></script>
	<script src="../../js/search_for_flights.js"></script>
	
</head>
<body>
    <!-- <h1>ERROR 500!</h1>
    <h3>INTERNAL SERVER ERROR!</h3> -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
			<a class="navbar-brand" id="brand_image">
				<div class="ui image tiny">
					<img src="../../assets/img/logo-main.png" alt="">
				</div>
			</a>
			<a class="navbar-brand" style="color:white;display:none;" id="brand_txt">
				Compu<span style="color:red;font-family:nuni-reg;">ticket</span>.mw
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
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
					<a class="nav-link" href=../subscription>DSTV & GOTV</a>
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
				<input class="form-control flat-field mr-sm-4" type="search" placeholder="Search Airliner" aria-label="Search">
				<button class="btn flat-field btn-success my-2 my-sm-0" type="submit">Search</button>
				</form>
			</div>
			</nav>
		<section class="row" id="topper">
			<div class="container">
				<div class="row" id="top-container">
				<div class="col-12 col-lg-3" id="girl">
					<div class="ui image large">
						 <img src="../../assets/img/girl.png" alt=""> 
					</div>
				</div>
					<div class="col-12 col-lg-6" id="main_title">
						<h1>WELCOME TO COMPU<span style="color:red;">TICKET</span></h1>
						<h2>Quick Flight & Bus Search <i class="icon search"></i></h2>
						<div class="row">
							<div class="col-12">
								<form class="" style="margin:1em;">
									<div class="form-group">
										<label class="sr-only">Choose Origin</label>
										<select placeholder="Origin" id="origin" class="form-control flat-field form-control-lg">
											<option selected disabled>Origin City/Airport</option>
											<option value="LON">LONDON</option>
											<option value="NYC">NEW YORK CITY</option>
											<option value="JNB">JORHANESBERG</option>
											<option value="LLW">LILONGWE</option>
										</select>
									</div>
									<div class="form-group">
										<label class="sr-only">Choose Destination</label>
										<select id="destination" class="form-control flat-field form-control-lg">
											<option selected disabled>Destination City/Airport</option>
											<option value="LON">LONDON</option>
											<option value="NYC">NEW YORK CITY</option>
											<option value="JNB">JORHANESBERG</option>
											<option value="LLW">LILONGWE</option>
										</select>
									</div>
									<div class="form-group">
										<button type="button" id="quick_flight_search_btn" class="btn flat-field float-right btn-success btn-lg">Ok, go</button>
									</div>
								</form>
							</div>

						</div>
						<div class="row" style="border-bottom:2px solid white;border-top:2px solid white;">
							<div class="col-12">
								<button style="width:100%;" class="btn btn-fluid btn-warning btn-lg flat-field">More Search Filters</button>
							</div>
						</div>

					</div>
					<aside class="col-12 col-lg-3" id="side-part">
						<h3>Become a Registered Customer</h3>
						<form action="#" style="padding:.8em;">
							<div class="row">
								<div class="col-12 col-lg-6">
									<div class="form-group">
										<input type="text" id="fname" class="form-control form-control-md flat-field" placeholder="Firstname"required>
									</div>
								</div>
								<div class="col-12 col-lg-6">
									<div class="form-group">
										<input type="text" id="lname" class="form-control form-control-md flat-field" placeholder="Lastname"required>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<input type="text" id="onames" class="form-control form-control-md flat-field" placeholder="Other names"required>
									</div>
								</div>
								<div class="col-12">
								<div class="row">
									<div class="col-12 col-lg-5 form-group">
										<select id="gender" class="form-control form-control-md flat-field">
											<option selected disabled>Sex</option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
									</div>
									<div class="col-12 col-lg-7 form-group">
										<input type="date" id="dob" class="form-control form-control-md flat-field">
									</div>
									<div class="col-12 form-group">
										<input type="email" id="contact" placeholder="Email Address / Mobile #" class="form-control form-control-md flat-field">
									</div>
									<div class="col-12 form-group">
										<button type="button" id="reg_btn" class="btn btn-md btn-success flat-field" style="width:100%">DONE!</button>
										<input type="reset" hidden id="reg_reset"/>
									</div>
								</div>
								</div>
							</div>
						</form>
					</aside>
				</div>
			</div>
		</section>

		<section class="row" id="middle">
			<div class="container">
				<div class="row">
					<div class="col-12 col-lg-3" style="border-right:2px solid black">
					<div class="row">
						<div class="col-12" style="margin-bottom:.6em;">
							<h2 id="h2_title" style="font-family:nuni-reg;">WHY US?</h2>
							<p class="centered-text"><span class="quote">“</span>We manage and accelerate <br> your payments 
								environment on a single platform, stress free from traveling to 
								footing bills, while supporting you through change and improving your agility.<span class="quote">”</span></p>
						</div>

						<div class="col-12">
							<h2 id="h2_title" style="font-family:nuni-reg;">VISION & MISSION</h2>
							<p class="centered-text"><span class="quote">“</span>To become the only <br> true Malawian E-ticketing
								 you can trust and liable; simplifying the lives of all
								  Malawians in urban and rural communities… <span class="quote">”</span></p>
						</div>
					</div>
					</div>

					<div class="col-12 col-lg-9">
						<br>
						<h2 class=" fhts" id="h2_title" style="color:teal;">FEATURED HOTELS</h2>
						<h1 class=" fhts" id="h2_title" style="color:orangered;font-size:38px;">MORE ABOUT COMPUTICKET</h1>
						<div class="row">
							<div class="col-12 col-lg-4">
								<div class="card">
									<img class="card-img-top" src="../../assets/img/g2.jpg" alt="Card image cap">
									<div class="card-body">
										<h5 class="card-title">SIMAMA HOTEL</h5>
										<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
										<a href="#" class="btn btn-danger flat-field">BOOK NOW</a>
									</div>
								</div>
							</div>

							<div class="col-12 col-lg-4">
								<div class="card" >
									<img class="card-img-top" src="../../assets/img/g3.jpg" alt="Card image cap">
									<div class="card-body">
										<h5 class="card-title">PACIFIC HOTEL</h5>
										<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
										<a href="#" class="btn btn-danger flat-field">BOOK NOW</a>
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-4">
								<div class="card">
									<img class="card-img-top" src="../../assets/img/g5.jpg" alt="Card image cap">
									<div class="card-body">
										<h5 class="card-title">CROSS-ROADS HOTEL</h5>
										<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
										<a href="#" class="btn btn-danger flat-field">BOOK NOW</a>
									</div>
								</div>
							</div>
                            <div class="col-12">
                                <video class="container img" style="" src="../../assets/video/Advert.mp4" poster="../../assets/img/logo-main.png" controls></video>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</section>
		 <!-- Subscription form starts here  -->
		<section class="row ftco-section-parallax">
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
	<section class="row" id="utilities">
		<div class="col-12"><h2 id="util_header">Prepay & Subscribe to your Home Utilities</h2></div>
		<div class="col-12">
			<div class="row no-gutters">
				<div class="col-6 col-lg-3">
				<center><a href = "../subscription/utilities.php" class="ui image medium"><img src="../../assets/img/escom.jpg" class=" img img-thumbnail util"   alt="Buy Prepaid electricty vouchers"></a></center>
				</div>
				<div class="col-6 col-lg-3">
					<center><a href = "../subscription/utilities.php" class="ui image medium"><img src="../../assets/img/waterboard.jpg" class=" img img-thumbnail util"  alt="Pay water bills or buy prepaid voucher"></a></center>
				</div>
				<div class="col-6 col-lg-3">
					<center><a href = "../subscription" class="ui image medium"><img src="../../assets/img/dstvlogo.jpg" class=" img img-thumbnail util"   alt="Subscribe to DSTV"></a></center>
				</div>
				<div class="col-6 col-lg-3">
					<center><a href = "../subscription" class="ui image medium"><img src="../../assets/img/real-gotv.jpg" class=" img img-thumbnail util" alt="Subscribe to GOTV"></a></center>
				</div>
			</div>
		</div>
	</section>
	 <!-- subscription form ends here  -->
	<?php require("../footer.html")?>
	<?php require("../loader.php");?>
</body>
</html>