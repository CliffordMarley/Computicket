<?php
    session_start();
    include_once("db_conn.php");

    $trans_id = $_GET['trans_id1'];
    $ref_code = $_GET['ref_code'];
    $pay_for = $_GET['pay_for'];

    $data = array('status' =>'', 'message' => '', 'title' => '');
    $_eval_transaction = mysqli_query($conn, "SELECT * FROM transaction_logs WHERE trans_id = '".$trans_id."'");
    $sql = "";
    $row = mysqli_fetch_assoc($_eval_transaction);
    if(mysqli_num_rows($_eval_transaction) > 0){
        
        if($row['status'] == "Unconfirmed"){
            $data['status'] = "info";
            $data['title'] = "Validation already in progress";
            $data['message'] = "This Transaction ID is already being evaluated!. 
            You will get a Text or Email confimation when the process is done!";
        }else if($row['status'] == "Confirmed"){
            $data['status'] = "warning";
            $data['title'] = "Depriciated ID";
            $data['message'] = "This Transaction ID has already been used to pay for a service here!";
        }else if($row['status'] == "Unassigned"){
            $sql = "UPDATE transaction_logs SET service_paid_for = '$pay_for', 
            service_ref = '$ref_code', status ='Confirmed' WHERE trans_id = '".$trans_id."' ";
        }
    }else{
        $sql = "INSERT INTO transaction_logs (trans_id,service_paid_for, service_ref, status) 
                VALUES('".$trans_id."','$pay_for','$ref_code','Unconfirmed')";     
    }

    $query = mysqli_query($conn, $sql);
    if($query){
        //session_destroy();
        if($row['status'] == "Unassigned"){
                $data['status'] = "success";
                $data['title'] = "Payment Received!";
                $data['message'] = "Now wait for an Text message or Email confirmation while our system builds your Ticket!";
        }else{
                $data['status'] = "success";
                $data['title'] = "Payment Details Submitted";
                $data['message'] = "Your payment details have been submitted. 
                                    You will get a Confirmation code within 30 minute, 
                                    failure of which you are advised to contact our Customer Support service. 
                                    Deatils found in our contacts page.";
        }
    }else{
        $data['status'] = "error";
        $data['title'] = "Payment Processing Failed";
        $data['message'] = "Error: ".mysqli_error($conn);
    }

    echo json_encode($data);
?>