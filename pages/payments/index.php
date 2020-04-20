<?php
    session_start();
    include_once("../../backend/controller/db_conn.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Payments</title>
    <link rel="icon"  type="image/png" href="../../assets/img/Computicket.jpg">
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
	<link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../lib/semantic/dist/semantic.min.css">
    <link rel="stylesheet" href="../../css/common.css">
    <link rel="stylesheet" href="../../css/payments.css">
	<link rel="stylesheet" href="../../css/fonts.css">
	<link rel="stylesheet" href="../../lib/sweetalerts/sweetalert.css">

    <script type="text/javascript" src="../../js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../../js/general.js"></script>
	<script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../lib/semantic/dist/semantic.min.js"></script>
	<script type="text/javascript" src="../../lib/sweetalerts/sweetalert.js"></script>
	<script type="text/javascript" src="../../lib/sweetalerts/sweetalert.min.js"></script>
    <script src="../../js/payments.js"></script>
    
	
</head>
<body class="bg-dark">
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
					<a class="nav-link active" href="../payments">PAYMENTS</a>
				</li>
				</ul>
				
			</div>
			</nav>
            

            <section class="row" id="payme">
            <div class="col-12 col-lg-3"></div>
                <div class="col-12 col-lg-6 bg-dark" id="payment_pad">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-12 col-lg-12">
                                        <div class="ui image">
                                            <img src="../../assets/img/logos/download1.jpg" alt="">
                                            <h1 style="color:white;font-family:nuni-reg;text-align:center;">Use the paypal Button<i class="icon exit"></i></h1>
                                            <br>
                                            <center>
                                                <form class="row" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="new">
                                                <div class="col-12">
                                                <input type="hidden" name="cmd" value="_s-xclick">
                                                    <input type="hidden" name="hosted_button_id" value="E9MQK56SATH4C">
                                                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                                </div>
                                                </form>
                                                </center>
                                                <div class="col-12">
                                            <div class="ui horizontal divider">
                                                <label for="">OR</label>
                                            </div>
                                        </div>
                                        </div>
                                        <h3 style="color:white;font-family:nuni-reg;text-align:center;">Mobile Payments Methods<i class="icon exit"></i></h3>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-12">

                                        <p id="statement">
                                          Our platform also  <br> allow mobile payments. You can also pay for any of our service via your mobile accounts
                                          including <br> <a href="#">TNM Mpamba</a>, 
                                          <a href="#">Airtel Money</a>, <a href="#">FDH SmartPay</a> or <a href="#">Mo626</a>.
                                          For more infomation, click <a href="#">here</a> to read more on how to perfom mobile payments!<a href="#"></a>.
                                            <br><br>
                                            <a href="#" style="color:rgb(177, 175, 175); text-decoration: underline;">Contact Us for more Info</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                    <form action="" class="row" autocomplete="off">
                                        <div class="col-12 col-lg-6">
                                        <label for="">Service Paid For</label>
                                        <select id="service_paid_for" class="form-control form-control-sm flat-field">
                                            <option disabled selected>Choose service</option>
                                            <option value="1">Bus Booking Ticket</option>
                                            <option value="2">Hotel Booking Ticket</option>
                                            <option value="3">Event Ticket</option>
                                        </select>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="">Reference Code</label>
                                            <?php 
                                            $ref_id;
                                                if(isset($_SESSION["ref_id"])){
                                                        echo "<input type='text' id='service_ref' class='form-control form-control-sm flat-field' value='".$_SESSION['ref_id']."' id='ref_id' placeholder='Type Code here' required/>";
                                                }else{
                                                    session_destroy();
                                                    echo "<input type='text' id='service_ref' class='form-control form-control-sm flat-field' value='' id='ref_id' placeholder='Type Code here' required/>";
                                                }
                                            ?>
                                        </div>

                                        <div class="col-12">
                                            <label for="">Choose Payment Method :</label>
                                            <select  id="payment_method" class="form-control form-control-sm flat-field">
                                                <option disabled selected>Select Here</option>
                                                <option value="Mo626">Mo626</option>
                                                <option value="Airtel-Money">Airtel Money</option>
                                                <option value="TNM-Mpamba">TNM Mpamba</option>
                                            </select>
                                        </div>

                                        
                                        <div class="col-12" id="offsite_payment">
                                            <div class="row">
                                            <div class="col-12" id="payment_code_body" style="display:none;">
                                                <label id="payment_code"></label>
                                            </div>
                                            <div class="col-12">
                                                <label>Transaction ID :</label>
                                                <input type="text" value="" autocomplete="false" name="cc-number" placeholder="Type Transaction ID" id="trans_id1" class="form-control form-control-sm flat-field" required/>
                                            </div>
                                            <div class="col-12">
                                                <br>
                                                <label>Confirm Transaction ID :</label>
                                                <input type="text" name="cc-number" id="trans_id2" class="form-control form-control-sm flat-field" placeholder="Confirm Here" required/>
                                            </div>
                                            </div>
                                        </div>


                                        <!-- USE ACCOUNT HERE STARTS-->
                                        <div class="col-12" id="onsite_payment" style="display:none;">
                                            <div class="row">
                                                    <div class="col-12">
                                                        <label id="lb_say_what">Account / Phone number</label>
                                                        <input type="tel" id="acc_num" class="form-control form-control-sm flat-field" placeholder="Enter account here">
                                                    </div>
                                                    <div class="col-12">
                                                        <label>PIN</label>
                                                        <input type="password" class="form-control form-control-sm flat-field" placeholder="Enter Password Here">
                                                    </div>
                                            </div>
                                        </div>
                                        <!-- USE ACCOUNT HERE ENDS -->

                                        <div class="col-12">
                                            <div class="ui horizontal divider">
                                                <label for="">OR</label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" data-toggle="toggle" name="paytime" unchecked type="checkbox" id="toggle_pay_check" value="option1">
                                                <label class="form-check-label" id="prompt">Pay with your Account here</label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="button" class="btn btn-block btn-lg btn-success flat-field" id="pay_btn">
                                                PAY NOW
                                            </button>
                                        </div>
                                        <input type="reset" hidden id="reset_modal">
                                    </form>
                                    <div class="row">
                        <div class="col-12">
                            <div class="row" style="background:white;padding:.5em;">
                                <div class="col-6">
                                    <div class="ui image "><img src="../../assets/img/logos/download.jpg" alt=""></div>
                                </div>
                                <div class="col-6">
                                    <div class="ui image"><img src="../../assets/img/logos/paypal.png" alt=""></div>
                                </div>
                                <div class="col-6">
                                    <div class="ui image"><img src="../../assets/img/logos/ecobank.png" alt=""></div>
                                </div>
                                <div class="col-6">
                                    <div class="ui image"><img src="../../assets/img/logos/airtelmoney.png" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                                </div>
                        </div>
                    </div>
                   
                </div>
                <div class="col-12 col-lg-3"></div>
            </section>

</body>
</html>
