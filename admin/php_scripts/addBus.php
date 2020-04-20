<?php
    include_once("db_conn.php");

        $company = $_REQUEST['company'];
        $reg_number = $_REQUEST['reg_number'];
        $bus_type = $_REQUEST['bus_type'];
        $num_seats = $_REQUEST['num_seats'];
        $desc = $_REQUEST['description'];

        $data = array('status' =>'', 'message' => '', 'title' => '');

        $query = mysqli_query($conn, "INSERT INTO bus (bus_id,type,num_seats,description,company) 
        VALUES ('$reg_number','$bus_type','$num_seats','$desc','$company')");

        if($query){
            $data["status"] = "success";
            $data["title"] = "Bus Added Ok";
            $data["message"] = "A new bus, ".getCompany($company)." ($bus_type), $reg_number has been successfuly added!";
        }else{
            $data["status"] = "error";
            $data["title"] = "Database Error";
            $data["message"] = mysqli_error($GLOBALS['conn']);
        }

        function getCompany($id){
            $query = mysqli_query($GLOBALS['conn'], "SELECT company_name FROM company_details WHERE company_id = '$id'") or Die(mysqli_error($GLOBALS['conn']));
            $row = mysqli_fetch_assoc($query);
            return $row["company_name"];
        }

        echo json_encode($data);
?>