<?php
    header("Access-Control-Allow-Origin:*");
    header("Content-Type: application/x-www-form-urlencoded");
    include("db_conn.php");

    $origin = $_GET["origin"];
    $destination = $_GET["destination"];
    $travel_date = $_GET["travel_date"];
    $dept_time = $_GET["dept_time"];
    $arrival_time = $_GET["arrival_time"];
    $bus = $_GET["bus"];
    $route = $_GET["route"];

    $data = array('title' => '','status' => '', 'message' => '');
    $num_seats = getNumSeats($bus);
    $add_trip = mysqli_query($conn, "INSERT INTO trip (origin, destination,departure_date,departure_time, arrival_time,bus_id,
    route,status,avail_seats,lapse) VALUES('$origin','$destination','$travel_date','$dept_time','$arrival_time','$bus','$route','Pending',$num_seats, TIMEDIFF('$travel_date $arrival_time','$travel_date $dept_time'))");
     
     if($add_trip){
        $data['title'] = "Trip Scheduled!";
        $data['status'] = "success";
        $data['message'] = "A new trip from ".getDistrict($origin)." to ".getDistrict($destination)." has been scheduled on ".strval($travel_date)." departing at ".strval($dept_time)." and arriving at ".strval($arrival_time);
    }else{
        $data['title'] = "Error Encountered!";
        $data['status'] = "error";
        $data['message'] = "Could not schedule a trip: ".mysqli_error($conn);
    }

    function getDistrict($id){
        $district =mysqli_query($GLOBALS['conn'], "SELECT district_name FROm district WHERE district_id = $id ");
        $row = mysqli_fetch_assoc($district);
        return $row["district_name"];
    }
    function getNumSeats($bus_id){
        $seats =mysqli_query($GLOBALS['conn'], "SELECT num_seats FROM bus WHERE bus_id = '".$bus_id."' ") or Die(mysqli_error($GLOBALS['conn']));
        $row = mysqli_fetch_assoc($seats);
        return $row["num_seats"];
    }
    echo json_encode($data);
?>