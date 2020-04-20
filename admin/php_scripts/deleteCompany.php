<?php
    include_once("db_conn.php");
    if(isset($_GET['company_id'])){
        $delete = mysqli_query($conn,"UPDATE company_details SET status = 'Deleted' WHERE company_id = '".$_GET['company_id']."'") or Die(mysqli_error($conn));
        header("LOCATION: ../");
    }
?>