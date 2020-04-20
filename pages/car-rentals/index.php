<?php
    session_start();
     include_once("../../backend/controller/db_conn.php");
     include_once("../../backend/controller/DPOIntegration.php");
    $message = "";
    if(isset($_GET['TransID']) && isset($_GET['TransactionToken'])){
		$res = verifyToken($_REQUEST['TransactionToken'],$_REQUEST["CompanyRef"]);
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
    <title>Car Rentals</title>
    <link rel="icon"  type="image/png" href="../../assets/img/Computicket.jpg">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
	<link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../lib/semantic/dist/semantic.min.css">
    <link rel="stylesheet" href="../../css/common.css">
	<link rel="stylesheet" href="../../css/carhire.css">
	<link rel="stylesheet" href="../../css/fonts.css">
	<link rel="stylesheet" href="../../lib/sweetalerts/sweetalert.css">
	<link rel="stylesheet" href="../../lib/datepicker/dist/css/datepicker.css"> 
	<link rel="stylesheet" href="../../css/home.css">
	<link rel="stylesheet" href="../../lib/swiper/css/swiper.css">
	<link rel="stylesheet" href="../../lib/swiper/css/swiper.min.css">

	<script type="text/javascript" src="../../js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../lib/semantic/dist/semantic.min.js"></script>
	<script type="text/javascript" src="../../lib/sweetalerts/sweetalert.js"></script>
	<script type="text/javascript" src="../../lib/sweetalerts/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../js/general.js"></script>
	<script src="../../lib/datepicker/dist/js/datepicker.js"></script>
	<script src="../../lib/swiper/js/swiper.js"></script>
	<script src="../../lib/swiper/js/swiper.min.js"></script>
    
	
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
				<li class="nav-item">
					<a class="nav-link" href="../booking">BOOKING</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../accommodation">HOTELS <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="../car-rentals">CAR RENTALS</a>
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
				<input class="form-control flat-field mr-sm-2" type="search" placeholder="Search Rental Company or Specific Car" aria-label="Search">
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
                       <div class="col-12 col-lg-6">
								<div class="row">
									<div class="col-12" >
										<h1 class="display-1" id="main-title">FIND GREAT CAR DEALS</h1>
										<ul>
											<li>Choose where to Pickup Your car</li>
											<li>Find Competetively Cheap Cars</li>
											<li>Save up to 20%</li>
										</ul>
									</div>
							</div>
                       </div>
                       <div class="col-12 col-lg-6">
					   		<div class="row">
							   <div class="col-12 col-lg-4"></div>
							   	<div class="col-12 col-lg-8" id="search_form">
									<h1>Search For car here</h1>
											<form action="car-results.php" class="form" method="GET">
												<div class="form-row">
													<div class="col form-group">
														<label>Pickup City / District :</label>
														<select id="pickup" class="form-control form control-md flat-field">
															<option disabled selected>Select Pickup</option>
															<?php
																$district = mysqli_query($conn, "SELECT * FROM district ORDER BY district_name ASC");
																while($row = mysqli_fetch_assoc($district)){
																	echo "<option value=".$row['district_id'].">".$row['district_name']."</option>";
																}
																$conn->close();
															?>
														</select>
													</div>
												</div>
												<div class="form-row">
													<div class="col form-group">
														<label for="">From :</label>
														<input type="text" name="pickup_date" placeholder="Pickup date" class="form-control form-control-md datepicker-here flat-field" id="from">
													</div>
													<div class="col form-group">
														<label for="">Until :</label>
														<input type="text" name="drop_off_date" placeholder="Drop-off date" class="form-control form-control-md datepicker-here flat-field" id="until">
													</div>
												</div>
												<div class="form-row">
													<div class="col form-group">
														<label for="">Class</label>
														<select name="budget" class="form-control form control-md flat-field">
															<option value="All" selected>All</option>
															<option value="Economy">Economy</option>
															<option value="Compact">Compact</option>
															<option value="Luxury">Luxury</option>
														</select>
													</div>
												</div>
												<div class="form-row">
													<div class="col"></div>
													<div class="col form-group">
														<input type="submit" name="fetch" class="btn btn-success flat-field btn-block" value="FETCH"/>
													</div>	
												</div>
												
										</form>
								</div>
								
							</div>
					   </div>
                    </div>
                </div>
            </section>
			<section class="row" style="background:#FE6610;padding:.5em;">
				<div class="container">
					<div class="row">
					<div class="col-12 col-lg-8" >
					 <!-- Slider main container  -->
						<div class="swiper-container" style="border:thick solid white;">
							 <!-- Additional required wrapper  -->
							<div class="swiper-wrapper">
								 <!-- Slides  -->
								<div class="swiper-slide" style="background-image:url(../../assets/img/cars/cars2.png)"></div>
								<div class="swiper-slide" style="background-image:url(../../assets/img/cars/landrover.png)"></div>
								<div class="swiper-slide" style="background-image:url(../../assets/img/cars/Toyota-Fortuner-Exterior-134988.jpg)"></div>
							</div>
							 <!-- If we need pagination  -->
							<div class="swiper-pagination"></div>

							 <!-- If we need navigation buttons  -->
							<div class="swiper-button-prev"></div>
							<div class="swiper-button-next"></div>

							 <!-- If we need scrollbar  -->
							<div class="swiper-scrollbar"></div>
							</div>
						</div>
						<div class="col-12 col-lg-4">
							<h1 class="h2" style="color:white;margin-top:.4em;font-family:mont;text-align:center;text-decoration:underline;">Featured Car Rental Companies</h1>
							<br>
							<ol>
								<li><i class="icon check"></i><a href="#">AHAYA CAR HIRE</a></li>
								<li><i class="icon check"></i><a href="#">AVIS CAR HIRE</a></li>
								<li><i class="icon check"></i><a href="#">BUDGET CAR HIRE</a></li>
								<li><i class="icon check"></i><a href="#">PREMIER CAR HIRE</a></li>
								<li><i class="icon check"></i><a href="#">COUNTRY WIDE CAR HIRE</a></li>
							</ol>
							<div class="ui divider" style="color:white;"></div>
							<br><br>
							<form action="#" class="form row">
							<div class="col-12">
								<h3 class="h4" style="color:white;">Sign Up To Get Best Car Deals</h3>
								<div class="form-inline">
									<div class="form-group">
										<input type="email" placeholder="e.g yourname@domain.com" id="sub_email" class="form-control flat-field form-control-md">
									</div>
									<div class="form-group">
										<button type="button" id="sub_btn" class="btn btn-primary btn-block btn-md flat-field">Sign up</button>
									</div>
								</div>
							</div>
							</form>
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
            <h4 style="color:white;">Searching...</h4>
            <div class="ui image small">
                <img src="../../assets/img/ajax.gif" alt="">
            </div>
            </center>
      </div>
    </div>
  </div>
</div>
<script>
   var swiper = new Swiper('.swiper-container', {
      effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: '2',
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows : true,
      },
      pagination: {
        el: '.swiper-pagination',
      },
    });
  </script>

</body>
</html>