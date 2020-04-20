<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Accomodation</title>
    <link rel="icon" type="image/png" href="../../assets/img/Computicket.jpg">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../lib/semantic/dist/semantic.min.css">
    <link rel="stylesheet" href="../../css/common.css">
    <link rel="stylesheet" href="../../css/fonts.css">
    <link rel="stylesheet" href="../../lib/sweetalerts/sweetalert.css">
    <link rel="stylesheet" href="../../css/accommodation.css">
    <link rel="stylesheet" href="../../lib/datepicker/dist/css/datepicker.css">

    <script type="text/javascript" src="../../js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../../lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../lib/semantic/dist/semantic.min.js"></script>
    <script type="text/javascript" src="../../lib/sweetalerts/sweetalert.js"></script>
    <script type="text/javascript" src="../../lib/sweetalerts/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../js/general.js"></script>
    <script type="text/javascript" src="../../js/hotels.js"></script>
    <script src="../../lib/datepicker/dist/js/datepicker.js"></script>

</head>

<body stylw="padding:5em;">
     
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
                <li class="nav-item active">
                    <a class="nav-link" href="../accommodation">HOTELS <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../car-rentals">CAR RENTALS</a>
                </li>
                <li class="nav-item">
					<a class="nav-link " href="../subscription">DSTV & GOTV</a>
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
                <input class="form-control flat-field mr-sm-2" type="search" placeholder="Search Hotel by Name" aria-label="Search">
                <button class="btn flat-field btn-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="row" id="upper">
        <div class="container">
            <div class="row">
             
                <div class="col-12 col-lg-4">
                        <div class="jumbotron jumbotron-fluid" id="searchtron">
                                <div class="container">
                                  <h2 class="title">Search Hotel, Lodge and B&B</h2>
                                <form action="" class="form">
                                    <div class="form-group">
                                        <label >City/Hotel/Property Name:</label>
                                        <input type="text" placeholder="e.g Lilongwe" id="" class="form-control flat-field form-control">
                                    </div>
                                    <div class="form-group">
                                            <label >Check-in Date :</label>
                                            <input type="text" placeholder="From" id="" class="form-control datepicker-here form-control flat-field">
                                    </div>
                                    <div class="form-group">
                                            <label >Check-out Date :</label>
                                            <input type="text" placeholder="Until" id="" class="form-control datepicker-here form-control flat-field">
                                    </div>
                                    <div class="form-group">
                                            <label >Guests :</label>
                                           <select name="" class="form-control form-control flat-field" id="sv_adults">
                                                <option selected value="0">No Adults</option>
                                           </select>
                                    </div>
                                    <div class="form-row">
                                            <div class="form-group col">
                                                   <select class="form-control form-control flat-field" id="sv_children">
                                                        <option selected value="0">No Children</option>
                                                   </select>
                                            </div>
                                            <div class="form-group col">
                                                    <select class="form-control form-control flat-field" id="sv_rooms">
                                                    
                                                    </select>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input " type="checkbox" id="gridCheck">
                                            <label class="form-check-label" for="gridCheck">
                                                Strict Search
                                            </label>
                                        </div>
                                    </div>
                                   <div class="form-row">
                                       <div class="col"></div>
                                       <div class="col">
                                            <button class="btn btn-primary btn-block flat-field right">SEARCH</button>
                                       </div>
                                   </div>
                                </form>
                                </div>
                              </div>

                              <div class="row" style="margin-bottom:.5em;">
                                  <div class="col-12 col-md-6">
                                      <img src="../../assets/img/snap.jpg" alt="" class="img img-thumbnail">
                                  </div>
                                  <div class="col-12 col-md-6">
                                        <img src="../../assets/img/snap2.jpg" alt="" class="img img-thumbnail">
                                </div>
                                <div class="container">
                                    <br>
                                    <div class="col-12 ui segment" style="background: white;border-radius: 0;margin-bottom:.7em;">
                                        <h3 style="color:rgb(12, 148, 202);text-align:center;font-family: mali-reg;">
                                            <i style="color:hsl(12, 148, 202);" class="icon envelope"></i> Get best secret deals into your email!</h3>
                                        <div class="form-row no-gutters">
                                            <div class="col-8"><input type="email" id="sub_email" placeholder="e.g yourname@domain.com" style="border:2px solid rgb(12, 148, 202);outline: cyan;" class="form-control flat-field"></div>
                                            <div class="col-4"><button type="button" id="sub_btn" class="btn btn-md btn-danger flat-field">SUBSCRIBE</button></div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              
                </div>

                <div class="col-12 col-lg-8">
                    <div class="row no-gutters">
                            <div class="col-12">
                                <img src="../../assets/img/tmn.gif" alt="" class="img img-thumbnail">
                            </div>
                        <div class="col-12" style="background: rgb(248, 248, 248);border-bottom: thick solid rgb(68, 68, 230);padding:.4em;">
                            <div class="row">
                            <div class="col-12"><h1 style="color:rgb(204, 0, 0); font-family:lato;">View all results</h1></div>
                            <div class="col-12"><h4>Location: Central region MW, Language: Chichewa , English & Other local languages</h4></div></div>
                        </div>

                         <!-- RESULT SEGMENT STARTS HERE  -->
                        <div class="col-12 ui segment result">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <img src="../../assets/img/g6.jpg" class="img img-thumbnail"/>
                                </div>
                                <div class="col-12 col-md-5">
                                    <div class="row no-gutters">
                                        <div class="col-12"><h1 class="hotel_name"> <a href="#" >Sunbird Hotel Lilongwe</a></h1></div>
                                        <div class="col-12">
                                                <p class="location"><i class="icon map marker alternate"></i> <a href="#"> Lilongwe - view on Google maps</a></p>
                                        </div>
                                        <div class="col-12">
                                             <div class="row">
                                                    <div class="col-12">
                                                            <p style="color:green;font-weight: lighter;font-family: nuni-reg;"><i class="icon check"></i>Allow reservation without credit card</p>
                                                        </div>
                                                        <div class="col-12">
                                                                <p style="color:black;font-weight: lighter;font-family: nuni-reg;"><i class="icon chevron right"></i>Breakfast included</p>
                                                        </div>
                                                        <div class="col-12">
                                                                <p style="color:black;font-weight: lighter;font-family: nuni-reg;"><i class="icon rss"></i>Free unlimited WiFi </p>
                                                        </div>
                                             </div>
                                            </div>
                                    </div>
                                
                                  
                                </div>
                                <div class="col-12 col-lg-3">
                                    <h4 style="width:100%;padding:.2em;background:black;text-align: center;color:white;">More</h4>
                                    <div class="container-fluid">
                                        <h5 style="color:green;font-family: nuni-reg;">USD 240 / Night</i></h5>
                                        <div class="ui divider" ></div>
                                        <button class="btn btn-block btn-sm btn-warning flat-field">See Availability</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                         
                        <div class="col-12 ui segment result">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <img src="../../assets/img/g7.jpg" class="img img-thumbnail"/>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="row no-gutters">
                                            <div class="col-12"><h1 class="hotel_name"> <a href="#" >Platinum Hotel</a></h1></div>
                                            <div class="col-12">
                                                    <p class="location"><i class="icon map marker alternate"></i> <a href="#"> Lilongwe - view on Google maps</a></p>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                            <p style="color:green;font-weight: lighter;font-family: nuni-reg;"><i class="icon check"></i>Allow reservation without credit card</p>
                                                    </div>
                                                    <div class="col-12">
                                                            <p style="color:black;font-weight: lighter;font-family: nuni-reg;"><i class="icon chevron right"></i>Breakfast included</p>
                                                    </div>
                                                    <div class="col-12">
                                                            <p style="color:black;font-weight: lighter;font-family: nuni-reg;"><i class="icon rss"></i>200 MB WiFi Voucher/Day  </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                      
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <h4 style="width:100%;padding:.2em;background:black;text-align: center;color:white;">More</h4>
                                        <div class="container-fluid">
                                            <h5 style="color:green;font-family: nuni-reg;">USD 54 / Night</i></h5>
                                            <div class="ui divider" ></div>
                                            <button class="btn btn-block btn-sm btn-warning flat-field">See Availability</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        <div class="col-12 ui segment result">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <img src="../../assets/img/g1.jpg" class="img img-thumbnail"/>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <div class="row no-gutters">
                                            <div class="col-12"><h1 class="hotel_name"> <a href="#" >Splendors Hotel</a></h1></div>
                                            <div class="col-12">
                                                    <p class="location"><i class="icon map marker alternate"></i> <a href="#"> Lilongwe - view on Google maps</a></p>
                                            </div>
                                            <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                        <p style="color:red;font-weight: lighter;font-family: nuni-reg;"><i class="icon check"></i>Upfront payment required</p>
                                                </div>
                                                <div class="col-12">
                                                        <p style="color:black;font-weight: lighter;font-family: nuni-reg;"><i class="icon chevron right"></i>Breakfast included</p>
                                                </div>
                                                <div class="col-12">
                                                        <p style="color:black;font-weight: lighter;font-family: nuni-reg;"><i class="icon rss"></i>50 MB WiFi Voucher / Day </p>
                                                </div>
                                            </div>
                                                </div>
                                        </div>
                                    
                                      
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <h4 style="width:100%;padding:.2em;background:black;text-align: center;color:white;">More</h4>
                                        <div class="container-fluid">
                                            <h5 style="color:green;font-family: nuni-reg;">USD 28 / Night</i></h5>
                                            <div class="ui divider" ></div>
                                            <button class="btn btn-block btn-sm btn-warning flat-field">See Availability</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          

                    </div>
                                
                </div>
            </div>
            
        </div>
    </div>




    <div class="row" style="padding:1.3em;background:rgb(55, 67, 231);">
        
        <div class="container">
        <center>
            <h3 class="h3" style="color:white;font-family:mali-reg;padding:.6em;text-align:center;">
                Have an HD perspective of some popular destinations!
            </h3>
        </center>
        <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-6">
                            <div class="ui image">
                                <img src="../../assets/img/g5.jpg" alt="" class="img img-thumbnail">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="ui image">
                                <img src="../../assets/img/g9.jpg" alt="" class="img img-thumbnail">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-6">
                            <div class="ui image">
                                <img src="../../assets/img/g3.jpg" alt="" class="img img-thumbnail">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="ui image">
                                <img src="../../assets/img/g7.jpg" alt="" class="img img-thumbnail">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                <div class="bd-example">
							<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
								<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
								<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
								<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
								</ol>
								<div class="carousel-inner">
								<div class="carousel-item active">
									<img src="../../assets/img/g1.jpg" class="d-block w-100" alt="...">
									<div class="carousel-caption d-none d-md-block">
									 <h5>First slide label</h5>
									<p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p> 
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../assets/img/g4.jpg" class="d-block w-100" alt="...">
									<div class="carousel-caption d-none d-md-block">
									 <h5>Second slide label</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
									</div>
								</div>
								<div class="carousel-item">
									<img src="../../assets/img/g6.jpg" class="d-block w-100" alt="...">
									<div class="carousel-caption d-none d-md-block">
									 <h5>Third slide label</h5>
									<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p> 
									</div>
								</div>
								</div>
								<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
								</a>
							</div>
							</div>
						</div>
                </div>
            </div>
            
        </div>
    </div>
   
    <?php require("../footer.html")?>
   
    
</body>
</html>