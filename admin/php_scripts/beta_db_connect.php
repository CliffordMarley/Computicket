<?php
	$host = "localhost";
	$user = "webmaster";
	$pass = "Angelsdie123";
	$db_name = "computicket_beta_db";

	$conn = mysqli_connect($host,$user,$pass,$db_name);
	if(mysqli_connect_errno()){
			Die("Fatal Error: could not find the specified database!");
	}
?>