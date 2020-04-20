<?php
    header("Access-Control-Allow-Origin:*");
    session_start();
    include_once("db_conn.php");
    $_step = $_REQUEST['step'];
    $trip_id = $_REQUEST['trip_id'];
    $_SESSION["trip_id"] = $trip_id;

    $payload = array('status'=>'','message'=>'','data'=>'');

    if($_step == "one"){
        $get_trip = mysqli_query($conn, "SELECT *  FROM trip JOIN bus JOIN company_details 
        WHERE trip.trip_id = $trip_id AND bus.company = company_details.company_id AND trip.bus_id = bus.bus_id 
        ORDER BY trip.departure_date, trip.departure_time ");

        //$orig = getDistrict();

        if($get_trip){
                 $data_dump = array('trip_id'=>'','company' => '','origin' => '','destination' => '',
                        'date' => '','d_time' => '','a_time' => '','lapse' => '','price' => '','seats' => '');

                $row = mysqli_fetch_assoc($get_trip);

                $data_dump['company'] = $row['company_name']." (".strtoupper($row['type'])."), ".$row['bus_id'];
                $data_dump['origin'] = getDistrict($row['origin']);
                $data_dump['destination'] = getDistrict($row['destination']);
                $data_dump['date'] =  date('F jS, Y', strtotime($row['departure_date']));
                $data_dump['d_time'] = strtoupper(date("g:i a", strtotime($row['departure_time'])));
                $data_dump['a_time'] = strtoupper(date("g:i a", strtotime($row['arrival_time'])));
                $data_dump['lapse'] = (abs($row['lapse'])/(10000))." hrs";
                $data_dump['price'] = $row['_price'];
                $data_dump['seats'] = $row['avail_seats'];
                $data_dump['trip_id'] = $trip_id;

                $payload['status'] = "success";
                $payload['message'] = "Ticket built";
                $payload['data'] = $data_dump;
        }else{
            $payload['status'] = "error";
            $payload['message'] = "Failed to query trip data! ".mysqli_error($conn);
        }
        echo json_encode($payload);
    }else if($_step == "two"){
        $num_seats = $_GET["num_seats"];
        $fname = $_GET["fname"];
        $lname = $_GET["lname"];
        $email = $_GET["email"];
        $phone = $_GET["phone"];
        $gender = $_GET["gender"];
        $total = $_GET["total"];

        $customer = $fname." ".$lname;
        //$pay_method = $_GET["pay_method"];
        $ref_id= generateReference();

        if($num_seats <= checkAvailability($trip_id)){
            $reserve = mysqli_query($conn, "INSERT INTO bus_reservation (reservation_id,trip_id,customer_name, email_address, 
            phone_number, seats_reserved, amount,payment,status) VALUES('$ref_id','$trip_id','$customer','$email','$phone','$num_seats','$total','Pending','Pending')");
            if($reserve){
                require("DPOIntegration.php");
                $payload['status'] = "success";
                $payload['message'] = "You have successfully reserved $num_seats seats. Your Reference ID is '$ref_id'. 
                Use this code to track the status of your Reservation, 
                the Bus you are expected to board and also to pay for this Resevation in the Payments Page if you havent done so already. 
                Note that we can only reserve seats for you up until 5 hours before departure. If you will have not paid by then, your reservation will automatically be terminated!";

                $TransactionData = array();
                $TransactionData["amount"] = $total;
                $TransactionData["TransRef"] = $ref_id;
                $TransactionData["currency"] = getCurrency($_SESSION["trip_id"]);
                $TransactionData["CompanyRef"] = "Ticket Ref: ".$ref_id;
                $TransactionData["description"] = "This is a test Bus Ticket Booking!";
                $TransactionData["email"] = $email;
                $TransactionData["fname"] = $fname;
                $TransactionData["lname"] = $lname;
                $TransactionData["redirect_suffix"] = "booking/";

                $payload = initializeTransaction($TransactionData);
                // $_SESSION["ref_id"] = $ref_id;
                // $_SESSION["payfor"] = "bus_ticket";
                // $_SESSION['timeout'] = time();

                updateAvailSeats($trip_id, $num_seats);
            }else{
                $payload['status'] = "error";
                $payload['message'] = "Error: ".mysqli_error($conn);
            }
        }else{
            $payload['status'] = "error";
            $payload['message'] = "Failed to confirm Seats' availability!";
        } 
        echo json_encode($payload);
    }

    function getCurrency($trip_id){
        $sql = mysqli_query($GLOBALS["conn"], "SELECT currency FROM trip WHERE trip_id = '$trip_id'");
        $row= mysqli_fetch_assoc($sql);
        return $row["currency"];
    }
    function checkAvailability($id){
        $check = mysqli_query($GLOBALS['conn'], "SELECT avail_seats FROM trip WHERE trip_id = $id");
        $row = mysqli_fetch_assoc($check);
        return $row['avail_seats'];
    }

    //FUNCTIONS

    function getDistrict($id){
        $district =mysqli_query($GLOBALS['conn'], "SELECT district_name FROM district WHERE district_id = $id ");
        $row = mysqli_fetch_assoc($district);
        return $row["district_name"];
    }

    function generateReference(){
        $_prefix = "BRID-";
        $_suffix = rand(1000,9999);
        $_proposed_ref = $_prefix.$_suffix;

        $check = mysqli_query($GLOBALS['conn'], "SELECT COUNT(*) AS num FROM bus_reservation WHERE reservation_id = '$_proposed_ref'");
        $res = mysqli_fetch_assoc($check);
        if($res['num'] > 0){
            generateReference();
        }else{
            return $_proposed_ref;
        }
    }

    function updateAvailSeats($id,$booked_seats){
        $update = mysqli_query($GLOBALS['conn'], "UPDATE trip SET avail_seats = (avail_seats - $booked_seats) WHERE trip_id = '".$id."'");
        if(!$update){
            echo mysqli_error($GLOBALS['conn']);  
        }
    }
?>