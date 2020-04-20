<?php
	header("Content-Type: application/x-www-form-urlencoded");
    header("Access-Control-Allow-Origin:*");

	include_once("db_conn.php");

	$get_ids = $_REQUEST['ids'];
	$ids = explode("@", $get_ids);
	$data = array('status' =>'', 'message' => '', 'title' => '');

	$queryBuilder = "";
	for ($i=0; $i < count($ids) ; $i++) { 
		if($i == 0){
			$queryBuilder = "hotel_id = '".$ids[$i]."' ";
		}else{
			$queryBuilder .= " AND hotel_id = '".$ids[$i]."' ";
		}
	}
	$query = "UPDATE hotel SET status = 'Deleted' WHERE $queryBuilder";
	
	$delete_query = mysqli_query($conn, $query);
	if($delete_query){
		$data["status"] = "success";
        $data["title"] = "Deleted";
        $data["message"] = count($ids)." Hotels have been successfully deleted!";
	}else{
		 $data["status"] = "error";
          $data["title"] = "Records Sustained";
          $data["message"] = mysqli_error($conn);
	}
	echo json_encode($data);
?>