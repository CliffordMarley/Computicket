<?php
    header("Access-Control-Allow-Origin:*");
	$queryString = "";
	require("beta_db_connect.php");
	$response = array();

	if(isset($_POST["ref_number"]) && !empty($_POST["ref_number"])){
		$queryString = " rental_id = '"."CRID-".$_POST['ref_number']."'";
	}
	if(isset($_POST["customer"]) && !empty($_POST["customer"])){
		($queryString == "") ? $queryString = " fname LIKE '%".$_POST['customer']."%' OR lname LIKE '%".$_POST['customer']."%'" : $queryString = " AND fname LIKE '%".$_POST['customer']."%' OR lname LIKE '%".$_POST['customer']."%'";
	}
	if(isset($_POST["v_status"]) && !empty($_POST["v_status"])){
		($queryString == "") ? $queryString = " status = '".$_POST['v_status']."' " : $queryString = " AND  status = '".$_POST['v_status']."'";
	}

	$sql = "SELECT * FROM car_booking ";
	if($queryString != ""){
		$sql .= "WHERE ".$queryString;
	}
	$query = $conn->query($sql);
	if($query){
		$rows = array();
		if($query->num_rows > 0){
			while($row = $query->fetch_assoc()){
				$rows[] = $row;
			}
			$response["status"] = "success";
			$response["title"] = "SUCCESS!";
			$response["message"] = "Car Rentals query executed OK!";
			$response["data"] = $rows;
		}else{
			$response["status"] = "info";
			$response["title"] = "EMPTY!";
			$response["message"] = "There are no records available!";
		}
		
	}else{
		$response["status"] = "error";
		$response["title"] = "SQL Error!";
		$response["message"] = "Error : ".mysqli_error($conn);
	}
	echo json_encode($response);
?>
