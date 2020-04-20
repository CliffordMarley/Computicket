<?php
session_start();
require("../../backend/controller/beta_db_connect.php");
if(isset($_GET["fetch"])){
		$drop_off = $_GET["drop_off_date"];
		$pickup_date = $_GET["pickup_date"];
		$budget = $_GET["budget"];
    }
    
    function addCourosel($car_id){
        $img_section = "";
        $image = $GLOBALS["conn2"]->query("SELECT image_url FROM car_images WHERE car = '".$car_id."' ");
        if($image){
            $count = 0;
            while($img = $image->fetch_assoc()){
                if($count == 0){
                    $img_section .= "<div class='carousel-item active'>
                                        <img src='".$img['image_url']."' class='d-block w-100'>
                                    </div>";
                }else{
                     $img_section .= "<div class='carousel-item'>
                                        <img src='".$img['image_url']."' class='d-block w-100'>
                                    </div>";
                }
                $count++;
            }
                $courosel = "<div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                                <ol class='carousel-indicators'>
                                    <li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>
                                    <li data-target='#carouselExampleIndicators' data-slide-to='1'></li>
                                    <li data-target='#carouselExampleIndicators' data-slide-to='2'></li>
                                </ol>
                                <div class='carousel-inner'>
                                    ".$img_section."
                                </div>
                                <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
                                    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                    <span class='sr-only'>Previous</span>
                                </a>
                                <a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
                                    <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                    <span class='sr-only'>Next</span>
                                </a>
                                </div>";
                $_SESSION[$car_id] = $courosel;
                return $courosel;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Car Search Results</title>
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
				    <!-- <h1 id="count_display" style="padding:.3em;background:red;color:white;text-align:center;"><span id="cars_selected">0</span><i class="icon car"></i></h1> -->
                    <button type="button" id="checkout_btn" class="btn btn-lg flat-field btn-danger btn-block"><span id="cars_selected">0</span> CHECKOUT <i class="icon cart"></i></button>
                </form>
			</div>
            </nav>
            
            <section class="row" style="padding:2em;padding-top:10%;">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1 style="text-align:center;background:#0199EF;padding:.4em;color:white;font-size:25px;font-family:federo;">
                                Search Results
                            </h1>
                        </div>
                        <div class="col-12 col-lg 3">
                            <div class="ui segment" style="padding:0;border-radius:0;">
                                <div class="row">
                                    <div class="col-12" >
                                        <h2 class="h3" style="color:white;font-family:mali-reg;background:#FE6610;padding:.4em;">Search Details</h2>
                                    </div>
                                    <div class="ui divider"></div>
                                    <div class="col-12">
                                        <div id="pickup-label"><i class="icon map marker alternate"></i>Pickup</div>
                                        <div id="location" class="row">
                                            <div class="col-12">Lilongwe, City Mall</div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-8">July 24, 2019</div>
                                                    <div class="col-4">10:00 AM</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="pickup-label"><i class="icon map marker alternate"></i>Drop-Off</div>
                                        <div id="location" class="row">
                                            <div class="col-12">Lilongwe, City Mall</div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-8">August 9, 2019</div>
                                                    <div class="col-4">12:00 Noon</div>
                                                </div>
                                            </div><div id="pickup-label">Currency</div>
                                            <div class="col-12">MWK</div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <form class="form">
                                <h3 class="h3">More Filters</h3>

                            <!-- FILTER STARTS -->
                                <div class="form-group">
                                    <a class="btn btn-md flat-field btn-block btn-primary collapse_btn" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                        CAR CLASS <i class="icon chevron down"></i>
                                    </a>

                                    <div class="collapse show" id="collapseExample">
                                        <div class="card card-body">
                                            <form action="#" class="ui form">
                                                <div class="inline field">
                                                    <div class="ui checkbox">
                                                        <input type="checkbox" checked tabindex="0" class="hidden">
                                                        <label>All</label>
                                                    </div>
                                                </div>
                                                <div class="inline field">
                                                    <div class="ui checkbox">
                                                        <input type="checkbox" tabindex="0" class="hidden">
                                                        <label>Economy</label>
                                                    </div>
                                                </div>
                                                <div class="inline field">
                                                    <div class="ui checkbox">
                                                        <input type="checkbox" tabindex="0" class="hidden">
                                                        <label>Compact</label>
                                                    </div>
                                                </div>
                                                <div class="inline field">
                                                    <div class="ui checkbox">
                                                        <input type="checkbox" tabindex="0" class="hidden">
                                                        <label>Full Size</label>
                                                    </div>
                                                </div>    
                                            </form>
                                        </div>
                                    </div>    
                                </div>
                            <!-- FILTER ENDS -->

                            <!-- FILTER STARTS -->
                            <div class="form-group">
                                    <a class="btn btn-md flat-field btn-block btn-primary collapse_btn" data-toggle="collapse" href="#cartype" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                        CAR TYPE <i class="icon chevron down"></i>
                                    </a>

                                    <div class="collapse show" id="cartype">
                                        <div class="card card-body">
                                            <form action="#" class="ui form">
                                                <div class="inline field">
                                                    <div class="ui checkbox">
                                                        <input type="checkbox" checked tabindex="0" class="hidden">
                                                        <label>All</label>
                                                    </div>
                                                </div>
                                                <div class="inline field">
                                                    <div class="ui checkbox">
                                                        <input type="checkbox" tabindex="0" class="hidden">
                                                        <label>4-5 Door</label>
                                                    </div>
                                                </div>
                                                <div class="inline field">
                                                    <div class="ui checkbox">
                                                        <input type="checkbox" tabindex="0" class="hidden">
                                                        <label>VAN</label>
                                                    </div>
                                                </div>
                                                <div class="inline field">
                                                    <div class="ui checkbox">
                                                        <input type="checkbox" tabindex="0" class="hidden">
                                                        <label>SUV</label>
                                                    </div>
                                                </div>    
                                            </form>
                                        </div>
                                    </div>    
                                </div>
                            <!-- FILTER ENDS -->

                             <!-- FILTER STARTS -->
                             <div class="form-group">
                                    <a class="btn btn-md flat-field btn-block btn-primary collapse_btn" data-toggle="collapse" href="#transmission" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                       TRANSMISSION <i class="icon chevron down"></i>
                                    </a>

                                    <div class="collapse show" id="transmission">
                                        <div class="card card-body">
                                            <form action="#" class="ui form">
                                                <div class="inline field">
                                                    <div class="ui checkbox">
                                                        <input type="checkbox" checked tabindex="0" class="hidden">
                                                        <label>All</label>
                                                    </div>
                                                </div>
                                                <div class="inline field">
                                                    <div class="ui checkbox">
                                                        <input type="checkbox" tabindex="0" class="hidden">
                                                        <label>Automatic</label>
                                                    </div>
                                                </div>
                                                <div class="inline field">
                                                    <div class="ui checkbox">
                                                        <input type="checkbox" tabindex="0" class="hidden">
                                                        <label>H-Shift</label>
                                                    </div>
                                                </div>
                                                <div class="inline field">
                                                    <div class="ui checkbox">
                                                        <input type="checkbox" tabindex="0" class="hidden">
                                                        <label>Manual</label>
                                                    </div>
                                                </div>    
                                            </form>
                                        </div>
                                    </div>    
                                </div>
                            <!-- FILTER ENDS -->
                            
                            </form>
                        </div>

                        
                        <div class="col-12 col-lg-7">
                        <div class="row">
                            <div class="col-12">
                                <div class="ui message positive" style="border-radius:0;">
                                    <i class="icon clock" style="font-family:nuni-reg;"></i>Book now to secure your favourite car at the best price in Lilongwe!
                                </div>
                            </div>


                            <!-- SEARCH RESULTS STARTS -->
                            <div class="col-12" id="search_results">
                                <div class="ui segment">
                                     <!-- Swiper -->
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                        <div class="swiper-slide"><img src="../../assets/img/cars/landrover.png" alt="" class="img img-sm img-thumbnail"></div>
                                        <div class="swiper-slide"><img src="../../assets/img/cars/prado.png" alt="" class="img img-sm img-thumbnail"></div>
                                        <div class="swiper-slide"><img src="../../assets/img/cars/Toyota-Fortuner-Exterior-134988.jpg" alt="" class="img img-sm img-thumbnail"></div>
                                        <div class="swiper-slide"><img src="../../assets/img/cars/251-2517079_x-car-rentals-for-grab-private-hire-toyota.png.jpg" alt="" class="img img-sm img-thumbnail"></div>
                                        <div class="swiper-slide"><img src="../../assets/img/cars/audi-car-hd-photos-audi-1.jpg" alt="" class="img img-sm img-thumbnail"></div>
                                        </div>
                                        <!-- Add Pagination -->
                                        <div class="swiper-pagination"></div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12" id="search_results">
                                <div class="ui segment" style="padding:0;margin-top:.5em;border-radius:0;">
                                        <div class="row">
                                        <div class="col-12 col-lg-7">
                                            
                                        </div>
                                       <div class="col-12 col-lg-5">
                                            <div class="form-inline">
                                            <label for="" style="color:black;">Sort By: &nbsp; </label>
                                           <select name="" id="" class="form-control flat-field" style="border:1px solid #0199EF;">
                                               <option selected>Recommended</option>
                                               <option value="Price">Price</option>
                                               <option>Rental Company</option>
                                           </select>
                                            </div>
                                       </div>
                                        </div>
                                </div>
                            </div>
                            <div class="col-12" id="results_area">
                            <?php
                                $query = $GLOBALS["conn2"]->query("SELECT * FROM car JOIN company JOIN car_brand JOIN car_manufacturer JOIN district 
                                WHERE car.location = district.district_id 
                                AND company.company_id = car.company AND car.brand = car_brand.brand_id 
                                AND car_brand.manufacturer = car_manufacturer.mnf_id AND car.status = 'Available' ORDER BY company.company_name ASC");

                                if($query){
                                    if($query->num_rows > 0){
                                        while($row = $query->fetch_assoc()){
                                            $_SESSION["cardata-".$row['reg_number']] = $row;
                                        ?>
                                        <!-- CAR SEARCH RESULT STARTS -->
                                        <div class="ui segment car">
                                            <div class="row">
                                                <div class="col-12 company_title"><h1><?php echo strtoupper($row['company_name']);?></h1></div>
                                                <div class="col-12 col-lg-4">
                                                    <div class="ui image">
                                                    <?php
                                                        echo addCourosel($row["reg_number"]);
                                                    ?>
                                                        <!--img src="<?php //echo $row['image_url'];?>" alt="<?php //echo $row['name'];?>" class="img img-thumbnail"-->
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-5">
                                                    <div class="row c">
                                                        <div class="col-4 lbl">Car Name : </div><div class="col-8 val"><?php echo $row['name'].",  ".$row['brand_name'];?></div>
                                                    </div>
                                                    <div class="row c">
                                                        <div class="col-4 lbl">Transmission : </div><div class="col-8 val"><?php echo $row['transmission'];?></div>
                                                    </div>
                                                    <div class="row c">
                                                        <div class="col-4 lbl">Features : </div><div class="col-8 val"><?php echo $row['features'];?></div>
                                                    </div>
                                                    <div class="row c">
                                                        <div class="col-4 lbl">Rating : </div><div class="col-8 val"><?php echo $row['rating'];?></div>
                                                    </div>
                                                    <div class="row c">
                                                    
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="col-12 price"><?php echo $row['currency'].$row['price']." / ".$row['unit'];?></div>
                                                    <div class="ui divider"></div>
                                                    <a href="confirm_rental.php?car_id=<?php echo $row['reg_number'];?>" value="1" class="btn btn-sm btn-block flat-field btn-primary">VIEW MORE</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- CAR SEARCH RESULT ENDS -->
                                        <?php
                                        }
                                    }else{
                                        echo "No results found!";
                                    }
                                }else{
                                    echo "Error: ".mysqli_error($conn);
                                }
                            ?>
                            </div>
                        </div>
                        
                        </div>
                        <div class="col-12 col-lg-2">
                           
                        </div>
                        
                    </div>
                </div>

            </section>  
            <div class="row"><br>
                <div class="col-12">
                    <center>
                    <img src="../../assets/img/tmn.gif" alt="" class="img img-md">
                    </center>
                </div>
            </div>
            <section class="row"  style="background: rgb(230,230,240);padding:.7em;">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-12 col-lg-6">
                    <center>
                        <h2 class="display-4">The Problem</h2>
                    </center>
                    <h3>
                        <ol>
                            <li class="prob_sol"><i class="icon check"></i> Outdated search results</li>
                            <li class="prob_sol"><i class="icon check"></i> Slaggish search engine </li>
                            <li class="prob_sol"><i class="icon check"></i> Slow Internet connection</li>
                            <li class="prob_sol"><i class="icon check"></i> Limited data sources</li>
                            <li class="prob_sol"><i class="icon check"></i> Complex results display</li>
                        </ol>
                    </h3>
                        </div>

                        <div class="col-12 col-lg-6">
                            <center>
                                <h2 class="display-4">Our Solution</h2>
                            </center>
                            <h3>
                                <ol>
                                    <li class="prob_sol"><i class="icon check"></i> Up-to-date results</li>
                                    <li class="prob_sol"><i class="icon check"></i> Robust search algorithm</li>
                                    <li class="prob_sol"><i class="icon check"></i> Low data cost requests</li>
                                    <li class="prob_sol"><i class="icon check"></i> Intergrated Databases</li>
                                    <li class="prob_sol"><i class="icon check"></i> Intergrated Databases</li>
                                    <li class="prob_sol"><i class="icon check"></i> Simple results view</li>
                                </ol>
                            </h3>
                        </div>
                    </div>
                </div>
            </section>
            
            
    <!-- Subscription form starts here -->
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

    <?php require("../footer.html");?>
    <?php require("../loader.php")?>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 3,
      spaceBetween: 30,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });
  </script>

  <!-- CAR HIRING FORM MODAL -->
  <div class="modal fade" id="customer_info_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hiiden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header red">
            <h5 class="modal-title" id="exampleModalCenterTitle" style="color:white; font-family:mali-reg;txet-align:center;">
                PLEASE COMPLETE THIS FORM
            </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hiiden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form>
                <div class="row">
                    <div class="col-8 form-group">
                        <label for="">Full Name</label>
                        <input type="text" id="customer_name" class="form-control form-control-sm" placeholder="Enter your name here...">
                    </div>
                    <div class="col-4 form-group">
                        <label for="">Sex / Gender</label>
                        <select  class="form-control form-control-sm"  id="gender">
                            <option disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="col-6 form-group">
                        <label for="">Phone Number</label>
                        <input type="tel" id="phoneNo" class="form-control form-control-sm" placeholder="e.g +265 99 123 456">
                    </div>

                    <div class="col-6 form-group">
                        <label for="">Email Address</label>
                        <input type="email" id="email" class="form-control form-control-sm" placeholder="e.g yourname@domain.ext">
                    </div><input type="reset" value="reset" id="modal_reset2" hidden/>
                </div>
    	    </form>
            </div>
            <div class="modal-footer">
            <button type="reset" id="modal_dismiss3" class="btn btn-secondary btn-sm flat-field" data-dismiss="modal">CANCEL</button>
            <button type="button"  id="log_transaction_btn" class="btn btn-primary btn-sm flat-field">PROCEED<i class="fa fa-cash-register"></i></button>
            </div>
 </div>
  <!-- CAR HIRING FORM ENDS -->
</body>
</html>