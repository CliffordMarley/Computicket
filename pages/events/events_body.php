
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css">
<link rel="stylesheet" type="text/css" href="bootstrap/style.css">
<link href="bootstrap/fontawesome/css/all.css" rel="stylesheet"> 
<script type="text/javascript" src="bootstrap/jquery-1.12.1.min.js"></script>
<script type="text/javascript" src="bootstrap/bootstrap.min.js"></script> -->

<style>
  .date .month{
    font-family:mali-reg;
    font-size:32px;
    font-weight:bold;
  }
  .date .day{
    font-family:nuni-reg;
    font-size:25px;
  }
  .definition b{
    font-family:nuni-reg;
    color:green;
    font-weight:bold;
    font-size:16px;
  }
  .definition{
    font-family:nuni-reg;
    font-weight:bold;
    font-size:16px;
  }
  .subcontent .location{
    font-family:nuni-reg;
    font-size:22px;
  }
</style>

</head>

<body style="padding-top:15%;">

 <div class="container" >
                <div class="col-md-12"><!--body content title holder with 12 grid columns-->
                    <h1>What's On?</h1><!--body content title-->
                </div>
  </div>

<div class="container">
            <div class="col-md-12">
            <hr>
            </div>
            </div>
<div class="container" id="events_list_area" >
<?php
  $query = mysqli_query($conn, "SELECT * FROM events
  ORDER BY event_date, event_name ASC") or Die($conn);

  while($row = mysqli_fetch_assoc($query)){
    $get_prices = mysqli_query($GLOBALS['conn'], "SELECT  price , ticket_id status FROM event_ticket WHERE event_id = '".$row['event_id']."' ORDER BY price ASC") or Die($GLOBALS['conn']);
    $num_rows = mysqli_num_rows($get_prices);
    $pricing = "FREE";
    $price = "";
    if($num_rows > 1){
      $tracker = 1;
        while($row2 = mysqli_fetch_assoc($get_prices)){
          
            if($tracker == 1){
              $pricing =  "$ ".$row2["price"]." (".$row2['status']." Ticket)";
              $price = $row2["price"];
            }else{
               $pricing .=  " AND $ ".$row2["price"]." (".$row2['status']." Ticket)";
               $price .= ", ".$row2["price"];
            }
        $tracker++;
        }
    }else{
      $pricing = "FREE";
    }
    
    ?>
    <div class="container"><!--event content-->
                <section>
                    <div class="row">
                        <div class="date col-md-1"><!--date holder with 1 grid column-->
                            <span class="month"><?php echo strtoupper(date('M', strtotime($row['event_date']))); ?></span><br><!--month-->
                            <hr class="line"><!--css modified horizontal line-->
                            <span class="day"><?php echo strtoupper(date('d', strtotime($row['event_date']))); ?></span><!--day-->
                        </div>
                        <div class="col-md-5"><!--image holder with 5 grid column-->
                            <img src="<?php echo $row['image_url'];?>" class="img-responsive img-thumbnail img-md">
                        </div>
                        <div class="subcontent col-md-6"><!--event content holder with 6 grid column-->
                            <br>
                            <h1 class="title" style="font-family:mali-reg;"><?php echo strtoupper($row['event_name']);?></h1><!--event content title-->
                            <p class="location"><?php echo $row['description'];?></p>

                            <p class="definition"><!--event content definition-->    
                             <b>Date</b> : <?php echo strtoupper(date('F jS, Y', strtotime($row['event_date'])))?> <br>
                             <b>Price</b> :  <?php echo $pricing;?><br>
                             <b>Venue</b> : <?php echo $row['venue'];?> <i class="fa fa-map-marker" aria-hidden="true"></i> <a href="https://goo.gl/maps/WUX2BTKBabYEfNqu6">view map</a> 
                            </p>
                            <hr class="customline2"><!--css modified horizontal line-->
                            <button onclick = "setPrices(<?php echo $row['event_id'];?> ,'<?php echo $row['event_name']?>' , <?php echo $price; ?>)" id="<?php echo $row['event_id']?>" type="button" class="btn btn-warning flat-field btn-default btn-lg" data-toggle="modal" data-target="#exampleModalCenter"><!--view details button (no function implemented)-->
                                Buy Ticket <!--arrow right glyphicon-->
                            </button>
                        </div><!--subcontent div-->
                    </div><!--container div-->
                </section>
            </div><!--row div-->
             <div class="container">
               <div class="col-md-12">
                  <hr>
               </div>
             </div>
  <?php
  }
?>

</div>


	
	<!-- Modal -->
<div style="border-radius:0;" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle" style="background:teal;width:100%;padding:.3em;text-align:center;color:white;font-family:mali-reg;">BATCH TICKET PURCHASE</h5>
        <button type="button" id="cls" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-row">
                <div class="col-12 col-md-6">
                      <!--<label for="" style="color:black;">Firstname</label>-->
                      <input type="text" placeholder="Firstname" name="firstname" id="fname" class="form-control form-control flat-field">
                  </div>
                  <div class="col-12 col-md-6">
                      <!--<label for="" style="color:black;">Lastname</label>-->
                      <input type="text" placeholder="Lastname" name="lastname" id="lname" class="form-control form-control flat-field">
                  </div>
                  <div class="col-12">
                        <!--<label for="" style="color:black;">Email Address :</label>-->
                        <input type="email" name="email" placeholder="Email address" id="email_address" class="form-control form-control flat-field" required/>
                  </div>
              </div>
          <form action="#" class="form">
              <div class="form-row">
                  <div class="ui divider"></div>
                  <div class="col-8">
                    <!--<label for="" style="color:black;">Type of Ticket :</label>-->
                    <select id="t_c" class="form-control form-control flat-field">
                      <option disabled selected>Select ticket</option>
                      <option value="Standard" id="std_opt">STANDARD TICKET (K1000)</option>
                      <option value="VIP" id="vip_opt">VIP TICKET (K2000)</option>
                    </select>
                  </div>
                  <div class="col-4">
                    <!--<label for="" style="color:black;">Quantity</label>-->
                    <input id="t_q" type="number" min="1" value = "1" max="10" class="form-control form-control flat-field" required/>
                  </div>
                  <div class="col-12 form-group col-md-5">
                  <!--<label style="color:white;">______</label>-->
                    <button type="button" id="add_ticket" class="ui fluid button tiny circular icon positive">
                      Add to list<i class="icon add"></i>
                    </button>
                  </div>
              </div>      
              <input type="reset" id="ticket_form_reset" hidden>    
          </form>
          <div class="ui dividing header">Selected Tickets</div>
          <div class="table-responsive">
            <style>
              #ticket_head th{
                color:white;
              }
            </style>
             <table class="table striped table-striped table-sm" id="ticket_table">
              <thead class="bg-dark" id="ticket_head">
                  <th>EVENTS NAME</th>
                  <th >TICKET CLASS</th>
                  <th >QUANTITY</th>
                  <th >TOTAL (K)</th>
                  <th></th>
                </thead>
                <tbody id="ticket_body">

                </tbody>
             </table>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn flat-field btn-secondary" data-dismiss="modal">ADD MORE</button>
        <button id="buy_tickets_btn" type="button" class="btn flat-field btn-primary">BUY NOW <i class="icon cart"></i></button>
      </div>
    </div>
  </div>
</div>		
