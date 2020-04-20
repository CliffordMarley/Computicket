<?php
   header("Access-Control-Allow-Origin:*");
	$response = array();

	if(isset($_POST["crid"]) && !empty($_POST["crid"])){
		require("beta_db_connect.php");
		$update = $conn->query("UPDATE car_booking SET status = 'Approved' WHERE rental_id = '".$_POST["crid"]."'");
		if($update){
			$response = sendConfirmationEmail($_POST["crid"]);
		}else{
			$res["status"] = "error";
			$res["title"] = "SQL Error!";
			$res["message"]= "System failed to approve the Car Rental Request!";
		}
	}else{
		$response["status"] = "error";
		$response["title"] = "Empty Rental ID!";
		$response["message"] = "The system cannot process an empty Rental ID!";
	}
	echo json_encode($response);

	function sendConfirmationEmail($rental_id){
		$res = array();
		$query = $GLOBALS["conn"]->query("SELECT * FROM car_booking WHERE rental_id = '$rental_id' AND status = 'Approved'");
		if($query){
			$res["title"] = "APPROVED!";
			$row = $query->fetch_assoc();
    
			$to = $row['email_address'];
			$subject = 'CAR RENTAL CONFIRMATION!';
			$headers = "From: COMPUTICKET MALAWI<info@computicket.mw> \r\n";
			$headers .= "Reply-To: COMPUTICKET MALAWI <info@computicket.mw>\r\n";
            $headers .= "Return-Path: COMPUTICKET MALAWI <info@computicket.mw>\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1";
			$message = "<!DOCTYPE html><html xmlns=http://www.w3.org/1999/xhtml xmlns:v=urn:schemas-microsoft-com:vml><meta content='text/html' charset=utf-8'http-equiv=Content-Type><meta content='width=device-width'name=viewport><meta content=true name=HandheldFriendly><meta content='IE=edge'http-equiv=X-UA-Compatible><!--[if gte IE 7]><html xmlns=http://www.w3.org/1999/xhtml class=ie8plus><![endif]--><!--[if IEMobile]><html xmlns=http://www.w3.org/1999/xhtml class=ie8plus><![endif]--><meta content='telephone=no'name=format-detection><meta name=x-apple-disable-message-reformatting><meta content='EDMdesigner, www.edmdesigner.com'name=generator><title></title><style media=screen>*{line-height:inherit}.ExternalClass *{line-height:100%}body,p{margin:0;padding:0;margin-bottom:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none}img{line-height:100%;outline:0;text-decoration:none;-ms-interpolation-mode:bicubic}a img{border:none}.appleLinks a,.no-detect-local a,a,a:link{color:#55f!important;text-decoration:underline}.ExternalClass{display:block!important;width:100%}.ExternalClass,.ExternalClass div,.ExternalClass font,.ExternalClass p,.ExternalClass span,.ExternalClass td{line-height:inherit}table td{border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0}.mobile_link a[href^=sms],.mobile_link a[href^=tel]{text-decoration:default;color:#55f!important;pointer-events:auto;cursor:default}.no-detect a{text-decoration:none;color:#55f;pointer-events:auto;cursor:default}span{color:inherit;border-bottom:none}span:hover{background-color:transparent}a[x-apple-data-detectors]{color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}.nounderline{text-decoration:none!important}h1,h2,h3{margin:0;padding:0}p{Margin:0!important}table[class=email-root-wrapper]{width:600px!important}body{background-color:#f2f2f2;background:#f2f2f2}body{min-width:280px;width:100%}</style><style>@media only screen and (max-width:599px),only screen and (max-device-width:599px),only screen and (max-width:400px),only screen and (max-device-width:400px){.email-root-wrapper{width:100%!important}.full-width{width:100%!important;height:auto!important;text-align:center}.fullwidthhalfleft{width:100%!important}.fullwidthhalfright{width:100%!important}.fullwidthhalfinner{width:100%!important;margin:0 auto!important;float:none!important;margin-left:auto!important;margin-right:auto!important;clear:both!important}.hide{display:none!important;width:0!important;height:0!important;overflow:hidden}}</style><style>@media only screen and (max-width:599px),only screen and (max-device-width:599px),only screen and (max-width:400px),only screen and (max-device-width:400px){table[class=email-root-wrapper]{width:100%!important}td[class=wrap] .full-width{width:100%!important;height:auto!important}td[class=wrap] .fullwidthhalfleft{width:100%!important}td[class=wrap] .fullwidthhalfright{width:100%!important}td[class=wrap] .fullwidthhalfinner{width:100%!important;margin:0 auto!important;float:none!important;margin-left:auto!important;margin-right:auto!important;clear:both!important}td[class=wrap] .hide{display:none!important;width:0;height:0;overflow:hidden}.edm-social{width:100%!important}}@media screen and (-webkit-min-device-pixel-ratio:0){.img600x243{width:600px!important;height:243px!important}}</style><style>@media screen and (min-width:600px){.dh{display:none}}</style><style media='(pointer) and (min-color-index:0)'>body,html{background-image:none!important;background-color:transparent!important;margin:0!important;padding:0!important}</style><body bgcolor=#f2f2f2 leftmargin=0 marginheight=0 marginwidth=0 offset=0 style=font-family:Arial,sans-serif;font-size:0;margin:0;padding:0;background:#f2f2f2!important topmargin=0><style>@media screen yahoo and (max-width:600px){.hide{display:none;overflow:hidden}}</style><table cellpadding=0 cellspacing=0 width=100% border=0 style=margin:0;padding:0;width:100%!important;background:#f2f2f2!important bgcolor=#f2f2f2 align=center height=100%><tr><td valign=top align=center class=wrap width=100%><center><div style=padding:0><table cellpadding=0 cellspacing=0 width=100% border=0><tr><td style=padding:0 valign=top><table cellpadding=0 cellspacing=0 width=600 style='max-width:600px;min-width:240px;margin:0 auto'align=center class=email-root-wrapper><tr><td style=padding:0 valign=top><table cellpadding=0 cellspacing=0 width=100% border=0 style='border:0 none'><tr><td style=padding:0 valign=top><table cellpadding=0 cellspacing=0 width=100%><tr><td style=padding:0><table cellpadding=0 cellspacing=0 width=100% border=0 style='border:0 none;background-color:#2f50db'bgcolor=#2F50DB><tr><td style=padding:0 valign=top><table cellpadding=0 cellspacing=0 width=100%><tr><td style=padding:0><table cellpadding=0 cellspacing=0 width=100% border=0><tr><td style=padding-top:10px;padding-right:10px;padding-left:10px valign=top><div style=text-align:left;font-family:Verdana,Geneva,sans-serif;font-size:15px;color:#000;line-height:22px;mso-line-height:exactly;mso-text-raise:3px><h1 style='font-family:Palatino,Palatino Linotype,Book Antiqua,Georgia,serif;font-size:40px;color:#00a591;line-height:50px;mso-line-height:exactly;mso-text-raise:5px;padding:0;margin:0;text-align:center'><span class=mso-font-fix-georgia><span style=color:#fff>REF: ".$row['rental_id']."</span></span></h1><h3 style='font-family:Palatino,Palatino Linotype,Book Antiqua,Georgia,serif;font-size:22px;color:#000;line-height:32px;mso-line-height:exactly;mso-text-raise:5px;padding:0;margin:0;text-align:center'><span class=mso-font-fix-georgia><span style=color:#f0f8ff>Thank you for renting a car through us!</span></span></h3></div></table></table></table><table cellpadding=0 cellspacing=0 width=100% border=0 style='border:0 none;background-color:#fff'bgcolor=#ffffff><tr><td style=padding:0 valign=top><table cellpadding=0 cellspacing=0 width=100%><tr><td style=padding:0><table cellpadding=0 cellspacing=0 width=600 border=0 style='border:0 none'align=center class=full-width><tr><td style=padding:0 valign=top align=center><img alt=''border=0 class='full-width img600x243'height=243 src=https://computicket.mw/assets/img/cars/cars2.png style=display:block;max-width:100%;height:auto width=600></table></table></table><table cellpadding=0 cellspacing=0 width=100% border=0 style='border:0 none;background-color:#fff'bgcolor=#ffffff><tr><td style=padding:0 valign=top><table cellpadding=0 cellspacing=0 width=100%><tr><td style=padding:0><table cellpadding=0 cellspacing=0 width=100% border=0><tr><td style=padding:10px valign=top><div style=text-align:left;font-family:Verdana,Geneva,sans-serif;font-size:15px;color:#000;line-height:22px;mso-line-height:exactly;mso-text-raise:3px><p style=padding:0;margin:0>Dear ".$row['fname'].", <br><br> We've confirmed you payment and have reserved a car for you from <strong>26 September 2019 until 10th October 2019.</strong><p style=padding:0;margin:0><p style=padding:0;margin:0>Pickup Point: Game complex LL Mall car park, Lilongwe Malawi.<p style=padding:0;margin:0>Reference number: <strong>".$row['rental_id']."</strong><p style=padding:0;margin:0>Vehicle Reg #: <strong>".$row['car']."</strong><p style=padding:0;margin:0>Time Lapse: <strong>".floor( strtotime($row['drop_off']) - strtotime($row['pickup']) / (60*60*24) )."</strong><p style=padding:0;margin:0>Please <a class=nounderline href=http://x style=color:#e94b3c!important;text-decoration:none!important target=_blank><font style=color:#e94b3c>contact us</font></a> on <a href='mail:info@computicket.mw'>info@computicket.mw</a> if you have any questions.</div></table></table></table></table></table></table></table></div></center></table>";
			$sendEmail = mail($to, $subject, $message, $headers);
			if($sendEmail){
				$res["status"] = "success";
				$res["message"] = "Car rental request ".$row['rental_id']." has been approved. An email message has been sent to the customer!!";
				$res["email"] = $sendEmail;
				$res["payload"] = $message;
			}else{
				$res["status"] = "warning";
				$res["message"] = "Car rental request ".$row['rental_id']." has been approved. But the system has failed to send the customer an email confirmation!";
				$res["error"] = $sendEmail;
			}
		}else{
			$res["status"] = "warning";
			$res["title"] = "APPROVED!";
			$res["message"]= "System failed to send email confirmation!";
		}
		$GLOBALS["conn"]->close();
		return $res;
	};

?>