<?php
    session_start();
    require("db_conn.php");
    if(isset($_REQUEST["process"])){
        switch($_REQUEST["process"]){
            case "addNew":
                addEvent();
            break;
            case "getEvents":

            break;
            case "edit":

            break;
            case "delete":
                deleteEvent();
            break;
            default:

            break;
        }
    }else if(isset($_SESSION["last_event_id"]) && isset($_FILES['file']['name'])){
        echo json_encode(uploadPoster());
    }

    function addEvent(){
        $event_name = $_REQUEST["event_name"];
        $organiser = $_REQUEST["organiser"];
        $type = $_REQUEST["type"];
        $venue = $_REQUEST["venue"];
        $date_of_event = $_REQUEST["date_of_event"];
        $time_of_event = $_REQUEST["time_of_event"];
        $reg_price = $_REQUEST["regular_price"];
        $vip_price = $_REQUEST["vip_price"];
        $desc = $_REQUEST["desc"];

        $data = array('title' => '', 'status' => '' , 'message' => '' );

        $query = mysqli_query($GLOBALS["conn"], "INSERT INTO events (event_name, organiser, venue, type, event_date, event_time, description) VALUES('".ucfirst(strtolower($event_name))."','".ucfirst(strtolower($organiser))."','".ucfirst(strtolower($venue))."','$type','$date_of_event','$time_of_event','".ucfirst(strtolower($desc))."')");

        if($query){
            $vip_value = "";
            $_SESSION["last_event_id"] = mysqli_insert_id($GLOBALS["conn"]);
            if(isset($vip_price) && !empty($vip_price)){
                $vip_value = " ,('".$_SESSION['last_event_id']."','$vip_price','VIP')";
            }
            $set_price;
            if(!empty($reg_price) || !empty($vip_price)){
                $setPrices = mysqli_query($GLOBALS['conn'], "INSERT INTO event_ticket (event_id,price,status) 
                VALUES ('".$_SESSION['last_event_id']."','$reg_price','General') $vip_value");
            }
            if($setPrices){
                $data["status"] = "success";
                $data["title"] = "Event Added!";
                $data["message"] = "A new event '".ucfirst(strtolower($event_name))."' by '".ucfirst(strtolower($organiser))."' has been added!";
            }else{
                $data["status"] = "error";
                $data["title"] = "Process Interrupted";
                $data["message"] = "System failed to set prices due to error: ".mysqli_error($GLOBALS["conn"]);
            }
          
        }else{
            $data["status"] = "error";
            $data["title"] = "Process Failed";
            $data["message"] = "System failed to add this event due to error: ".mysqli_error($GLOBALS["conn"]);
        }

        echo json_encode($data);
    }

    function uploadPoster(){
        $data = array('title' => '', 'status' => '' , 'message' => '' );
         $filename = $_FILES['file']['name'];
         $filearray = explode('.', $filename);
         $file_ext = strtolower(end($filearray));
         $file_new_name = uniqid(".", true).".".$file_ext;
         $location = "../../uploads/events/".$file_new_name;
         if(move_uploaded_file($_FILES["file"]['tmp_name'], $location)){
            $update_event = mysqli_query($GLOBALS["conn"], "UPDATE events SET image_url = '$location' WHERE event_id = '".$_SESSION["last_event_id"]."' ");
            if($update_event){
                $data["status"] = "success";
                $data["title"] = "Event Added!!";
                $data["message"] = "";
            }else{
                $data["status"] = "warning";
                $data["title"] = "Process Interrupted";
                $data["message"] = "All the data was uploaded, but the system failed to relate the event data to the its poster!";
            }
         }else{
            $data["status"] = "warning";
            $data["title"] = "Partial Data Uploaded!";
            $data["message"] = "System failed to upload the event poster!, But all the other event information was saved!";
         }
         return $data;
    }

    function deleteEvent(){
        $data = $_POST["data"];
        $json = json_decode($data);
        $data = array('title' => '', 'status' => '' , 'message' => '' );
        $data["status"] = "success";
        if(count($json) > 1){
            $data["title"] = count($json)." events Deleted!!!";
            $data["message"] = "All selected events were successfully deleted!";
        }else{
            $data["title"] = "Event Deleted!!!";
            $data["message"] = "The selected event was successfully deleted!";
        }

        foreach($json as $js){
            $query = mysqli_query($GLOBALS["conn"], "UPDATE events SET status = 'deleted' WHERE event_id = '".$js."'" ) or die(mysqli_error($GLOBALS["conn"]));
            if(!$query){
                   $data["status"] = "error";
                    $data["title"] = "Deletion failed!";
                    $data["message"] = "System could not complete the deletion process!";
                    break;
            }
        }
        echo json_encode($data);
    }
?>
