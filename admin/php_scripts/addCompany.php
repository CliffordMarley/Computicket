<?php
    include_once("db_conn.php");
    $company_name = ucfirst($_POST['company_name']);
    $industry = $_POST['industry'];
    $email_address = $_POST['email_address'];
    $phone_number = $_POST['phone_number'];
    $phy_address = ucfirst($_POST['phy_address']);

    $data = array('title' => '','status' => '', 'message' => '');
    $_company_id = generateCode($industry);

    $insert = mysqli_query($conn, "INSERT INTO company_details(company_id,company_name, boundary, email_address,  phone, phy_address,".
    "indulstry) VALUES ('$_company_id','$company_name', '1', '$email_address', '$phone_number', '$phy_address', '$industry')");

    if($insert){
        $data['title'] = "Success!";
        $data['status'] = "success";
        $data['message'] = "$company_name has been successfully added to your Clients' list.";
    }else{
        $data['title'] = "Error Encountered!";
        $data['status'] = "error";
        $data['message'] = "Could not add a new client: ".mysqli_error($conn);
    }

    function generateCode($industry_id){
        $_final_id = "";
        $_index = array("TVC","ACC","CRH","EVT");
        $_proposed_id = $_index[$industry_id-1].rand(1000,9999);
    
        $check = mysqli_query($GLOBALS['conn'], "SELECT * FROM company_details WHERE company_id = '$_proposed_id'");
        if($check){
            if(mysqli_num_rows ($check) > 0){
                generateCode($industry);
            }else{
                $_final_id = $_proposed_id;
            }
        }else{
            echo mysqli_error($GLOBALS['conn']);
        }
      
        return $_final_id;
    }

    echo json_encode($data);

   
?>