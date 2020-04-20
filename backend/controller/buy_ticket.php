<?php
session_start();
header("Access-Control-Allow-Origin:*");
$inc = include_once("db_conn.php");
require("DPOIntegration.php");

$data_dump = $_POST["data"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email_address = $_POST["email_address"];
$variable =  json_decode($data_dump);
$booking_id = generateReference();
$total = 0;

$data = array('status' =>  '', 'title' => '', 'message' => '');
if($inc){
	$_SESSION["ref_id"] = $booking_id;
	$_SESSION["payfor"] = "event_ticket";

	foreach($variable as $dt){
	    $book = bookTicket($dt->event_id, $dt->ticket_class, $dt->quantity);
	    if($book == "error"){
	    	$data['status'] = "error";
	    	$data["title"] = "Booking Failed!";
	    	$data["message"] = "Failed to process your request. Try again in a moment!";
	    	rollback();
	    	break;
	    }else{
			
			$payload = array();
			$payload["amount"] = $GLOBALS['total'];
			$payload["TransRef"] = $_SESSION["ref_id"];
			$payload["CompanyRef"] = "Event ticket booking!";
			$payload["description"] = "This is a test booking";
			$payload["email"] = $email_address;
			$payload["fname"] = $fname;
			$payload["lname"] = $lname;
			$payload["EmailMessage"] = "You have successfully reserved Event Ticket(s). 
					Click the following link to pay ";
			$payload["redirect_suffix"] = "events/";


			$data = initializeTransaction($payload);
	    }
	}
	
}else{
	$data["status"] = "error";
	$data["title"] = "Database Error!";
	$data["message"] = "Link to the database server was broken!";
}
echo json_encode($data);



function bookTicket($event_id, $t_c, $q){
		$res = getTicketID($event_id, $t_c);
		if($res == "error"){
			return "error";
		}else{
			$price = $res["price"];
			// echo $price;
			// return;
			$ticket_id = $res["ticket_id"];
			$GLOBALS["total"] += ($price * $q);
			//echo $GLOBALS["total"];
		
	        $query = mysqli_query($GLOBALS["conn"], "INSERT INTO booked_event_tickets (booking_id, ticket_id, total, email_address,fname,lname, pay_status) 
	        VALUES('".$GLOBALS['booking_id']."','$ticket_id','".$GLOBALS['total']."', '".$GLOBALS['email_address']."','".$GLOBALS['fname']."','".$GLOBALS['lname']."','Pending')");
	        if($query){
	        	return "done";
	        }else{
	            return "error";
	    	}
		}
}

function getTicketID($eid, $status){
	$dtr = array('price' => '', 'ticket_id' => '');;
	$sql = mysqli_query($GLOBALS["conn"], "SELECT ticket_id, price FROM event_ticket WHERE event_id = '$eid' AND status = '$status' LIMIT 1");
	if($sql){
		while ($row = mysqli_fetch_assoc($sql)) {
			$dtr["price"] = $row["price"];
			$dtr["ticket_id"] = $row["ticket_id"];
		}
		return $dtr;
	}else{
		return "error";
	}
}
function rollback(){
	$reverse = mysqli_query($GLOBALS['conn'], "DELETE FROM booked_event_tickets WHERE booking_id = '".$GLOBALS["booking_id"]."' ");
}

function generateReference(){
        $_prefix = "EVT-";
        $_suffix = rand(1000,9999);
        $_proposed_ref = $_prefix.$_suffix;

        $check = mysqli_query($GLOBALS['conn'], "SELECT COUNT(*) AS num FROM booked_event_tickets 
        	WHERE booking_id = '$_proposed_ref'");
        $res = mysqli_fetch_assoc($check);
        if($res['num'] > 0){
            generateReference();
        }else{
            return $_proposed_ref;
        }
    }

?>
