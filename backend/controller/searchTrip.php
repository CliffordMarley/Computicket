<?php
    header("Access-Control-Allow-Origin:*");
    require("db_conn.php");
    $bus_company = $_REQUEST["bus_company"];
    $dept_date = $_REQUEST["travel_date"];
    $origin = $_REQUEST["origin"];
    $destination = $_REQUEST["destination"];

    $dump = array('status'=>'', 'message'=>'','data'=>'');

    $queryBuilder = "SELECT *  FROM trip JOIN bus JOIN company_details 
    WHERE bus.company = company_details.company_id AND trip.bus_id = bus.bus_id";
    if(!empty($bus_company)){
        $queryBuilder .= " AND  company_details.company_id = '".$bus_company."'";
    }
    if(!empty($dept_date)){
        $queryBuilder .= " AND trip.departure_date = '".$dept_date."'";
    }
    if(!empty($origin)){
        $queryBuilder .= " AND origin = $origin";
    }

    if(!empty($destination)){
        $queryBuilder .= " AND destination = $destination";
    }

    $queryBuilder .= " ORDER BY trip.departure_date, trip.departure_time ASC";
    //echo $queryBuilder;
    
    $query = mysqli_query($conn, $queryBuilder);
    $rows = array();

    if($query){
        while($row = mysqli_fetch_assoc($query)){
            $rows[] = $row;
        }
        $dump['status'] = "success";
        $dump['message'] = "Search results data dump retrieved!";
        $dump['data'] = $rows;
    }else{
        $dump['status'] = "error";
        $dump['message'] = "Failed to query the database! ".mysqli_error($conn);
        //$dump['data'] = "";
    }
    echo json_encode($dump);
// ?>
