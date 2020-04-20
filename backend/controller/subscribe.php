<?php
	$email = $_GET["sub_email"];
	$data = array('status' => '', 'message' => '','email_status' => '');
	require("db_conn.php");

	if(!empty($email)){
		if(!checkSubscription($email)){
			$sql = mysqli_query($conn,"INSERT INTO mailing_list (email) VALUES ('$email')");
			if($sql){
				$data['status'] = "success";
				$data['message'] = "You have successfully subscribed!";
				//sendEmailConfirmation($email);
			}else{
				$data['status'] = "failed";
				$data['message'] = "Couldn't finish subscription process!";
			}
		}else{
			$data['status'] = "warning";
			$data['message'] = "This email is already subscribed!";
		}
	}else{
		$data['status'] = "failed";
		$data['message'] = "Server received an empty email value!, Retry!";
	}

	// Checking if the email address is already subscribed!
	function checkSubscription($this_email){
		$ret = true;
		$check = mysqli_query($GLOBALS['conn'],"SELECT * FROM mailing_list WHERE email = '$this_email'");
		if($check){
			if(mysqli_num_rows($check) <= 0){
				$ret = false;
			}
		}else{
			$data['status'] = "failed";
			$data['message'] = "A critical integrity check failed!";
		}
		return $ret;
	}
	function sendEmailConfirmation($email){
		$to      = $email;
		$subject = 'Subscription Confirmation';
		$message = 'hello';
		$headers = 'From: info@computicket.mw' . "\r\n" .
		'Reply-To: info@computicket.mw' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

		try{
			mail($to, $subject, $message, $headers);
		}catch(Exception $e){
			$data['email_status'] = $e;
		}
	}
	echo json_encode($data);
?>

