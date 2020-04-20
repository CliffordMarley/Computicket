<?php
   session_start();
   if(!isset($_SESSION['access']) && $_SESSION['access'] != "granted" || (time() - $_SESSION['timeout']) > 1200){
     session_destroy();
     header("LOCATION:cgi-bin.php");
   }
   $_SESSION['timeout'] = time();
  include_once("php_scripts/db_conn.php");
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
  <script src="../lib/sweetalerts/sweetalert.min.js"></script>
  <script src="../lib/sweetalerts/sweetalert.js"></script>
  <script src="../lib/semantic/dist/semantic.min.js"></script>
  <script src="js/hotels.js"></script>

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-dark border-dark" id="sidebar-wrapper">
    <div class="sidebar-heading" style="color:white;font-family:electra;">Compu<span style="color:red;">ticket</span></div>
      <div class="list-group list-group-flush">
        <a href="dashboard.php" class="list-group-item list-group-item-action bg-dark">Dashboard</a>
        <a href="index.php" class="list-group-item list-group-item-action bg-dark">Merchants </a>
        <a href="car-rental.php" class="list-group-item list-group-item-action bg-dark">Car Rentals</a>
        <a href="buses.php" class="list-group-item list-group-item-action bg-dark">Bus & Trips</a>
        <a href="hotels.php" class="list-group-item list-group-item-action bg-light">Hotel </a>
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


      <div class="container-fluid">
        <h2 class="mt-4" id="headline">Hotels Management</h2>
      <div class="row">
      	<div class="col-10">
          <div class="row">
              <div class="col-12">
                <div class="ui search fluid">
                  <div style="width:100%;" class="ui mini icon input">
                    <input  class="prompt" type="text" placeholder="SEARCH HOTEL BY NAME...">
                    <i class="search icon"></i>
                  </div>
                  <div class="results"></div>
                </div>
              </div>
          </div>
          <div class="ui divider"></div>
          <table class="table table-sm table-striped">
            <thead id="bar">
              <th id="hh">Domain Company</th>
              <th id="hh">Hotel Name</th>
              <th id="hh">Email Address</th>
              <th id="hh">Phone Number</th>
              <th id="hh">District</th>
              <th id="hh">Location</th>
              <th id="hh">Action</th>
            </thead>

            <tbody id="hotels_list">
              <?php
                $hotel_query = mysqli_query($conn, "SELECT * FROM company_details, hotel, district 
                WHERE hotel.status = 'Active' AND company_details.company_id = hotel.domain AND hotel.district = district.district_id
                ORDER BY company_details.company_name");

                if($hotel_query){
                    if(mysqli_num_rows($hotel_query) <= 0){

                    }else{
                      while($row = mysqli_fetch_assoc($hotel_query)){
                        echo "<tr id='".$row['hotel_id']."'>
                                <td class='data'>".$row['company_name']."</td>
                                <td class='data'>".$row['hotel_name']."</td>
                                <td class='data'><a href='mailto:".$row['email']."'>".$row['email']."</a></td>
                                <td class='data'>".$row['phone']."</td>
                                <td class='data'>".$row['district_name']."</td>
                                <td class='data'>".$row['phy_address']."</td>
                                <td><input type='checkbox' onchange=readyRow('".$row['hotel_id']."') id=".$row['hotel_id']."></td>
                              </tr>";
                      }
                  }
                }else{
                    echo mysqli_error($conn);
                } 
              ?>
            </tbody>
          </table>
        </div>

        <div class="col-2">
          <div class="row">

            <!-- Add Button -->
            <div class="col-12">
              <button type="button" data-target = "#newhotel" data-toggle="modal" class="ui button circular icon fluid positive btt">Add New Hotel <i class="icon add"></i></button>
            </div>
            <!-- End Button -->

            <!-- Add Button -->
            <div class="col-12">
              <button class="ui button circular icon fluid orange btt">Update Hotel <i class="icon edit"></i></button>
            </div>
            <!-- End Button -->

             <!-- Add Button -->
             <div class="col-12">
              <button type="button" id="delete_hotels" class="ui button circular icon fluid negative btt">Delete Hotel <i class="icon trash"></i></button>
            </div>
            <!-- End Button -->

             <!-- Add Button -->
             <div class="col-12">
              <button class="ui button circular icon fluid black btt">View Account <i class="icon eye"></i></button>
            </div>
            <!-- End Button -->


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

<!-- Modal -->
<div class="modal fade" id="newhotel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hiiden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="headline" style="width:100%;padding:.3em;">ADD NEW HOTEL</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hiiden="true">&times;</span>
              </button>
            </div>
            <form class="modal-body" action="hotels.php" method="GET">
                <div class="row">
                  <div class="col-12 form-group">
                    <label for="">Parent Company / Domain</label>
                    <select id="domain" class="form-control form-control-sm">
                      <option selected disabled>Select company</option>
                      <?php
                        $company = mysqli_query($conn, "SELECT * FROM company_details WHERE indulstry = 2 ORDER BY company_name ASC");
                        while($row = mysqli_fetch_assoc($company)){
                            echo "<option value=".$row['company_id'].">".$row['company_name']."</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-12 form-group">
                    <label for="">Hotel Name    or <span><input type="checkbox" id="sap"> Same as Parent</span>  </label>
                    <input type="text" id="hotel_name" class="form-control form-control-sm" placeholder="Enter Hotel Name here" required/>
                  </div>
                  <div class="col-6 form-group">
                    <label for="">Email Address</label>
                    <input type="email" id="email_address" placeholder="e.g yourname@domain.com" class="form-control form-control-sm">
                  </div>
                  <div class="col-6 form-group">
                    <label for="">Phone Number</label>
                    <input type="tel" id="phone_number" placeholder="e.g +265 1 684 7857" class="form-control form-control-sm" required/>
                  </div>
                  <div class="col-4 form-group">
                    <label for="">District</label>
                    <select id="district"  class="form-control form-control-sm">
                        <option disabled selected>Select district</option>
                        <?php
                          $district = mysqli_query($conn, "SELECT * FROM district ORDER BY district_name ASC");
                          while($row = mysqli_fetch_assoc($district)){
                              echo "<option value=".$row['district_id'].">".$row['district_name']."</option>";
                          }
                        ?>
                    </select>
                  </div>
                  <div class="col-8 form-group">
                    <label for="">Address / Location</label>
                    <input type="address" id="address" placeholder="Enter address here" class="form-control form-control-sm">
                  </div>
                </div>
              </form>
            <div class="modal-footer">
              <button type="reset" id="modal_dismiss" class="btn btn-secondary btn-sm flat-field" data-dismiss="modal">DISCARD</button>
              <input type="button" id="save_hotel" value="SAVE HOTEL" class="btn btn-primary btn-sm flat-field">
            </div>
          </div>
        </div>
      </div>
<!-- Modal Ends here -->
</body>

</html>
