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
	<link rel="stylesheet" href="../../lib/sweetalerts/sweetalert.css">
	<link rel="stylesheet" href="../../lib/datepicker/dist/css/datepicker.css"> 

	<script type="text/javascript" src="../../js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../lib/semantic/dist/semantic.min.js"></script>
	<script type="text/javascript" src="../../lib/sweetalerts/sweetalert.js"></script>
	<script type="text/javascript" src="../../lib/sweetalerts/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../js/general.js"></script>
    <script src="../../lib/datepicker/dist/js/datepicker.js"></script>
    
	
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
				<li class="nav-item">
					<a class="nav-link" href="../subscription">DSTV & GOTV</a>
				</li>
				<li class="nav-item active">
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
            <div class="row" id="upper">
            <div class="col-12"><center>
            <h1 style="text-align:center;padding:.2em;color:white;font-family:oswald; background:#2f4aad;">Utility Bill Payments</h1>
            </center>
            <br></div>
            <br>
                <div class="container">
                <br>
                    <div class="row no-gutters">
                        <div class="col-12 col-md-6">
                           <center>
                           <div class="ui image">
                                <img data-toggle="modal" onclick="changeName('WATERBOARD PAY')" data-target="#meter_number_modal" id="waterboard" src="../../assets/img/waterboard.jpg" alt="" class="img img-thumbnail">
                            </div>
                            </center>
                        </div>
                        <div class="col-12 col-md-6">
                            <center>
                            <div class="ui image">
                                <img data-toggle="modal" onclick="changeName('ESCOM PAY')" data-target="#meter_number_modal" id="escom" src="../../assets/img/escom.jpg" alt="" class="img img-thumbnail">
                            </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
<br>
<script>
    function changeName(name){
        var ele = document.getElementById('modal_title');
        ele.innerHTML = name;
        if(name == "WATERBOARD PAY"){
            ele.style.background = "rgb(0,0,200,.7)";
        }else if(name == "ESCOM PAY"){
            ele.style.background = "forestgreen";
        }
    }
</script>
<style>
    #modal_title{
        color:white;
        padding:.2em;
        text-align:center;
        font-family:nuni-reg;
        font-size:30px;
        width:100%;
    }
</style>
    <?php require("../footer.html")?>
 
<div class="modal fade" id="meter_number_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title">
            <div class="row">
                <div class="col-12 col-md-8">
                    ESCOM Pay
                </div>
            </div>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="ui divider"></div>
      </div>
      <div class="modal-body">
        <form action="#" class="form">
            <div class="form-row">
                <div class="form-group col-8">
                <label for="">Account/Meter Number :</label>
                    <input placeholder="Enter account number here" type="number" style="border:thin solid teal;" id="meter_number" class="form-control form-control-md flat-field">
                </div>
                <div class="form-group col-4">
                <label for="" style="color:white;">_______________</label>
                    <button class="btn btn-md flat-field btn-primary btn-block">SUBMIT</button>
                </div>
            </div>
        </form>
      </div>
     
    </div>
  </div>
</div>		
</body>
</html>