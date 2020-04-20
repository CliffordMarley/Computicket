<?php
    session_start();
    $data = array('status' =>'', 'message' => '', 'title' => '');
    if(!isset($_SESSION['access']) && $_SESSION['access'] != "granted" || (time() - $_SESSION['timeout']) > 1200){
      session_destroy();
      $data['status'] = "logout";
      $_SESSION['directive'] = "SESSION_TIMEOUT";
    }
    $_SESSION['timeout'] = time();
    include("db_conn.php");
    $trans_id1 = $_REQUEST['transid1'];
    $trans_id2 = $_REQUEST['transid2'];
    $amount1 = $_REQUEST['amount1'];
    $amount2 = $_REQUEST['amount2'];
    $payment_service = $_REQUEST['service'];

    if(empty($trans_id1) || empty($trans_id2)){
        $data['status'] = "error";
        $data['title'] = "Empty Fields Detected";
        $data['message'] = "Make sure that both Transaction ID fields are completed properly!";
        return;
    }else if($trans_id1 != $trans_id2){
        $data['status'] = "error";
        $data['title'] = "Input Mismatch Error";
        $data['message'] = "The Transaction ID Fields do not match!";
        return;
    }else if(empty($amount1) || empty($amount2)){
        $data['status'] = "error";
        $data['title'] = "Empty Fields Detected";
        $data['message'] = "Make sure you have entered and confirmed the transaction Amount!";
        return;
    }else if($amount1 != $amount2){
        $data['status'] = "error";
        $data['title'] = "Input Mismatch Error";
        $data['message'] = "The entered transaction amounts do not match!";
        return;
    }else{
        $_eval_status = mysqli_query($conn, "SELECT status FROM transaction_logs 
        WHERE trans_id = '$trans_id1'") or die(mysqli_error($conn));
        $query = "";
        $row = "";
        
        if(mysqli_num_rows($_eval_status) > 0){
            $row = mysqli_fetch_assoc($_eval_status);

            if($row["status"] == "Confirmed"){
                $data['status'] = "info";
                $data['title'] = "Log already used!";
                $data['message'] = "This transaction has already been logged and used to pay for a service!, navigate to the appropriate tab for more info and options";
            }else if($row['status'] ==  "Unconfirmed"){
                $query ="UPDATE transaction_logs 
                    SET status = 'Confirmed', amount = '$amount2', logged_by = '".$_SESSION['uid']."' , pay_method ='$payment_service'
                    WHERE trans_id = '$trans_id1'";
            }else if($row['status'] == "Unassigned"){
                $data['status'] = "warning";
                $data['title'] = "Log Duplication Averted!";
                $data['message'] = "This transaction has already been logged and pending assignment, navigate to the appropriate tab if you would like to update it!";
            }
        }else{
            $query = "INSERT INTO transaction_logs (trans_id, amount, logged_by, payment_method,status) 
            VALUES('$trans_id1','$amount1','".$_SESSION['uid']."','$payment_service', 'Unassigned')";
        }
        if($row['status'] == "Unconfirmed" || mysqli_num_rows($_eval_status) <= 0){
            $log = mysqli_query($conn, $query);
            if($log){
                $data['status'] = "success";
                $data['title'] = "Transaction Logged Successfully!";
                $data['message'] = "The transaction has successfully been logged with status \"UNASSIGNED!\".";
            }else{
                $data['status'] = "error";
                $data['title'] = "Transaction Logging Failed!";
                $data['message'] = "An SQL Error Occurred that caused the process to fail! ".mysqli_errror($conn);
            }
        }
    }



    echo json_encode($data);
?>