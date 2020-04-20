<?php
   header("Access-Control-Allow-Origin:*");
    // START SESSION
    session_start();

    // CONNECT TO DATABASE
    require_once("beta_db_connect.php");
    $data = array();

    //COLLECT REQUEST PARAMETERS
    $car_id = $_POST["car_id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $phone_number = $_POST["phone_number"];
    $email_address = $_POST["email_address"];
    $pickup = strtotime($_POST["pickup"]);
    $drop_off = strtotime($_POST["drop_off"]);

    $ref_id = generateReference();
    $createSession = $conn2->query("INSERT INTO car_booking(rental_id,fname,lname,car,email_address,phone_number,pickup,drop_off) 
    VAlUES ('".$ref_id."','".$fname."','".$lname."','".$car_id."','".$email_address."','$phone_number','".date("Y-m-d", $pickup)."','".date("Y-m-d", $drop_off)."')");

    if($createSession){
        require_once("DPOIntegration.php");
        $TransactionData = array();

        $obj = calculateTotal($car_id,$pickup,$drop_off);

        if($obj["status"] == "success"){
            $TransactionData["amount"] = $obj["total"];
            $TransactionData["TransRef"] = $ref_id;
            $TransactionData["currency"] = $obj["currency"];
            $TransactionData["serviceCode"] = "27846";
            $TransactionData["CompanyRef"] = $ref_id;
            $TransactionData["description"] = "This is a test Car rental service!";
            $TransactionData["email"] = $email_address;
            $TransactionData["fname"] = $fname;
            $TransactionData["lname"] = $lname;
            $TransactionData["redirect_suffix"] = "car-rentals/";

            $payload = initializeTransaction($TransactionData);
            if($payload["status"] == "error"){
                $GLOBALS["conn2"]->query("DELETE FROM car_booking WHERE rental_id = '".$ref_id."' ");
            }
            $data = $payload;
        }else{
            $data = $obj;
        }
    }else{
        $data["status"] = "error";
        $data["title"] = "SQL Error!";
        $data["message"] = mysqli_error($conn);
    }

    echo json_encode($data);

    function calculateTotal($car_id,$pickup,$drop_off){
       
        $sub = array();
        $cdata = $GLOBALS["conn2"]->query("SELECT price, unit,currency FROM car WHERE reg_number = '$car_id' LIMIT 1");
        if($cdata){
            $row = $cdata->fetch_assoc();
            
            $diff = floor(($drop_off - $pickup) / (60*60*24));

            if($row["unit"] == "Hour"){
                $diff = $diff * 24;
            }

            $total = $diff * $row["price"];

            $sub["status"] = "success"; 
            $sub["total"] = $total;
            $sub["currency"] = $row["currency"];
        }else{
            $sub["status"] = "error";
            $sub["title"] = "SQL Error!";
            $sub["message"] = "Error: ".mysqli_error($GLOBALS["conn2"]);
        }
        return $sub;
    }

    function generateReference(){
        $_prefix = "CRID-";
        $_suffix = rand(1000,9999);
        $_proposed_ref = $_prefix.$_suffix;

        $check = $GLOBALS['conn2']->query("SELECT * FROM car_booking WHERE rental_id = '$_proposed_ref'");

        if(mysqli_num_rows($check) > 0){
            generateReference();
        }else{
            return $_proposed_ref;
        }
    }
?>