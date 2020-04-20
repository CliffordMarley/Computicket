<?php
        //header("Content-Type: application/json; charset=UTF-8");
        header("Content-Type: application/x-www-form-urlencoded");
        header("Access-Control-Allow-Origin:*");
        error_reporting(1);
        //require "data.php";

        include_once("db_conn.php");

        $domain = $_REQUEST['domain'];
        $hotel_name = $_REQUEST['hotel_name'];
        $email_address = $_REQUEST['email_address'];
        $phone_number = $_REQUEST['phone_number'];
        $district = $_REQUEST['district'];
        $address = $_REQUEST['address'];
        $sap = $_REQUEST['sap'];

        $id = uniqid(".",true);
        $c_name = getHotelName($domain);

        $data = array('status' =>'', 'message' => '', 'title' => '');

        $addhotel = mysqli_query($conn, "INSERT INTO hotel(hotel_id ,domain, hotel_name, email, phone, district, phy_address, status) 
        VALUES('$id','$domain','$hotel_name','$email_address','$phone_number','$district','$address', 'Active')");
    
        if($addhotel){
            $data["status"] = "success";
            $data["title"] = "Complete";
            $full_name;

               if($sap){
                     $full_name = $c_name; 
               }else if(!$sap){
                     $full_name = $c_name.", ".$hotel_name; 
               }
            $data["message"] = "'$full_name' has been successfully added!";
        }else{
          $data["status"] = "error";
          $data["title"] = "Application Error";
          $data["message"] = mysqli_error($GLOBALS['conn']);
        }

        function getHotelName($id){
            $query = mysqli_query($GLOBALS['conn'], "SELECT company_name FROM company_details WHERE company_id = '$id'") or Die(mysqli_error($GLOBALS['conn']));
            $row = mysqli_fetch_assoc($query);
            return $row["company_name"];
        }
        echo json_encode($data);

?>