<?php
    session_start();
    $data = "";
    if(isset($_GET["car_id"])){
        if(isset($_SESSION["cardata-".$_GET['car_id']])){
            $data = $_SESSION["cardata-".$_GET['car_id']];
        }else{
            session_destroy();
            header("LOCATION:car-results.php");
        }
    }else{
        session_destroy();
        header("LOCATION:car-results.php");
    }
    
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Confirm car rental</title>
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
    <script type="text/javascript" src="../../js/hire_car.js"></script>
	<script src="../../lib/datepicker/dist/js/datepicker.js"></script>
	<script src="../../lib/swiper/js/swiper.js"></script>
	<script src="../../lib/swiper/js/swiper.min.js"></script>
    
	<style>
        .swiper-container {
        width: 100%;
        height: 100%;
        }
        .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
        }
  </style>
</head>
<body>
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
				
			</div>
            </nav>
            
            <section class="row" id="main_section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <h2 style="font-family:nuni-reg;text-align:center;font-weight:bold;background:black;color:white;">
                                        <?php echo $GLOBALS['data']['name']." ".$GLOBALS['data']['brand_name'];?>
                                    </h2>
                                </div>
                                <div class="col-12">
                                    
                                    <?php echo $_SESSION[$_GET['car_id']];?>
                                        <!-- <img src="../../assets/img/cars/landrover.png"  class="img img-thumbnail img-xl"> -->
                                </div>
                                <div class="col-12">
                                    <h2 style="font-weight:bold;font-size:20px;font-family:Yu Gothic;background:black;color:white;padding:.5em;">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="float:right;">RATE :    </td>
                                                <td>
                                                    <span style="color:green;"> 
                                                        <?php 
                                                        echo $GLOBALS['data']['currency'].$GLOBALS['data']['price']." / ".$GLOBALS['data']['unit'];
                                                        ?>
                                                    </span> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="float:right;">GEAR :    </td>
                                                <td><span style="color:green;"><?php echo $GLOBALS['data']['transmission'];?></span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </h2>
                                </div>
                                <div class="col-12">
                                    <li style="text-align:center;font-weight:light;margin-top:1em;"><a style="font-family:nuni-reg;"  href="car-results.php"><i class="icon info"></i>Go back to results</a></li>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6" id="form_area">
                            <h1 class="display-4">COMPLETE FORM</h1>
                            <form action="#" class="form">
                                <div class="form-row">
                                   <div class="form-group col-3">
                                        <input type="text" hidden disabled value="<?php echo $GLOBALS['data']['reg_number'];?>" class="form-control form-control-md flat-field" id="car_id" require/>
                                   </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="">Firstname :</label>
                                        <input type="text" placeholder="Enter your firstname here" class="form-control form-control-md flat-field" id="fname" required/>
                                    </div>
                                     <div class="form-group col">
                                        <label class="">Lastname :</label>
                                        <input type="text" placeholder="Enter your lastname here" class="form-control form-control-md flat-field" id="lname" require/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label class="">Mobile Number :</label>
                                        <input type="text" placeholder="e.g +265881234567" class="form-control form-control-md flat-field" id="phone_number">
                                    </div>
                                    <div class="form-group col">
                                        <label class="">Email Address :</label>
                                        <input type="text" placeholder="e.g yourname@domain.com" class="form-control form-control-md flat-field" id="email_address">
                                    </div>
                                </div>
                                <div class="form-row"> 
                                    <div class="form-group col-12 col-lg-6">
                                       <label for="">Pickup date :</label>
                                        <input type="text" placeholder="Start date" class="datepicker-here form-control form-control-md flat-field" id="pickup">
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="">Drop off date :</label>
                                        <input type="text" placeholder="End date"  class="datepicker-here form-control form-control-md flat-field" id="dropoff">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" id="confirm_btn" class="btn btn-md flat-field btn-block btn-success">CONFIRM</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
    <?php require("../loader.php")?>
  <!-- CAR HIRING FORM ENDS -->
</body>
</html>