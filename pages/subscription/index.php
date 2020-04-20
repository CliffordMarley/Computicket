<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>DSTV || GOTV</title>
    <link rel="icon"  type="image/png" href="../../assets/img/Computicket.jpg">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
	<link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../lib/semantic/dist/semantic.min.css">
    <link rel="stylesheet" href="../../css/common.css">
	<link rel="stylesheet" href="../../css/subscription.css">
	<link rel="stylesheet" href="../../css/fonts.css">
	<link rel="stylesheet" href="../../lib/vex/css/vex.css" />  
    <link rel="stylesheet" href="../../lib/vex/css/vex-theme-os.css" />
	<link rel="stylesheet" href="../../lib/sweetalerts/sweetalert.css">
	<link rel="stylesheet" href="../../lib/datepicker/dist/css/datepicker.css"> 

	<script type="text/javascript" src="../../js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="../../lib/vex/js/vex.combined.min.js"></script>
  	<script>vex.defaultOptions.className = 'vex-theme-os'</script> 
	<script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../lib/semantic/dist/semantic.min.js"></script>
	<script type="text/javascript" src="../../lib/sweetalerts/sweetalert.js"></script>
	<script type="text/javascript" src="../../lib/sweetalerts/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../js/general.js"></script>
    <script type="text/javascript" src="../../js/hire_car.js"></script>
    <script src="../../lib/datepicker/dist/js/datepicker.js"></script>
    <script src="../../lib/circleType/circletype.min.js"></script>
    
	
</head>
<body  stylw="padding:5em;">
	<!-- Navbar start here -->
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
					<a class="nav-link" href="../car-rentals">CAR RENTALS</a>
				</li>
				<li class="nav-item active">
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
				<!-- <form class="form-inline my-2 my-lg-0">
				<input class="form-control flat-field mr-sm-2" type="search" placeholder="Search ny or Specific Car" aria-label="Search">
				<button class="btn flat-field btn-success my-2 my-sm-0" type="submit">Search</button>
				</form> -->
			</div>
			</nav>
            <section class="row " id="upper">
				
                <div class="container">
				<div>
					<nav aria-label="breadcrumb" style="background:blue;">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#"style="color:black;font-family:mali-reg;">Subscriptions</a></li>
							<!-- <li class="breadcrumb-item"><a href="#">TV</a></li> -->
							<li class="breadcrumb-item" aria-current="page" style="color:gray;font-family:mali-reg;">TV</li>
						</ol>
					</nav>

				</div>
                    <div class="row ">
                        <div class="col-12 col-lg-7 ui segment">
							<h1 class="display-4">Make Payment</h1>
							<div class="">
								<div class="row" style="background:white;">
								<div style="font-family:nuni-reg;font-weight:bold;padding:.7em;"></div>
									</div>
									<div class="col-12">
									<div class="ui divider"></div>
									
									<div class="ui divier"></div>
										<center>
										<div class="ui image small">
											<img src="../../assets/img/dstvlogo.png" alt="">
										</div></center>
									</div>
									
									
									<br>
									<form action="#">
									<h1 class="h3 subtext" style="color:rgb(0,0,230);">SUBSCRIBE TO DSTV</h1>
										<div class="form-row">
											<div class="col form-group">
												<label>Smartcard Number</label>
												<input type="text" id="iuc" placeholder="Enter Smartcard number here" class="flat-field form-control">
											</div>
											<div class="col form-group">
												<label>Country</label>
												<select class="form-control flat-field " id="country">
													<option value="Malawi">Malawi</option>
												</select>
											</div>
										</div>
										<!--<div class="form-row">-->
										<!--	<div class="col-12 col-lg-4 form-group">-->
										<!--		<label for=""></label>-->
										<!--	</div>-->
										<!--	<div class="col-12 col-lg-8 form-group">-->
										<!--		<input type="text" id="recapture" placeholder="Please enter reCaptcha" class="form-control flat-field ">-->
										<!--	</div>-->
										<!--	<div class="col-12 form-group">-->
										<!--	<button style="float:right;" class="ui button circular positive tiny right floated icon">VERIFY <i class="icon check"></i></button>-->
										<!--	</div>-->
										<!--</div>-->
										
									</form>
									<div class="ui horizontal divider">
                                        <label for="">OR</label>
                                    </div>
									<div class="row">
									<div class="col-12">
									<center><div class="ui image small">
											<img src="../../assets/img/GOtv.jpg" alt="">
									</div></center>
									</div>
									</div>
									<form action="#">
									<h1 class="h3 subtext">SUBSCRIBE TO GOTV</h1>
										<div class="form-row">
											<div class="col form-group">
												<label>UIC or Customer Number</label>
												<input type="text" id="iuc" placeholder="Enter ICU number here" class="flat-field form-control">
											</div>
											<div class="col form-group">
												<label>Country</label>
												<select class="form-control flat-field " id="country">
													<option value="Malawi">Malawi</option>
												</select>
											</div>
										</div>
										<!--<div class="form-row">-->
										<!--	<div class="col-12 col-lg-4 form-group">-->
										<!--		<label for=""></label>-->
										<!--	</div>-->
										<!--	<div class="col-12 col-lg-8 form-group">-->
										<!--		<input type="text" id="recapture" placeholder="Please enter reCaptcha" class="form-control flat-field ">-->
										<!--	</div>-->
										<!--	<div class="col-12 form-group">-->
										<!--	<button style="float:right;" class="ui button circular negative tiny right floated icon">VERIFY <i class="icon check"></i></button>-->
										<!--	</div>-->
										<!--</div>-->
										
									</form>
								</div>
							</div>
							
                        <div class="col-12 col-lg-5">
							<div class="row">
                            <div class="col-12 ">

                        <!-- START OF COUROSEL -->
                            <div class="bd-example">
                                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="../../assets/img/go1.jpg" class="d-block w-100 img img-thumbnail" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                        <!-- <h5>First slide label</h5>
                                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p> -->
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../../assets/img/go4.jpg" class="d-block w-100 img img-thumbnail" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                        <!-- <h5>Second slide label</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> -->
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../../assets/img/go2.png" class="d-block w-100 img img-thumbnail" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                        <!-- <h5>Third slide label</h5>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p> -->
                                        </div>
                                    </div>
                                    </div>
                                    <a style="background:rgb(0,0,0,.7);" class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                    </a>
                                    <a style="background:rgb(0,0,0,.7);" class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                </div>
                                <!-- END OF COUROSEL -->


                            </div>
							<br><br>
                            <div class="col-12" style="margin-top:2em;">
                                <h1 id="hhhh" style="font-family:lato;text-align:center;" class="display-4">
                                Enjoy up to <span style='font-style:italic;text-decoration:line-through;text-decoration-color:red;font-size:30px;'>
                                 15% </span> 20% Discount by subscribing via our online platform!
                                </h1>
                                <p id="text-desc">
								<ul>
									<li style="color:black;font-family:nuni-reg;">One amazing package with world class channels <br>
                                    and the best entertainment, GOtv Max
									One amazing package with world class channels <br>
                                    and the best entertainment, GOtv Max. <br><br>
                                    Get your decoder, GOtenna and one month of Gotv MAX at only
									</li>
								</ul>
								<h1 style="width:100%;text-align:center;"> <span style="font-family:oswal; color:green;text-lign:center;font-family:mali-reg;">MWK19,999</span></h1>
                                   
                                </p>
                                </p>
                            </div>
                        </div>
                        </div>
                           
            </section>
<br>
    <?php //require("../footer.html")?>
 
</body>
</html>