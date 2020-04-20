<?php
	header("Access-Control-Allow-Origin:*");
	header("Content-Type: application/x-www-form-urlencoded");
    

	include("../controller/db_conn.php");
	$data = array('status' => '','message' => '','data' => '' );

	if(isset($_GET['ticket_id'])){
		$query = mysqli_query($conn, "SELECT * FROM bus_reservation JOIN trip 
			WHERE bus_reservation.reservation_id = '".strtoupper($_GET['ticket_id'])."' AND bus_reservation.trip_id = trip.trip_id ");
			$rows = array();
		if($query){
			if(mysqli_num_rows($query) > 0){
				while($row = mysqli_fetch_assoc($query)){
					$rows[] = $row;
				}
				$data["status"] = "success";
				$data["message"] = "Ticket found!";
				$data["data"] = $rows;
			}else{
				$data["status"] = "info";
				$data["message"] = "The entered ticket number does not exist!";
			}
		}else{
			$data["status"] = "error";
			$data["message"] = "System encountered an error! ".mysqli_error($conn);
		}
		echo json_encode($data);
	}
?>