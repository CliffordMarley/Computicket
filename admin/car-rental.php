<?php
    session_start();
    if(!isset($_SESSION['access']) && $_SESSION['access'] != "granted" || (time() - $_SESSION['timeout']) > 1200){
      session_destroy();
      header("LOCATION:cgi-bin.php");
    }
    $_SESSION['timeout'] = time();
    include_once("php_scripts/beta_db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Computicket Admin Dashboard</title>
  <link rel="icon" href="../assets/img/Computicket.jpg" type="image/jpg">

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="../css/fonts.css">
  <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../lib/sweetalerts/sweetalert.css">
  <link rel="stylesheet" href="../lib/semantic/dist/semantic.min.css">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

  <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script type="text/javascript" src="js/car_rental.jsx"></script>
  <script src="../lib/sweetalerts/sweetalert.min.js"></script>
  <script src="../lib/sweetalerts/sweetalert.js"></script>
  
</head>

<body>

<div class="d-flex" id="wrapper">

<!-- Sidebar -->
<div class="bg-dark border-dark" id="sidebar-wrapper">
<div class="sidebar-heading" style="color:white;font-family:electra;">Compu<span style="color:red;">ticket</span></div>
  <div class="list-group list-group-flush">
    <a href="dashboard.php" class="list-group-item list-group-item-action bg-dark">Dashboard</a>
    <a href="index.php" class="list-group-item list-group-item-action bg-dark">Merchants </a>
    <a href="car-rental.php" class="list-group-item list-group-item-action bg-light">Car Rentals</a>
    <a href="buses.php" class="list-group-item list-group-item-action bg-dark">Bus & Trips</a>
    <a href="hotels.php" class="list-group-item list-group-item-action bg-dark">Hotel </a>
    <a href="events.php" class="list-group-item list-group-item-action bg-dark">Events </a>
    <a href="payments.php" class="list-group-item list-group-item-action bg-dark">Finances </a>
    <a href="accounts.php" class="list-group-item list-group-item-action bg-dark">Accounts </a>
    <a href="config.php" class="list-group-item list-group-item-action bg-dark">Configuration</a>
  </div>
</div>
<!-- /#sidebar-wrapper -->

<!-- Page Content -->
<div id="page-content-wrapper">

 
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
        <button class="btn btn-primary btn-sm flat-field" id="menu-toggle">Extend Page</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
            <a  class="nav-link">Logged in as : <span style="color:red;font-family:mali-reg;">
            <?php echo strtoupper($_SESSION["fullname"])."(<span style='color:white;'>".$_SESSION['role']."</span>)";?></span></a>
            </li>
        </ul>
        </div>
    </nav>

      <div class="row">
      <div class="col-12">
        <h1 style="text-align:center;font-family:oswald;color:white;background:orangered;padding:.5%;margin-bottom:4%;" class="display-4">
          CAR RENTAL SERVICES
        </h1>
      </div>
        <div class="col-12 col-lg-10">
        <div class="row">
            <div class="col-12">
              <?php
                if(isset($_SESSION["message"])){
                    echo $_SESSION["message"];
                }
              ?>
            </div>
          </div>
          
          <form id="new_car_form" action="./php_scripts/addCarListing.php" method="POST" class="form container" enctype="multipart/form-data">
          <div class="ui dividing header" style="font-family:mali-reg;margin-bottom:6%;">ADD CAR TO LISTING</div>
              <div class="form-row">
                <div class="col form-group">
                  <label for="">Car Image 1</label><br>
                  <div class="ui image small car_display">
                    <img src="" id="image0" class="img img-thumbnail">
                  </div>
                </div>
                <div class="col form-group">
                  <label for="">Car Image 3</label><br>
                  <div class="ui image small car_display">
                    <img src="" id="image1" class="img img-thumbnail">
                  </div>
                </div>
                <div class="col form-group">
                  <label for="">Car Image 3</label><br>
                  <div class="ui image small car_display">
                    <img src="" id="image2" class="img img-thumbnail">
                  </div>
                </div>
                <div class="col form-group">
                  <label for="">Car Image 4</label><br>
                  <div class="ui image small car_display">
                    <img src="" name="images" id="image3" class="img img-thumbnail">
                  </div>
                </div>

              </div>
              <div class="form-row">
                <div class="col-8"></div>
                <div class="col-4 form-group">
                  <input type="file" name="file[]" id="images" hidden multiple/>
                  <button type="button" id="add_cars_btn" class="btn btn-md btn-block btn-danger flat-field">Add car images</button>
                </div>
              </div>

              <div class="form-row" >

                <div class="col-3 form-group">
                  <label for="">Car Rental Company :</label>
                  <select name="company" class="form-control form-control-md">
                    <option selected disabled>Select Car Company</option>
                    <?php
                      $sql = mysqli_query($conn,"SELECT company_name, company_id FROM company WHERE industry = '3' ")or die(mysqli_error($conn));
                      while($row = mysqli_fetch_assoc($sql)){
                      ?>
                        <option value="<?php echo $row['company_id']?>"><?php echo $row['company_name'];?></option>
                      <?php
                        }
                      ?>
                  </select>
                </div>
                <div class="col-3 form-group">
                    <label for="">Reg # :</label>
                    <input type="text" name="reg_number" placeholder="Licence Plate" class="form-control form-control-md">
                </div>

                <div class="col-6 form-group">
                  <label for="">Brand / Model :</label>
                  <select name="brand" class="form-control form-control-md">
                    <option selected disabled>Select Make</option>
                    <?php
                      $sql = mysqli_query($conn,"SELECT * FROM car_manufacturer JOIN car_brand 
                      WHERE car_brand.manufacturer = car_manufacturer.mnf_id ORDER BY car_manufacturer.name, car_brand.brand_name ASC ")or die(mysqli_error($conn));
                      while($row = mysqli_fetch_assoc($sql)){
                      ?>
                        <option value="<?php echo $row['brand_id']?>"><?php echo $row['name'].", ".$row["brand_name"];?></option>
                      <?php
                        }
                      ?>
                  </select>
                </div>

                <!-- <div class="col-3 form-group">
                  <label for="">Brand :</label>
                  <input type="text" name="brand" placeholder="Car Brand" class="form-control form-control-md">
                </div> -->
              </div>

              <div class="form-row" >
                <div class="col-4 form-group">
                  <label for="">Transmission :</label>
                  <select name="transmission" class="form-control form-control-md">
                    <option selected disabled>Select Transmission</option>
                    <option value="Automatic">Automatic</option>
                    <option value="Semi-Automatic">Semi Automatic</option>
                    <option value="Manual">Manual</option>
                    <option value="Varying">Varying</option>
                  </select>
                </div>
                <div class="col-2 form-group">
                  <label for="">Capacity :</label>
                  <input type="number" placeholder="Maximum Capacity" min="2" value="2" class="form-control form-control-md" name="capacity">
                </div>
                <div class="col-6 form-group">
                  <label for="">Other Features :</label>
                  <input type="text" placeholder="Separate by coma e.g Aircon, Radio" class="form-control form-control-md" name="features">
                </div>
                <div class="col-3 form-group">
                  <label for="">Price ($) :</label>
                  <input type="number" placeholder="Price in US Dollars ($)" min="1" class="form-control form-control-md" name="price">
              </div>
              <div class="col-3 form-group">
                <label for="">Unit :</label>
                <select name="unit" class="form-control form-control-md">
                  <option selected disabled>Select Unit</option>
                  <option value="Hour">Hour</option>
                  <option value="Day">Day</option>
                  <option value="Week">Week</option>
                  <option value="Month">Month</option>
                  <option value="Year">Year</option>
                </select>
              </div>
              <div class="col-3 form-group">
                    <label for="">Location :</label>
                    <select name="location" class="form-control form-control-md">
                    <option selected disabled>Choose District</option>
                    <?php
                      $sql = mysqli_query($conn,"SELECT * FROM district ORDER BY district_name ASC ")or die(mysqli_error($conn));
                      while($row = mysqli_fetch_assoc($sql)){
                      ?>
                        <option value="<?php echo $row['district_id']?>"><?php echo $row['district_name'];?></option>
                      <?php
                        }
                      ?>
                  </select>
              </div>
              <div class="col-3 form-group">
                <label style="color:white;">_________</label>
                <input type="submit" name="save_car_to_list" class="btn btn-md btn-block flat-field btn-success" value="ADD TO LIST">
              </div>
              </div>
              
          </form>
          <div class="row" id="rental_details" style="display:none;padding:2em;padding-top:0;">
               <div class="container">
                 <div class="row">
                   <div class="col-12" style="padding:1.2em;padding-top:.8em;padding-bottom:0;">
                     <div class="ui dividing header" style="font-family:mali-reg;margin-bottom:1%;">CAR RENTAL DETAILS</div>
                     <form action="#" class="form">
                       <div class="form-row">
                         <div class="col-3 form-group">
                           <label>Reference # :</label>
                           <input type="text" placeholder="e.g 1234" class="form-control flat-field" id="ref_num">
                          </div>
                          <div class="col-3 form-group">
                           <label>Customer Name :</label>
                           <input type="text" placeholder="e.g John Smith" class="form-control flat-field" id="customer_name">
                          </div>
                          <div class="col-3 form-group">
                            <label>Vehicle Status :</label>
                            <select id="vehicle_status" class="form-control flat-field">
                              <option value="" selected>All</option>
                              <option value="Pending">Pending</option>
                              <option value="Approved">Approved</option>
                              <option value="Postponed">Postponed</option>
                              <option value="Cancelled">Cancelled</option>
                            </select>
                          </div>
                          <div class="col-1 form-group ">
                           <label style="color:white;background:white;">______</label>
                           <input type="button" value="Search" id="searchRentalsBtn" class="btn flat-field btn-block btn-md btn-primary">
                          </div>
                       </div>
                     </form>
                     <table class="table table-striped table-sm table-hover">
                        <thead id="bar">
                          <th id="ss">REFERENCE</th>
                          <th id="ss">CUSTOMER NAME</th>
                          <th id="ss">EMAIL ADDRESS</th>
                          <th id="ss">MOBILE NUMBER</th>
                          <th id="ss">PICKUP</th>
                          <th id="ss">DROPOFF</th>
                          <th id="ss">PAYMENT</th>
                          <th id="ss">REG #</th>
                          <th id="ss">STATUS</th>
                        </thead>

                        <tbody id="rental_list_body">

                        </tbody>
                     </table>
                   </div>
                 </div>
               </div>
          </div>
        </div>
        <div class="col-12 col-lg-2">
              <div class="row">
                      <div class="container">
                        <div class="col-12" id="tab-buttons">
                          <button type="button" id="add_cars" class="page_tab_btns btn flat-field btn-md btn-block tabbed">ADD NEW CAR</button>
                          <button type="button" id="view_rentals" class="page_tab_btns btn flat-field btn-md btn-block">VIEW RENTALS</button>
                          <button type="button" class="page_tab_btns btn flat-field btn-md btn-block">TRANSACTIONS</button>
                        </div>
                      </div>
              </div>
        </div>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

<!-- Client Aid Modal -->

<?php require_once("loader.php");?>

</body>

</html>
