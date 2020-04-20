<?php
	STATIC $CompanyToken =  "59E04221-898F-4454-996F-47184576186F";
	require_once("db_conn.php");
	require_once("beta_db_connect.php");

	function initializeTransaction($payload){

	    STATIC $url = "https://secure.3gdirectpay.com/API/v6/";
		$xml = "<?xml version='1.0' encoding='utf-8'?>
                        <API3G>
                        <CompanyToken>".$GLOBALS['CompanyToken']."</CompanyToken>
                        <Request>createToken</Request>
                        <Transaction>
	                        <PaymentAmount>".$payload['amount']."</PaymentAmount>
	                        <PaymentCurrency>".$payload['currency']."</PaymentCurrency>
	                        <CompanyRef>".$payload['TransRef']."</CompanyRef>
	                        <RedirectURL>https://www.computicket.mw/pages/".$payload['redirect_suffix']."</RedirectURL>
	                        <BackURL></BackURL>
	                        <CompanyRefUnique>0</CompanyRefUnique>
	                        <PTL></PTL>
	                        <customerFirstName>".$payload['fname']."</customerFirstName>
	                        <customerLastName>".$payload['lname']."</customerLastName>
	                        <customerEmail>".$payload['email']."</customerEmail>
	                        <EmailTransaction></EmailTransaction>
                        </Transaction>
                        <Services>
	                        <Service>
	                            <ServiceType>".$payload['serviceCode']."</ServiceType>
	                            <ServiceDescription>Computicket Online Service</ServiceDescription>
	                         	<ServiceDate>".date('Y/m/d H:i', time())."</ServiceDate>
	                        </Service>
                        </Services>
                        </API3G>";
                        //echo $xml;


				//Initiate cURL
				$request = xhttp($url, $xml);
				$result = simplexml_load_string($request["data"]);
				$result = json_encode($result);
				$result = json_decode($result, true);
				
				$data;
				if($request["status"] == "success"){
					if($result["Result"] == 000){
						$data["status"] = "success";
						$data["title"] = "Tickets Reserved";
						$data["message"] = "Redirecting you to payments page!";
						$data["url"] ="https://secure.3gdirectpay.com/pay.asp?ID=".$result["TransToken"];
						//$data["xml"] = simplexml_load_string($xml);
					}else{
						$data["status"] = "error";
						$data["title"] = "Error : ".$result->Result;
						$data["data"] = "Failed to process the request!";
					}
				}else{
					$data["status"] = "error";
					$data["title"] = "Security Risk!";
					$data["message"] = "System failed to read the payment server's SSL certificate!";
					$data["payload"] = $request;
				}
				return $data;
	}

	function verifyToken($TransToken,$Ref){
	    //echo $TransToken;
		STATIC $url = "https://secure.3gdirectpay.com/API/v6/";
		$xml = "<?xml version='1.0' encoding='utf-8'?>
				<API3G>
				  <CompanyToken>".$GLOBALS['CompanyToken']."</CompanyToken>
				  <Request>verifyToken</Request>
				  <TransactionToken>".$TransToken."</TransactionToken>
				</API3G>";

				$request = xhttp($url, $xml);
				$result = simplexml_load_string($request["data"]);
				$result = json_encode($result);
				$result = json_decode($result, true);
				$data;
				if($request["status"] == "success"){
				    if($result["Result"] == 000){
				        
    				    //echo "Result = 000";
    					$data["status"] = "positive";
    					$data["title"] = "SUCCESS!";
    					$data["message"] = getMessage($Ref);
    					if(createLog($result,$TransToken,$Ref)){
    					    $data["updated"] = updateRequestStatus($Ref);
    					}
    				}else{
    					$data["status"] = "negative";
    					$data["title"] = "Problem Detected!";
    					$data["message"] = $result["ResultExplanation"];
    				}
				}else{
				    	$data["status"] = "error";
    					$data["title"] = "VERIFICATION FAILURE!";
    					$data["message"] = "Contact our customer services you do not get a verification email within 30 minutes time!.";
    					$data["payload"] = $request;
				}
				return $data;

	}
	
	function updateRequestStatus($ref){
	    $prefix = explode('-',$ref);
	    $query = "";
	    if($prefix[0] == "EVT"){
	        $query = $GLOBALS["conn"]->query("UPDATE booked_event_tickets SET Payment = 'Paid' WHERE booking_id = '$ref'");
	    }else if($prefix[0] == "CRID"){
	        $query = $GLOBALS["conn2"]->query("UPDATE car_booking SET Payment = 'Paid' WHERE rental_id = '$ref'");
	    }
	    if($query){
	        return true;
	    }else{

			echo mysqli_error($GLOBALS["conn"]);
	        return false;
	    }
	    
	}

	function createLog($json,$token,$ref){
		$log = $GLOBALS["conn"]->query("
		    INSERT INTO 
              transactions (
                TransactionToken,
                TransRef,
                CustomerCredit,
                CustomerName,
                CustomerPhone,
                CustomerCreditType,
                TransactionApproval,
                TransactionPaidAmount
              )
            VALUES
              (
                '".$token."',
                '".$ref."',
                '".$json['CustomerCredit']."',
                '".$json['CustomerName']."',
                '".$json['CustomerPhone']."',
                '".$json['CustomerCreditType']."',
                '".$json['TransactionApproval']."',
                '".$json['TransactionAmount']."')");
    
    	if($log){
			return true;
		}else{
		    return false;
		}
		
	}
	
	function getMessage($ref){
	    $arr = explode('-',$ref);
	    if($arr[0] == "EVT"){
	        return "You have successfully bought an Event ticket on Computicket Online. We have sent a download link to your email.";
	    }else if($arr[0] == "BRID"){
	         return "You have successfully bought a Bus ticket via Computicket Online. We have sent a download link to your email.";
	    }else if($arr[0] == "CRID"){
	    	return "Your Car Rental request has been sent!. Check your email for comfirmation!";
	    }
	}
	function xhttp($url,$xml){
		$arr = array();
		$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt ($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

				$result = curl_exec($curl);
				if(curl_errno($curl)){
				    $arr["status"] = "error";
				}else{
					$arr["status"] ="success";
					$arr["data"] = $result;
				}
				curl_close($curl);
				return $arr;
	}

	function sendEmail($email_address,$link,$message){
		$to = $email_address;
		//$from = "info@computicket.mw";
		$subject = "TICKET REQUESTS APPROVED!";
		$headers = "From:no-reply@computiket.mw";
		$message = "$message : $link";
		mail($to, $subject, $message, $headers);
	}
?>