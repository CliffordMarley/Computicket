<?php
	include('db_conn.php');
	
	$id=$_GET['id'];
	
	$company_name=$_POST['company_name'];
	$email_address=$_POST['email_address'];
    $phone_number=$_POST['phone_number'];
    $phy_address=$_POST['phy_address'];
	
	
    mysqli_query($conn,"UPDATE company_details SET company_name='$company_name', email_address='$email_address', phy_address='$phy_address' WHERE company_id='$id'")
     or Die(mysqli_error($conn));
	header('location:../');

?>