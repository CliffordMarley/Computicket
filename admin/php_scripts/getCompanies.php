<?php
    include_once("db_conn.php");
    $data = array('title' => '','status' => '', 'message' => '','data' => '');

    $companies = mysqli_query($conn, "SELECT * FROM company_details JOIN indulstry WHERE
     company_details.indulstry = indulstry.indulstry_id
    ORDER BY indulstry.name ASC");
    $rows = array();
    if($companies){
        while($row = mysqli_fetch_assoc($companies)){
                $rows[] = $row;
        }
        if(mysqli_num_rows($companies) > 0){
            $data['title'] = mysqli_num_rows($companies)." Results Found";
            $data['status'] = "success";
            $data['message'] = "Database search complete!";
            $data['data'] = $rows;
        }else{
            $data['title'] = mysqli_num_rows($companies)." Results Found";
            $data['status'] = "error";
            $data['message'] = "Database search complete!";
        }
    }else{
        $data['title'] = "Error Encountered!";
        $data['status'] = "error";
        $data['message'] = "Could not add a new client: ".mysqli_error($conn);
    }

    echo json_encode($data);
?>