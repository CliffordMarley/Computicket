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
  <script type="text/javascript" src="js/client_processes.js"></script>
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
    <a href="index.php" class="list-group-item list-group-item-action bg-light">Merchants </a>
    <a href="car-rental.php" class="list-group-item list-group-item-action bg-dark">Car Rentals</a>
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

      <div class="container-fluid">
          <div class="row" id="headline">
              <div class="col-6" ><h2 id="">Add & Manage Client Accounts</h2></div>
              <div class="col-3">
                    <button style="margin-top:.4em;" type="button" class="btn btn-block btn-success flat-field" data-toggle="modal" data-target="#exampleModalCenter" type="submit">Add New Client <i class="fa fa-plus-circle"></i> </button>
              </div>
          </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="form-sm">
                        <div class="form-group" style="padding:.3em;padding-left:15%;padding-right:15%;border-radius: 100%;margin-top:.5em;">
                            <input type="text" placeholder="Search by keyword here..." id="search_field" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <table class="table table-striped table-sm" style="width:100%;">
                        <thead id="bar">
                            <th id="hh">Client-ID</th>
                            <th id="hh">Company Name</th>
                            <th id="hh">Industry</th>
                            <th id="hh">Email Address</th>
                            <th id="hh">Contact #</th>
                            <th id="hh">Location / Address</th>
                            <th id="hh">Action</th>
                        </thead>
                        <tbody>
    <?php
    
    $query = mysqli_query($conn,"SELECT * FROM company_details JOIN indulstry 
    WHERE company_details.indulstry = indulstry.indulstry_id AND company_details.status = 'Active'
   ORDER BY indulstry.name ASC");
    while($row = mysqli_fetch_assoc($query)){
      ?>
<tr>
      <td class='data'><?php echo $row['company_id'] ?></td>
      <td class='data'><?php echo $row['company_name'] ?></td>
      <td class='data'><?php echo $row['name'] ?></td>
      <td class='data'><?php echo $row['email_address'] ?></td>
      <td class='data'><?php echo $row['phone'] ?></td>
      <td class='data'><?php echo $row['phy_address'] ?></td>
      <td class="row no-gutters">
        <div class="col-6">
          <a href="#edit<?php echo $row['company_id']; ?>" data-toggle="modal" class="btn btn-block btn-sm flat-field btn-warning">Edit</a>
        </div>
        <div class="col-6">
        <a href=<?php echo "php_scripts/deleteCompany.php?company_id=".$row['company_id']; ?> value = <?php echo $row['company_id']; ?> class="btn btn-block btn-sm flat-field btn-danger">Delete</a>
        </div>
        <?php include('button.php');?>
      </td>
 </tr>
  <?php    
    }
  ?>  
    
                        </tbody>
                    </table>

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

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hiiden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Add New Client</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hiiden="true">&times;</span>
              </button>
            </div>
            <form class="modal-body">
                <div class="row">
                    <div class="col-7 form-group">
                        <label for="Company name">Company name</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Enter company name here" id="company_name" requred/>
                    </div>
                    <div class="form-group col-5">
                        <label for="">Industry</label>
                        <select id="industry" class="form-control form-control-sm">
                            <option selected disabled>Choose Industry</option>
                            <?php
                                $opt = mysqli_query($conn, "SELECT * FROM indulstry ORDER BY name ASC");
                                while($row = mysqli_fetch_assoc($opt)){
                                    echo "<option value=".$row['indulstry_id'].">".$row['name']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="">Email Address</label>
                        <input type="email" class="form-control form-control-sm" placeholder="e.g youname@domain.com" id="email_address">
                    </div>
                    <div class="col-6 form-group">
                        <label for="">Phone number</label>
                        <input type="tel" class="form-control form-control-sm" placeholder="+265 145 6756" id="phone_number" required/>
                    </div>
                    <div class="col-12 form-group">
                        <label for="">Physical Address</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Enter traceable aidress here" id="phy_address" required/>
                    </div>
                </div>
              </form>
            <div class="modal-footer">
              <button type="reset" id="modal_dismiss" class="btn btn-secondary btn-sm flat-field" data-dismiss="modal">DISCARD</button>
              <button type="button" id="add_company_btn" class="btn btn-primary btn-sm flat-field">REGISTER</button>
            </div>
          </div>
        </div>
      </div>
<!-- Modal Ends here -->


</body>

</html>
