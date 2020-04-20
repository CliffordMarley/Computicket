<?php
	header("Access-Control-Allow-Origin:*");
	header("Content-Type: application/x-www-form-urlencoded");
	
	include_once("db_conn.php");
	$fname = $_GET['fname'];
	$lname = $_GET['lname'];
	$onames = $_GET['onames'];
	$gender = $_GET['gender'];
	$dob = $_GET['dob'];
	$contact = $_GET['contact'];


	$data = array('status' => '', 'message' => '');

	$check_contact = mysqli_query($conn,"SELECT COUNT(*) as count FROM customer_registry WHERE contact = '$contact' LIMIT 1");
	if($check_contact){
		$row = mysqli_fetch_assoc($check_contact);
		if($row['count'] > 0){
			$data['status'] = "failed";
			$data['message'] = "Looks like another customer is already registered with this contact!";
		}else{
			$insert = mysqli_query($conn,"INSERT INTO customer_registry (fname,lname,onames,gender,dob,contact) VALUES ('$fname','$lname','$onames','$gender','$dob','$contact')");
			if($insert){
				$data['status'] = "success";
				$data['message'] = "You have been successfully registered!";
			}else{
				$data['status'] = "error";
				$data['message'] = "Oops: Failed to save your data to the repository!".mysqli_error($conn);
			}
		}
	}else{
		$data['status'] = "failed";
		$data['message'] = "Error: Critical verification process failed!".mysqli_error($conn);
	}
	echo json_encode($data);
?>